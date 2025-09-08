<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::latest()->paginate(10);
        return view('admin.news-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.news-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        NewsCategory::create($validated);

        return redirect()->route('admin.news-categories.index')
            ->with('success', 'Kategori berita berhasil ditambahkan.');
    }

    public function edit(NewsCategory $category)
    {
        return view('admin.news-categories.edit', compact('category'));
    }

    public function update(Request $request, NewsCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        $category->update($validated);

        return redirect()->route('admin.news-categories.index')
            ->with('success', 'Kategori berita berhasil diperbarui.');
    }

    public function destroy(NewsCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.news-categories.index')
            ->with('success', 'Kategori berita berhasil dihapus.');
    }
}