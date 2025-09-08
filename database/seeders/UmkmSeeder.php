<?php

namespace Database\Seeders;

use App\Models\Umkm;
use App\Models\UmkmCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        $makananCategory = UmkmCategory::where('slug', 'makanan-dan-minuman')->first();
        $kerajinanCategory = UmkmCategory::where('slug', 'kerajinan-tangan')->first();
        $pertanianCategory = UmkmCategory::where('slug', 'pertanian')->first();

        $umkmData = [
            [
                'category_id' => $makananCategory->id,
                'name' => 'Kue Tradisional Bu Siti',
                'owner' => 'Siti Aminah',
                'description' => 'Menjual berbagai macam kue tradisional yang dibuat dengan bahan berkualitas',
                'price' => 25000,
                'rating' => 4.5,
                'reviews' => 28,
                'phone' => '08123456789',
                'address' => 'Jl. Desa Makmur No. 10',
            ],
            [
                'category_id' => $kerajinanCategory->id,
                'name' => 'Anyaman Bambu Pak Rudi',
                'owner' => 'Rudi Hartono',
                'description' => 'Kerajinan anyaman bambu berkualitas tinggi dengan berbagai model',
                'price' => 150000,
                'rating' => 4.8,
                'reviews' => 15,
                'phone' => '08234567890',
                'address' => 'Jl. Desa Makmur No. 25',
            ],
            [
                'category_id' => $pertanianCategory->id,
                'name' => 'Sayur Organik Tani Jaya',
                'owner' => 'Ahmad Subarjo',
                'description' => 'Menyediakan sayuran organik segar langsung dari kebun',
                'price' => 15000,
                'rating' => 4.7,
                'reviews' => 42,
                'phone' => '08345678901',
                'address' => 'Jl. Desa Makmur No. 50',
            ],
        ];

        foreach ($umkmData as $data) {
            Umkm::create([
                'category_id' => $data['category_id'],
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'owner' => $data['owner'],
                'description' => $data['description'],
                'price' => $data['price'],
                'rating' => $data['rating'],
                'reviews' => $data['reviews'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'is_active' => true,
            ]);
        }
    }
}