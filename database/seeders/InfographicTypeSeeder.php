<?php

namespace Database\Seeders;

use App\Models\InfographicType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InfographicTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Demografi Penduduk',
                'description' => 'Data statistik tentang penduduk desa berdasarkan usia, jenis kelamin, pendidikan, dan pekerjaan.',
                'icon' => 'fa-users',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Ekonomi Desa',
                'description' => 'Data statistik tentang perekonomian desa termasuk UMKM, pendapatan, dan sektor ekonomi.',
                'icon' => 'fa-chart-line',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Fasilitas Desa',
                'description' => 'Data tentang fasilitas umum yang tersedia di desa seperti sekolah, tempat ibadah, dan fasilitas kesehatan.',
                'icon' => 'fa-building',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Potensi Desa',
                'description' => 'Data statistik tentang potensi desa yang dapat dikembangkan seperti pertanian, pariwisata, dan industri kreatif.',
                'icon' => 'fa-seedling',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Anggaran Desa',
                'description' => 'Data tentang anggaran desa, termasuk pendapatan, pengeluaran, dan alokasi dana desa.',
                'icon' => 'fa-money-bill-wave',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            InfographicType::create([
                'name' => $type['name'],
                'slug' => Str::slug($type['name']),
                'description' => $type['description'],
                'icon' => $type['icon'],
                'order' => $type['order'],
                'is_active' => $type['is_active'],
            ]);
        }
    }
}