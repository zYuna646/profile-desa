<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\IOFactory;

class ServiceTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = ServiceTemplate::orderBy('name')->paginate(10);
        return view('admin.service-templates.index', compact('templates'));
    }
    
    /**
     * Extract variables from a template file
     */
    public function extractVariables(string $id)
    {
        $template = ServiceTemplate::findOrFail($id);
        
        if (!$template->file_path || !Storage::disk('public')->exists($template->file_path)) {
            return response()->json(['error' => 'Template file not found'], 404);
        }
        
        $filePath = Storage::disk('public')->path($template->file_path);
        
        try {
            // Load the document
            $phpWord = IOFactory::load($filePath);
            $text = '';
            
            // Extract text from all sections
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . ' ';
                    } elseif (method_exists($element, 'getElements')) {
                        foreach ($element->getElements() as $childElement) {
                            if (method_exists($childElement, 'getText')) {
                                $text .= $childElement->getText() . ' ';
                            }
                        }
                    }
                }
            }
            
            // Find all variables in the format {{VARIABLE_NAME}}
            preg_match_all('/\{\{([A-Z0-9_]+)\}\}/', $text, $matches);
            
            $variables = [];
            if (!empty($matches[1])) {
                $variables = array_unique($matches[1]);
            }
            
            // If no variables found, return default variables
            if (empty($variables)) {
                $variables = ['NAMA_PEMOHON', 'NIK', 'ALAMAT', 'TANGGAL', 'KEPERLUAN'];
            }
            
            return response()->json([
                'variables' => $variables,
                'descriptions' => [
                    'NAMA_PEMOHON' => 'Nama lengkap pemohon',
                    'NIK' => 'Nomor Induk Kependudukan',
                    'ALAMAT' => 'Alamat lengkap pemohon',
                    'TANGGAL' => 'Tanggal surat',
                    'KEPERLUAN' => 'Keperluan/tujuan surat',
                    'TEMPAT_LAHIR' => 'Tempat lahir pemohon',
                    'TANGGAL_LAHIR' => 'Tanggal lahir pemohon',
                    'JENIS_KELAMIN' => 'Jenis kelamin pemohon',
                    'PEKERJAAN' => 'Pekerjaan pemohon',
                    'AGAMA' => 'Agama pemohon',
                    'STATUS_PERKAWINAN' => 'Status perkawinan pemohon',
                    'KEWARGANEGARAAN' => 'Kewarganegaraan pemohon',
                    'NOMOR_SURAT' => 'Nomor surat',
                    'NAMA_DESA' => 'Nama desa',
                    'NAMA_KECAMATAN' => 'Nama kecamatan',
                    'NAMA_KABUPATEN' => 'Nama kabupaten',
                    'NAMA_PROVINSI' => 'Nama provinsi',
                    'NAMA_KEPALA_DESA' => 'Nama kepala desa',
                    'NIP_KEPALA_DESA' => 'NIP kepala desa'
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to extract variables: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service-templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'template_file' => 'required|file|mimes:docx,doc|max:5120', // Max 5MB
            'is_active' => 'nullable',
            'variable_marks.*' => 'nullable|string|max:50',
            'variable_descriptions.*' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['name', 'is_active']);
        
        // Handle file upload
        if ($request->hasFile('template_file')) {
            $path = $request->file('template_file')->store('service-templates', 'public');
            $data['file_path'] = $path;
        }
        
        // Set default values
        $data['is_active'] = $request->has('is_active');
        
        // Process variables
        $variables = [];
        if ($request->has('variable_marks') && is_array($request->variable_marks)) {
            foreach ($request->variable_marks as $key => $mark) {
                if (!empty($mark)) {
                    $variables[] = [
                        'mark' => $mark,
                        'description' => $request->variable_descriptions[$key] ?? ''
                    ];
                }
            }
        }
        $data['variables'] = $variables;
        
        ServiceTemplate::create($data);
        
        return redirect()->route('admin.service-templates.index')
            ->with('success', 'Template layanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $template = ServiceTemplate::findOrFail($id);
        return view('admin.service-templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $template = ServiceTemplate::findOrFail($id);
        return view('admin.service-templates.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $template = ServiceTemplate::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'template_file' => 'nullable|file|mimes:docx,doc|max:5120', // Max 5MB
            'is_active' => 'nullable',
            'variable_marks.*' => 'nullable|string|max:50',
            'variable_descriptions.*' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['name', 'is_active']);
        
        // Handle file upload
        if ($request->hasFile('template_file')) {
            // Delete old file if exists
            if ($template->file_path && Storage::disk('public')->exists($template->file_path)) {
                Storage::disk('public')->delete($template->file_path);
            }
            
            $path = $request->file('template_file')->store('service-templates', 'public');
            $data['file_path'] = $path;
        }
        
        // Set default values
        $data['is_active'] = $request->has('is_active');
        
        // Process variables
        $variables = [];
        if ($request->has('variable_marks') && is_array($request->variable_marks)) {
            foreach ($request->variable_marks as $key => $mark) {
                if (!empty($mark)) {
                    $variables[] = [
                        'mark' => $mark,
                        'description' => $request->variable_descriptions[$key] ?? ''
                    ];
                }
            }
        }
        $data['variables'] = $variables;
        
        $template->update($data);
        
        return redirect()->route('admin.service-templates.index')
            ->with('success', 'Template layanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $template = ServiceTemplate::findOrFail($id);
        
        // Delete file if exists
        if ($template->file_path && Storage::exists('public/' . $template->file_path)) {
            Storage::delete('public/' . $template->file_path);
        }
        
        $template->delete();
        
        return redirect()->route('admin.service-templates.index')
            ->with('success', 'Template layanan berhasil dihapus');
    }
    
    /**
     * Download the template file.
     */
    public function download(string $id)
    {
        $template = ServiceTemplate::findOrFail($id);
        
        if (!$template->file_path || !Storage::exists('public/' . $template->file_path)) {
            return redirect()->back()->with('error', 'File template tidak ditemukan');
        }
        
        return Storage::download('public/' . $template->file_path, $template->name . '.docx');
    }
}
