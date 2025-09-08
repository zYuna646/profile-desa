<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.form');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'position' => 'required|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'is_active' => 'boolean'
            ], [
                'name.required' => 'Nama harus diisi',
                'name.max' => 'Nama tidak boleh lebih dari 255 karakter',
                'phone_number.required' => 'Nomor telepon harus diisi',
                'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter',
                'gender.required' => 'Jenis kelamin harus dipilih',
                'gender.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
                'position.required' => 'Jabatan harus diisi',
                'position.max' => 'Jabatan tidak boleh lebih dari 255 karakter',
                'photo.image' => 'File harus berupa gambar',
                'photo.mimes' => 'Format gambar harus jpeg, png, atau jpg',
                'photo.max' => 'Ukuran gambar tidak boleh lebih dari 2MB'
            ]);

            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')->store('staff-photos', 'public');
            }

            Staff::create($validated);

            return redirect()->route('admin.staff.index')
                ->with('success', 'Data staff berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan data staff')
                ->withInput();
        }
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.form', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'position' => 'required|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'is_active' => 'boolean'
            ], [
                'name.required' => 'Nama harus diisi',
                'name.max' => 'Nama tidak boleh lebih dari 255 karakter',
                'phone_number.required' => 'Nomor telepon harus diisi',
                'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter',
                'gender.required' => 'Jenis kelamin harus dipilih',
                'gender.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
                'position.required' => 'Jabatan harus diisi',
                'position.max' => 'Jabatan tidak boleh lebih dari 255 karakter',
                'photo.image' => 'File harus berupa gambar',
                'photo.mimes' => 'Format gambar harus jpeg, png, atau jpg',
                'photo.max' => 'Ukuran gambar tidak boleh lebih dari 2MB'
            ]);

            if ($request->hasFile('photo')) {
                if ($staff->photo) {
                    Storage::disk('public')->delete($staff->photo);
                }
                $validated['photo'] = $request->file('photo')->store('staff-photos', 'public');
            }

            $staff->update($validated);

            return redirect()->route('admin.staff.index')
                ->with('success', 'Data staff berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data staff')
                ->withInput();
        }
    }

    public function destroy(Staff $staff)
    {
        try {
            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
            $staff->delete();

            return redirect()->route('admin.staff.index')
                ->with('success', 'Data staff berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data staff');
        }
    }
}