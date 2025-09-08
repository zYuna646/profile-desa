<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\News;
use App\Models\Service;
use App\Models\Potential;
use App\Models\Gallery;
use App\Models\Umkm;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $staff = Staff::where('is_active', true)->get();
        $news = News::latest()->take(3)->get();
        $services = Service::all();
        $potentials = Potential::all();
        $galleries = Gallery::with('images')->get()->groupBy('category');
        $umkm = Umkm::with('category')->get();
        $generalSettings = Setting::whereIn('key', [
            'village_name',
            'welcome_message',
            'village_chief_name',
            'village_chief_photo',
            'village_chief_greeting',
            'email',
            'phone'
        ])->get()->keyBy('key');
        $mapSettings = Setting::whereIn('key', ['address'])->get()->keyBy('key');

        return view('components.landing-page', compact(
            'staff',
            'news',
            'services',
            'potentials',
            'galleries',
            'umkm',
            'generalSettings',
            'mapSettings'
        ));
    }
}