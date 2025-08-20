<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Potential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PotentialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $potentials = Potential::orderBy('order')->paginate(10);
        return view('admin.potentials.index', compact('potentials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.potentials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('_token', 'image');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('potentials', 'public');
            $data['image'] = $path;
        }
        
        // Set default values
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->input('order', 0);
        
        Potential::create($data);
        
        return redirect()->route('admin.potentials.index')
            ->with('success', 'Potensi desa berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $potential = Potential::findOrFail($id);
        return view('admin.potentials.edit', compact('potential'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $potential = Potential::findOrFail($id);
        $data = $request->except('_token', '_method', 'image');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($potential->image && Storage::exists('public/' . $potential->image)) {
                Storage::delete('public/' . $potential->image);
            }
            
            $path = $request->file('image')->store('potentials', 'public');
            $data['image'] = $path;
        }
        
        // Set default values
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->input('order', 0);
        
        $potential->update($data);
        
        return redirect()->route('admin.potentials.index')
            ->with('success', 'Potensi desa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $potential = Potential::findOrFail($id);
        
        // Delete image if exists
        if ($potential->image && Storage::exists('public/' . $potential->image)) {
            Storage::delete('public/' . $potential->image);
        }
        
        $potential->delete();
        
        return redirect()->route('admin.potentials.index')
            ->with('success', 'Potensi desa berhasil dihapus');
    }
}
