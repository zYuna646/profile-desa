<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Navigation;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua navigasi dengan relasi children dan parent
        $navigations = Navigation::with(['children', 'parent'])
            ->orderBy('order')
            ->paginate(10);
            
        return view('admin.navigations.index', compact('navigations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Navigation::whereNull('parent_id')->get();
        $routes = $this->getAvailableRoutes();
        $news = News::where('is_active', true)->orderBy('title')->get();
        
        return view('admin.navigations.create', compact('parents', 'routes', 'news'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi dasar
        $rules = [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:navigations,id',
            'type' => 'required|in:route',
            'icon' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_external' => 'boolean',
            'route' => 'required|string',
            'news_id' => 'nullable|exists:news,id',
            'url' => 'nullable',
        ];
        
        $validated = $request->validate($rules);
        
        Navigation::create($validated);
        
        return redirect()->route('admin.navigations.index')
            ->with('success', 'Navigasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $navigation = Navigation::with('children')->findOrFail($id);
        return view('admin.navigations.show', compact('navigation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $navigation = Navigation::findOrFail($id);
        $parents = Navigation::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->get();
        $routes = $this->getAvailableRoutes();
        $news = News::where('is_active', true)->orderBy('title')->get();
        
        return view('admin.navigations.edit', compact('navigation', 'parents', 'routes', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $navigation = Navigation::findOrFail($id);
        
        // Validasi dasar
        $rules = [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:navigations,id',
            'type' => 'required|in:route',
            'icon' => 'nullable|string',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_external' => 'boolean',
            'route' => 'required|string',
            'news_id' => 'nullable|exists:news,id',
            'url' => 'nullable',
        ];
        
        $validated = $request->validate($rules);
        
        // Pastikan tidak menjadikan dirinya sendiri sebagai parent
        if ($validated['parent_id'] == $id) {
            return back()->withErrors(['parent_id' => 'Navigasi tidak dapat menjadi parent dari dirinya sendiri.'])->withInput();
        }
        
        $navigation->update($validated);
        
        return redirect()->route('admin.navigations.index')
            ->with('success', 'Navigasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $navigation = Navigation::findOrFail($id);
        $navigation->delete();
        
        return redirect()->route('admin.navigations.index')
            ->with('success', 'Navigasi berhasil dihapus.');
    }
    
    /**
     * Get available routes for navigation
     */
    private function getAvailableRoutes()
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return $route->getName();
        })->filter()->sort()->values();
        
        // Filter hanya route yang relevan untuk landing page
        return $routes->filter(function ($route) {
            // Exclude admin routes dan route yang tidak relevan
            return !str_starts_with($route, 'admin.') && 
                   !str_starts_with($route, 'dashboard.') && 
                   !str_starts_with($route, 'profile.') && 
                   !str_starts_with($route, 'password.') && 
                   !str_starts_with($route, 'verification.') && 
                   !str_starts_with($route, 'login') && 
                   !str_starts_with($route, 'logout') && 
                   !str_starts_with($route, 'register');
        })->values();
    }
}
