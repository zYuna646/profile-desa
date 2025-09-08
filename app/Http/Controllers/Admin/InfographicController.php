<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infographic;
use App\Models\InfographicType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class InfographicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infographics = Infographic::with('type')
            ->orderBy('order')
            ->paginate(10);
        
        return view('admin.infographics.index', compact('infographics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = InfographicType::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('admin.infographics.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'infographic_type_id' => 'required|exists:infographic_types,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:infographics',
            'description' => 'nullable|string',
            'data' => 'nullable|json',
            'diagram_type' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        
        // Konversi data JSON menjadi array
        if (isset($validated['data'])) {
            $validated['data'] = json_decode($validated['data'], true);
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('infographics', 'public');
        }

        Infographic::create($validated);

        return redirect()->route('admin.infographics.index')
            ->with('success', 'Infografis berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Infographic $infographic)
    {
        $infographic->load('type');
        return view('admin.infographics.show', compact('infographic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infographic $infographic)
    {
        $types = InfographicType::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('admin.infographics.edit', compact('infographic', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infographic $infographic)
    {
        $validated = $request->validate([
            'infographic_type_id' => 'required|exists:infographic_types,id',
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('infographics')->ignore($infographic)],
            'description' => 'nullable|string',
            'data' => 'nullable|json',
            'diagram_type' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        
        // Konversi data JSON menjadi array
        if (isset($validated['data'])) {
            $validated['data'] = json_decode($validated['data'], true);
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($infographic->image) {
                Storage::disk('public')->delete($infographic->image);
            }
            $validated['image'] = $request->file('image')->store('infographics', 'public');
        }

        $infographic->update($validated);

        return redirect()->route('admin.infographics.index')
            ->with('success', 'Infografis berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infographic $infographic)
    {
        // Hapus gambar jika ada
        if ($infographic->image) {
            Storage::disk('public')->delete($infographic->image);
        }
        
        $infographic->delete();

        return redirect()->route('admin.infographics.index')
            ->with('success', 'Infografis berhasil dihapus.');
    }
}
