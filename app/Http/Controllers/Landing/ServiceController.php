<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\ServiceTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $templates = ServiceTemplate::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('landing.services.index', compact('templates'));
    }
    
    /**
     * Display the form for a specific service template.
     */
    public function show($id)
    {
        $template = ServiceTemplate::findOrFail($id);
        
        if (!$template->is_active) {
            abort(404);
        }
        
        $variables = $template->variables ?? [];
        
        return view('landing.services.form', compact('template', 'variables'));
    }
    
    /**
     * Display the form for the specified service template.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function form($id)
    {
        $template = ServiceTemplate::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();
            
        $variables = $template->variables ?? [];
        
        return view('landing.services.form', compact('template', 'variables'));
    }
    
    /**
     * Process the template form and generate document.
     */
    public function generateDocument(Request $request, $id)
    {
        $template = ServiceTemplate::findOrFail($id);
        
        if (!$template->is_active) {
            abort(404);
        }
        
        // Validate form inputs based on template variables
        $rules = [];
        $messages = [];
        
        if (!empty($template->variables)) {
            foreach ($template->variables as $variable) {
                $fieldName = 'var_' . $variable['mark'];
                $rules[$fieldName] = 'required';
                $messages[$fieldName.'.required'] = 'Field ' . ($variable['description'] ?? $variable['mark']) . ' wajib diisi.';
            }
        }
        
        $validated = $request->validate($rules, $messages);
        
        // Process the template
        if (!$template->file_path || !Storage::disk('public')->exists($template->file_path)) {
            return redirect()->back()->with('error', 'Template file tidak ditemukan');
        }
        
        $templatePath = Storage::disk('public')->path($template->file_path);
        
        try {
            // Configure PhpWord and environment
            Settings::setTempDir(sys_get_temp_dir());
            
            // Pastikan variabel HOME tersedia untuk Windows
            if (!isset($_SERVER['HOME']) && !isset($_ENV['HOME'])) {
                $_ENV['HOME'] = sys_get_temp_dir();
            }
            
            // Load template
            $templateProcessor = new TemplateProcessor($templatePath);
            
            // Replace variables
            foreach ($template->variables as $variable) {
                $fieldName = 'var_' . $variable['mark'];
                $value = $request->input($fieldName, '');
                // Pastikan format variabel sesuai dengan yang ada di template Word
                // Format variabel di Word biasanya ${VARIABLE} atau {VARIABLE}
                $variableMark = $variable['mark'];
                
                // Coba beberapa format variabel yang umum digunakan
                $templateProcessor->setValue($variableMark, $value); // Format: VARIABLE
                $templateProcessor->setValue('${'.$variableMark.'}', $value); // Format: ${VARIABLE}
                $templateProcessor->setValue('{'.$variableMark.'}', $value); // Format: {VARIABLE}
            }
            
            // Generate filename for Word document
            $docxFilename = $template->name . '_' . date('YmdHis') . '.docx';
            $docxOutputPath = storage_path('app/public/generated/' . $docxFilename);
            $outputDir = dirname($docxOutputPath);
            
            // Ensure directory exists
            if (!file_exists($outputDir)) {
                mkdir($outputDir, 0755, true);
            }
            
            // Save Word document
            $templateProcessor->saveAs($docxOutputPath);
            
            // Return download response for DOCX
            return response()->download($docxOutputPath, $docxFilename)->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat dokumen: ' . $e->getMessage());
        }
    }
}