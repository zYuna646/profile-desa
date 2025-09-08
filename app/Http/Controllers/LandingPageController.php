<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Potential;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\Umkm;
use App\Models\Gallery;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display the landing page with content from settings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all general settings
        $generalSettings = Setting::where('group', 'general')
            ->where('is_public', true)
            ->get()
            ->keyBy('key');

        // Get map settings
        $mapSettings = Setting::where('group', 'map')
            ->where('is_public', true)
            ->get()
            ->keyBy('key');

        // Get active services ordered by order field
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Get active potentials ordered by order field
        $potentials = Potential::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Get latest active news
        $news = News::where('is_active', true)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => $item->title,
                    'excerpt' => str()->limit(strip_tags($item->content), 150),
                    'image' => $item->image ? asset('storage/' . $item->image) : null,
                    'date' => $item->created_at->format('d F Y'),
                    'category' => $item->category ? $item->category->name : 'Umum',
                    'url' => route('landing.news.show', $item->slug)
                ];
            });

        // Get active UMKM
        $umkm = Umkm::where('is_active', true)
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->name,
                    'owner' => $item->owner,
                    'image' => $item->image ? asset('storage/' . $item->image) : null,
                    'category' => $item->category ? $item->category->name : 'Umum',
                    'rating' => $item->rating,
                    'reviews' => $item->reviews,
                    'price' => $item->formatted_price,
                    'url' => route('umkm.show', ['umkm' => $item])
                ];
            });

        // Get active galleries ordered by order field
        $galleries = Gallery::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        // Get active staff members
        $staff = Staff::where('is_active', true)
            ->latest()
            ->take(5)
            ->get();

        return view('components.landing-page', compact(
            'generalSettings',
            'mapSettings',
            'services',
            'potentials',
            'news',
            'umkm',
            'galleries',
            'staff'
        ));
    }
}