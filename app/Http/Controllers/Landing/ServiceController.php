<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

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
            // Configure PhpWord
            Settings::setTempDir(sys_get_temp_dir());
            
            // Load template
            $templateProcessor = new TemplateProcessor($templatePath);
            
            // Replace variables
            foreach ($template->variables as $variable) {
                $fieldName = 'var_' . $variable['mark'];
                $value = $request->input($fieldName, '');
                $templateProcessor->setValue($variable['mark'], $value);
            }
            
            // Generate filename
            $filename = $template->name . '_' . date('YmdHis') . '.docx';
            $outputPath = storage_path('app/public/generated/' . $filename);
            
            // Ensure directory exists
            if (!file_exists(dirname($outputPath))) {
                mkdir(dirname($outputPath), 0755, true);
            }
            
            // Save document
            $templateProcessor->saveAs($outputPath);
            
            // Return download response
            return response()->download($outputPath, $filename)->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat dokumen: ' . $e->getMessage());
        }
    }
}