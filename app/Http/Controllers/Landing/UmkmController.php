<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmCategory;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Umkm::where('is_active', true);
        $category = null;

        if ($request->has('category')) {
            $category = UmkmCategory::where('slug', $request->category)->firstOrFail();
            $query->where('category_id', $category->id);
        }

        $umkm = $query->with(['category', 'images'])
            ->latest()
            ->paginate(12);

        $categories = UmkmCategory::active()->get();

        return view('landing.umkm.index', compact('umkm', 'categories', 'category'));
    }

    public function show(Umkm $umkm)
    {
        if (!$umkm->is_active) {
            abort(404);
        }

        $umkm->load(['category', 'images']);

        return view('landing.umkm.show', compact('umkm'));
    }
}