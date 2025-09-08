<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Infographic;
use App\Models\InfographicType;
use Illuminate\Http\Request;

class InfographicController extends Controller
{
    /**
     * Menampilkan semua infografis yang aktif
     */
    public function index()
    {
        $types = InfographicType::where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $infographics = Infographic::with('type')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('infographic_type_id');
            
        return view('landing.infographics.index', compact('types', 'infographics'));
    }
    
    /**
     * Menampilkan detail infografis berdasarkan slug
     */
    public function show($slug)
    {
        $infographic = Infographic::with('type')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        return view('landing.infographics.show', compact('infographic'));
    }
    
    /**
     * Menampilkan infografis berdasarkan tipe
     */
    public function byType($typeSlug)
    {
        $type = InfographicType::where('slug', $typeSlug)
            ->where('is_active', true)
            ->firstOrFail();
            
        $infographics = Infographic::with('type')
            ->where('infographic_type_id', $type->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        return view('landing.infographics.by-type', compact('type', 'infographics'));
    }
}
