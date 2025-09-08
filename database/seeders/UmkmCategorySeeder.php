<?php

namespace Database\Seeders;

use App\Models\UmkmCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UmkmCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makanan dan Minuman',
                'description' => 'Produk makanan dan minuman olahan UMKM desa',
            ],
            [
                'name' => 'Kerajinan Tangan',
                'description' => 'Produk kerajinan tangan dari pengrajin desa',
            ],
            [
                'name' => 'Pertanian',
                'description' => 'Hasil pertanian dan produk olahan pertanian',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Produk fashion dan aksesoris buatan warga desa',
            ],
            [
                'name' => 'Jasa',
                'description' => 'Layanan jasa yang disediakan oleh warga desa',
            ],
        ];

        foreach ($categories as $category) {
            UmkmCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => true,
            ]);
        }
    }
}