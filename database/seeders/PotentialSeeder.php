<?php

namespace Database\Seeders;

use App\Models\Potential;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PotentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $potentials = [
            [
                'title' => 'Pertanian Organik',
                'description' => 'Lahan pertanian organik yang menghasilkan beras, sayuran, dan buah-buahan berkualitas tinggi tanpa pestisida kimia.',
                'icon' => 'fas fa-seedling',
                'image' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Kerajinan Bambu',
                'description' => 'Kerajinan bambu tradisional yang diproduksi oleh pengrajin lokal dengan kualitas ekspor.',
                'icon' => 'fas fa-paint-brush',
                'image' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Wisata Alam',
                'description' => 'Potensi wisata alam berupa air terjun, sungai jernih, dan pemandangan alam yang indah.',
                'icon' => 'fas fa-mountain',
                'image' => null,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Budidaya Ikan',
                'description' => 'Budidaya ikan air tawar seperti lele, nila, dan gurami yang menjadi sumber pendapatan masyarakat.',
                'icon' => 'fas fa-fish',
                'image' => null,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Kuliner Tradisional',
                'description' => 'Makanan dan jajanan tradisional khas desa yang berpotensi menjadi daya tarik wisata kuliner.',
                'icon' => 'fas fa-utensils',
                'image' => null,
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($potentials as $potential) {
            Potential::firstOrCreate(
                ['title' => $potential['title']],
                $potential
            );
        }
    }
}