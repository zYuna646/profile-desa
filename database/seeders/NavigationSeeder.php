<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua navigasi yang ada
        Navigation::truncate();
        
        // Buat navigasi utama
        $navigations = [
            [
                'name' => 'Beranda',
                'route' => 'home',
                'url' => null,
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>',
                'parent_id' => null,
                'order' => 1,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'name' => 'Organisasi',
                'route' => 'organization',
                'url' => null,
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>',
                'parent_id' => null,
                'order' => 2,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'name' => 'Berita',
                'route' => 'landing.news.index',
                'url' => null,
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                    <path d="M15 7h1a2 2 0 012 2v6a2 2 0 01-2 2h-1V7z" />
                </svg>',
                'parent_id' => null,
                'order' => 3,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'name' => 'UMKM Desa',
                'route' => 'umkm.index',
                'url' => null,
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                </svg>',
                'parent_id' => null,
                'order' => 4,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'name' => 'Galeri',
                'route' => 'landing.galleries.index',
                'url' => null,
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                </svg>',
                'parent_id' => null,
                'order' => 5,
                'is_active' => true,
                'is_external' => false,
            ],
            [
                'name' => 'Website Desa',
                'route' => null,
                'url' => 'https://www.example.com',
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                </svg>',
                'parent_id' => null,
                'order' => 6,
                'is_active' => true,
                'is_external' => true,
            ],
        ];
        
        // Simpan navigasi ke database
        foreach ($navigations as $nav) {
            Navigation::create($nav);
        }
    }
}