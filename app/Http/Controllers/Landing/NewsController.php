<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::where('is_active', true);

        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category)
                  ->where('is_active', true);
            });
        }

        $news = $query->latest()->paginate(9);

        return view('landing.news.index', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Increment view count
        $news->increment('views');

        return view('landing.news.show', compact('news'));
    }
}