<?php

namespace App\Http\Controllers;

use App\Models\Potential;
use App\Models\Service;
use App\Models\Setting;
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

        return view('components.landing-page', compact(
            'generalSettings',
            'mapSettings',
            'services',
            'potentials'
        ));
    }
}