<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order')
            ->get();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $gallery = Gallery::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $gallery->images()->create([
                    'image' => $image->store('galleries', 'public'),
                    'order' => $index,
                    'is_active' => true
                ]);
            }
        }

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'delete_images.*' => 'nullable|integer'
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Update gallery data
        $gallery->update($validated);

        // Delete selected images
        if ($request->has('delete_images')) {
            $imagesToDelete = $gallery->images()->whereIn('id', $request->delete_images)->get();
            foreach ($imagesToDelete as $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }
        }

        // Add new images
        if ($request->hasFile('images')) {
            $lastOrder = $gallery->images()->max('order') ?? -1;
            foreach ($request->file('images') as $image) {
                $lastOrder++;
                $gallery->images()->create([
                    'image' => $image->store('galleries', 'public'),
                    'order' => $lastOrder,
                    'is_active' => true
                ]);
            }
        }

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete all gallery images
        foreach ($gallery->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $gallery->delete(); // This will also delete related images due to cascadeOnDelete

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}