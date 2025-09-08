<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function adminDashboard()
    {
        $stats = [
            'users' => User::count(),
            'news' => News::count(),
            'services' => Service::count(),
            'visitors_today' => 0 // Implement visitor tracking later
        ];

        $recentNews = News::latest()->take(5)->get();
        $recentActivities = News::select(
            DB::raw("'news' as type"),
            'title as description',
            'created_at'
        )->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentNews', 'recentActivities'));
    }
}