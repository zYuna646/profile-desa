<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmCategory;
use App\Models\UmkmImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UmkmController extends Controller
{
    public function index()
    {
        $umkm = Umkm::with('category')->latest()->paginate(10);
        return view('admin.umkm.index', compact('umkm'));
    }

    public function create()
    {
        $categories = UmkmCategory::active()->get();
        return view('admin.umkm.form', compact('categories'));
    }

    public function store(Request $request)
    {
        Log::info('data', [
            'data' => $request->all(),
        ]);
        try {
            $validated = $request->validate([
                'category_id' => ['required', 'exists:umkm_categories,id'],
                'name' => ['required', 'string', 'max:255'],
                'owner' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
                'additional_images.*' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
                'price' => ['required', 'numeric', 'min:0'],
                'phone' => ['nullable', 'string', 'max:20'],
                'address' => ['nullable', 'string', 'max:255'],
                'is_active' => ['boolean'],
            ], [
                'category_id.required' => 'Kategori UMKM wajib dipilih',
                'category_id.exists' => 'Kategori UMKM tidak valid',
                'name.required' => 'Nama UMKM wajib diisi',
                'name.max' => 'Nama UMKM maksimal 255 karakter',
                'owner.required' => 'Nama pemilik wajib diisi',
                'owner.max' => 'Nama pemilik maksimal 255 karakter',
                'description.required' => 'Deskripsi wajib diisi',
                'image.image' => 'File harus berupa gambar',
                'image.max' => 'Ukuran gambar maksimal 2MB',
                'image.mimes' => 'Format gambar harus jpeg, png, atau jpg',
                'additional_images.*.image' => 'File harus berupa gambar',
                'additional_images.*.max' => 'Ukuran gambar maksimal 2MB',
                'additional_images.*.mimes' => 'Format gambar harus jpeg, png, atau jpg',
                'price.required' => 'Harga wajib diisi',
                'price.numeric' => 'Harga harus berupa angka',
                'price.min' => 'Harga minimal 0',
                'phone.max' => 'Nomor telepon maksimal 20 karakter',
                'address.max' => 'Alamat maksimal 255 karakter',
            ]);

            $validated['slug'] = Str::slug($validated['name']);
            
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('umkm', 'public');
            }

            $umkm = Umkm::create($validated);

            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $index => $image) {
                    $umkm->images()->create([
                        'image' => $image->store('umkm', 'public'),
                        'order' => $index + 1
                    ]);
                }
            }

            return redirect()->route('admin.umkm.index')
                ->with('success', 'UMKM berhasil ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::info("error", [
                'data' => $e->validator->errors(),
            ]);
            return back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
                  Log::info("error", [
                'data' => $e->getMessage(),
            ]);
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan UMKM. Silakan coba lagi.');
        }
    }

    public function edit(Umkm $umkm)
    {
        $categories = UmkmCategory::active()->get();
        return view('admin.umkm.form', compact('umkm', 'categories'));
    }

    public function update(Request $request, Umkm $umkm)
    {
        try {
            $validated = $request->validate([
                'category_id' => ['required', 'exists:umkm_categories,id'],
                'name' => ['required', 'string', 'max:255'],
                'owner' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
                'additional_images.*' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
                'price' => ['required', 'numeric', 'min:0'],
                'phone' => ['nullable', 'string', 'max:20'],
                'address' => ['nullable', 'string', 'max:255'],
                'is_active' => ['boolean'],
            ], [
                'category_id.required' => 'Kategori UMKM wajib dipilih',
                'category_id.exists' => 'Kategori UMKM tidak valid',
                'name.required' => 'Nama UMKM wajib diisi',
                'name.max' => 'Nama UMKM maksimal 255 karakter',
                'owner.required' => 'Nama pemilik wajib diisi',
                'owner.max' => 'Nama pemilik maksimal 255 karakter',
                'description.required' => 'Deskripsi wajib diisi',
                'image.image' => 'File harus berupa gambar',
                'image.max' => 'Ukuran gambar maksimal 2MB',
                'image.mimes' => 'Format gambar harus jpeg, png, atau jpg',
                'additional_images.*.image' => 'File harus berupa gambar',
                'additional_images.*.max' => 'Ukuran gambar maksimal 2MB',
                'additional_images.*.mimes' => 'Format gambar harus jpeg, png, atau jpg',
                'price.required' => 'Harga wajib diisi',
                'price.numeric' => 'Harga harus berupa angka',
                'price.min' => 'Harga minimal 0',
                'phone.max' => 'Nomor telepon maksimal 20 karakter',
                'address.max' => 'Alamat maksimal 255 karakter',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            if ($request->hasFile('image')) {
                if ($umkm->image) {
                    Storage::disk('public')->delete($umkm->image);
                }
                $validated['image'] = $request->file('image')->store('umkm', 'public');
            }

            $umkm->update($validated);

            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $index => $image) {
                    $umkm->images()->create([
                        'image' => $image->store('umkm', 'public'),
                        'order' => $umkm->images->count() + $index + 1
                    ]);
                }
            }

            return redirect()->route('admin.umkm.index')
                ->with('success', 'UMKM berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui UMKM. Silakan coba lagi.');
        }
    }

    public function destroy(Umkm $umkm)
    {
        try {
            if ($umkm->image) {
                Storage::disk('public')->delete($umkm->image);
            }

            foreach ($umkm->images as $image) {
                Storage::disk('public')->delete($image->image);
            }
            
            $umkm->delete();

            return redirect()->route('admin.umkm.index')
                ->with('success', 'UMKM berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus UMKM. Silakan coba lagi.');
        }
    }

    public function deleteImage(UmkmImage $image)
    {
        try {
            Storage::disk('public')->delete($image->image);
            $image->delete();

            return response()->json(['message' => 'Foto berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus foto'], 500);
        }
    }
}