<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\UmkmCategory;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $categories = UmkmCategory::active()->get();
        $category = null;

        $query = Umkm::with('category')->active();

        if ($request->has('category')) {
            $category = UmkmCategory::where('slug', $request->category)->firstOrFail();
            $query->where('category_id', $category->id);
        }

        $umkm = $query->latest()->paginate(12);

        return view('umkm.index', compact('umkm', 'categories', 'category'));
    }

    public function show(Umkm $umkm)
    {
        abort_if(!$umkm->is_active, 404);

        $relatedUmkm = Umkm::active()
            ->where('category_id', $umkm->category_id)
            ->where('id', '!=', $umkm->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('umkm.show', compact('umkm', 'relatedUmkm'));
    }
}