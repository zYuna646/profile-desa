<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $templates = ServiceTemplate::where('is_active', true)->orderBy('name')->get();
        return view('admin.services.create', compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'service_template_id' => 'nullable|exists:service_templates,id',
            'template_data' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('_token', 'image');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $data['image'] = $path;
        }
        
        // Set default values
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->input('order', 0);
        
        Service::create($data);
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        $templates = ServiceTemplate::where('is_active', true)->orderBy('name')->get();
        return view('admin.services.edit', compact('service', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'service_template_id' => 'nullable|exists:service_templates,id',
            'template_data' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = Service::findOrFail($id);
        $data = $request->except('_token', '_method', 'image');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->image && Storage::exists('public/' . $service->image)) {
                Storage::delete('public/' . $service->image);
            }
            
            $path = $request->file('image')->store('services', 'public');
            $data['image'] = $path;
        }
        
        // Set default values
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->input('order', 0);
        
        $service->update($data);
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        
        // Delete image if exists
        if ($service->image && Storage::exists('public/' . $service->image)) {
            Storage::delete('public/' . $service->image);
        }
        
        $service->delete();
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus');
    }
    
    /**
     * Generate PDF from template.
     */
    public function generatePdf(string $id)
    {
        $service = Service::with('template')->findOrFail($id);
        
        if (!$service->template) {
            return redirect()->back()->with('error', 'Layanan ini tidak memiliki template');
        }
        
        if (!$service->template->file_path || !Storage::exists('public/' . $service->template->file_path)) {
            return redirect()->back()->with('error', 'File template tidak ditemukan');
        }
        
        $templatePath = Storage::disk('public')->path($service->template->file_path);
        $templateData = $service->template_data ?? [];
        
        try {
            // Load the template document
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($templatePath);
            
            // Replace all variables in the document
            $this->replaceVariablesInTemplate($phpWord, $templateData);
            
            // Create temp file for the processed document
            $tempFile = storage_path('app/temp_' . uniqid() . '.docx');
            $phpWord->save($tempFile);
            
            // Convert to PDF
            $pdfFile = storage_path('app/temp_' . uniqid() . '.pdf');
            
            // Use LibreOffice to convert DOCX to PDF (if available)
            if (PHP_OS_FAMILY === 'Windows') {
                // Windows path to LibreOffice (adjust as needed)
                $libreOfficePath = 'C:\Program Files\LibreOffice\program\soffice.exe';
                if (file_exists($libreOfficePath)) {
                    exec('"' . $libreOfficePath . '" --headless --convert-to pdf --outdir ' . storage_path('app') . ' ' . $tempFile);
                    $pdfFile = str_replace('.docx', '.pdf', $tempFile);
                }
            } else {
                // Linux/Mac path
                exec('libreoffice --headless --convert-to pdf --outdir ' . storage_path('app') . ' ' . $tempFile);
                $pdfFile = str_replace('.docx', '.pdf', $tempFile);
            }
            
            // Check if PDF was created
            if (file_exists($pdfFile)) {
                // Return the PDF file for download
                $filename = Str::slug($service->title) . '_' . date('Y-m-d') . '.pdf';
                return response()->download($pdfFile, $filename, [
                    'Content-Type' => 'application/pdf',
                ])->deleteFileAfterSend(true);
            }
            
            // If PDF conversion failed, offer the DOCX for download
            $filename = Str::slug($service->title) . '_' . date('Y-m-d') . '.docx';
            return response()->download($tempFile, $filename, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ])->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghasilkan PDF: ' . $e->getMessage());
        }
    }
    
    /**
     * Replace variables in the template with actual data.
     */
    private function replaceVariablesInTemplate($phpWord, $templateData)
    {
        // Add default data if not provided
        $data = array_merge([
            'TANGGAL' => date('d-m-Y'),
            'NAMA_DESA' => 'Desa Contoh',
            'NAMA_KECAMATAN' => 'Kecamatan Contoh',
            'NAMA_KABUPATEN' => 'Kabupaten Contoh',
            'NAMA_PROVINSI' => 'Provinsi Contoh',
            'NAMA_KEPALA_DESA' => 'Nama Kepala Desa',
            'NIP_KEPALA_DESA' => '198000000000000001'
        ], $templateData);
        
        // Process each section in the document
        foreach ($phpWord->getSections() as $section) {
            $this->replaceInElements($section->getElements(), $data);
        }
        
        // Process headers
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getHeaders() as $header) {
                $this->replaceInElements($header->getElements(), $data);
            }
        }
        
        // Process footers
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getFooters() as $footer) {
                $this->replaceInElements($footer->getElements(), $data);
            }
        }
        
        return $phpWord;
    }
    
    /**
     * Replace variables in document elements.
     */
    private function replaceInElements($elements, $data)
    {
        foreach ($elements as $element) {
            // Text run elements
            if (method_exists($element, 'getText') && method_exists($element, 'setText')) {
                $text = $element->getText();
                foreach ($data as $key => $value) {
                    $text = str_replace('{{' . $key . '}}', $value, $text);
                }
                $element->setText($text);
            }
            
            // Table cells
            if (method_exists($element, 'getCells')) {
                foreach ($element->getCells() as $cell) {
                    $this->replaceInElements($cell->getElements(), $data);
                }
            }
            
            // TextRun elements
            if (method_exists($element, 'getElements')) {
                $this->replaceInElements($element->getElements(), $data);
            }
        }
    }
}
