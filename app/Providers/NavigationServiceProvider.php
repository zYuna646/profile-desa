<?php

namespace App\Providers;

use App\Models\Navigation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Hanya jalankan jika tabel navigations sudah ada
        if (Schema::hasTable('navigations')) {
            // Gunakan navigasi default dari config untuk main menu
            $defaultNavigation = Config::get('navigation.main_menu', []);
            
            // Set konfigurasi navigasi main menu hanya menggunakan default dari config
            Config::set('navigation.main_menu', $defaultNavigation);
            
            // Ambil navigasi kustom (semua navigasi dari database) untuk second nav
            $customNavigation = $this->getCustomNavigation();
            
            // Set konfigurasi navigasi kustom
            Config::set('navigation.custom_menu', $customNavigation);
            
            // Bagikan data navigasi ke semua view
            View::share('navigation', $defaultNavigation);
            View::share('custom_navigation', $customNavigation);
        }
    }
    

    /**
     * Ambil semua navigasi dari database untuk navigasi kedua
     */
    private function getCustomNavigation(): array
    {
        try {
            // Ambil semua navigasi utama (parent_id = null) yang aktif
            $navigations = Navigation::where('parent_id', null)
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
            
            $customNavigation = [];
            
            // Ambil semua child navigations yang aktif untuk dikelompokkan
            $childNavigations = Navigation::whereNotNull('parent_id')
                ->where('is_active', true)
                ->orderBy('order')
                ->get()
                ->groupBy('parent_id');
            
            foreach ($navigations as $nav) {
                $navItem = [
                    'name' => $nav->name,
                    'icon' => $nav->icon ?? '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>'
                ];
                
                try {
                    // Gunakan accessor url untuk mendapatkan URL yang benar
                    if ($nav->is_external) {
                        $navItem['external_url'] = $nav->url;
                    } else if ($nav->news_id) {
                        // Jika ada news_id, cari berita dan gunakan slug untuk URL
                        $news = \App\Models\News::find($nav->news_id);
                        if ($news && $news->slug) {
                            try {
                                $navItem['href'] = route('landing.news.show', $news->slug);
                                \Log::info('news'. $news->title .'news'. $nav->news_id);
                            } catch (\Exception $e) {
                                // Jika route tidak ditemukan, gunakan URL manual
                                $navItem['href'] = '/berita/' . $news->slug;
                                \Log::info('Using manual URL for news: /berita/' . $news->slug);
                            }
                        } else {
                            // Jika berita tidak ditemukan atau tidak memiliki slug, gunakan # sebagai fallback
                            $navItem['href'] = '#';
                            \Log::warning('News not found or has no slug for navigation "' . $nav->name . '" with news_id ' . $nav->news_id);
                        }
                    } else {
                        // Untuk route internal, gunakan accessor url yang sudah menangani kasus khusus
                        $navItem['href'] = $nav->url;
                    }
                } catch (\Exception $routeException) {
                    // Jika terjadi error pada route, gunakan # sebagai fallback
                    $navItem['href'] = '#';
                    \Log::warning('Route error for custom navigation "' . $nav->name . '": ' . $routeException->getMessage());
                }
                
                // Tambahkan children jika ada
                if (isset($childNavigations[$nav->id])) {
                    $navItem['children'] = [];
                    
                    foreach ($childNavigations[$nav->id] as $child) {
                        $childItem = [
                            'name' => $child->name,
                            'icon' => $child->icon ?? '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>'
                        ];
                        
                        try {
                            if ($child->is_external) {
                                $childItem['external_url'] = $child->url;
                            } else if ($child->news_id) {
                                // Jika ada news_id, cari berita dan gunakan slug untuk URL
                                $news = \App\Models\News::find($child->news_id);
                                if ($news && $news->slug) {
                                    try {
                                        $childItem['href'] = route('landing.news.show', $news->slug);
                                        \Log::info('news'. $news->title .'news'. $child->news_id);
                                    } catch (\Exception $e) {
                                        // Jika route tidak ditemukan, gunakan URL manual
                                        $childItem['href'] = '/berita/' . $news->slug;
                                        \Log::info('Using manual URL for news: /berita/' . $news->slug);
                                    }
                                } else {
                                    // Jika berita tidak ditemukan atau tidak memiliki slug, gunakan # sebagai fallback
                                    $childItem['href'] = '#';
                                    \Log::warning('News not found or has no slug for navigation "' . $child->name . '" with news_id ' . $child->news_id);
                                }
                            } else {
                                $childItem['href'] = $child->url;
                            }
                        } catch (\Exception $routeException) {
                            $childItem['href'] = '#';
                            \Log::warning('Route error for child navigation "' . $child->name . '": ' . $routeException->getMessage());
                        }
                        
                        $navItem['children'][] = $childItem;
                    }
                }
                
                // Tambahkan ke array navigasi kustom
                $customNavigation[] = $navItem;
            }
            
            return $customNavigation;
        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            \Log::error('Error loading custom navigation: ' . $e->getMessage());
            return [];
        }
    }
}
