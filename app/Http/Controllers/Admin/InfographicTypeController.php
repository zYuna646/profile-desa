<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfographicType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InfographicTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = InfographicType::orderBy('order')->paginate(10);
        return view('admin.infographic-types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.infographic-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:infographic_types',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);


        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        InfographicType::create($validated);

        return redirect()->route('admin.infographic-types.index')
            ->with('success', 'Tipe infografis berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InfographicType $infographicType)
    {
        return view('admin.infographic-types.show', compact('infographicType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InfographicType $infographicType)
    {
        return view('admin.infographic-types.edit', compact('infographicType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InfographicType $infographicType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('infographic_types')->ignore($infographicType)],
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $infographicType->update($validated);

        return redirect()->route('admin.infographic-types.index')
            ->with('success', 'Tipe infografis berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfographicType $infographicType)
    {
        $infographicType->delete();

        return redirect()->route('admin.infographic-types.index')
            ->with('success', 'Tipe infografis berhasil dihapus.');
    }
}
