<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UmkmCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UmkmCategoryController extends Controller
{
    public function index()
    {
        $categories = UmkmCategory::withCount('umkm')->latest()->paginate(10);
        return view('admin.umkm.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.umkm.categories.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        UmkmCategory::create($validated);

        return redirect()->route('admin.umkm.categories.index')
            ->with('success', 'Kategori UMKM berhasil ditambahkan');
    }

    public function edit(UmkmCategory $category)
    {
        return view('admin.umkm.categories.form', compact('category'));
    }

    public function update(Request $request, UmkmCategory $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.umkm.categories.index')
            ->with('success', 'Kategori UMKM berhasil diperbarui');
    }

    public function destroy(UmkmCategory $category)
    {
        if ($category->umkm()->count() > 0) {
            return redirect()->route('admin.umkm.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki UMKM terkait');
        }

        $category->delete();

        return redirect()->route('admin.umkm.categories.index')
            ->with('success', 'Kategori UMKM berhasil dihapus');
    }
}