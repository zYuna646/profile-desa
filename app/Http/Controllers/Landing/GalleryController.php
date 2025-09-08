<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        return view('landing.galleries.index', compact('galleries'));
    }

    public function show(Gallery $gallery)
    {
        if (!$gallery->is_active) {
            abort(404);
        }

        return view('landing.galleries.show', compact('gallery'));
    }
}