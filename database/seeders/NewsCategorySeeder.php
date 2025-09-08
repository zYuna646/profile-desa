<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Pengumuman' => 'Informasi penting dari pemerintah desa',
            'Kegiatan' => 'Berbagai kegiatan yang dilaksanakan di desa',
            'Pembangunan' => 'Informasi tentang pembangunan infrastruktur desa',
            'Kesehatan' => 'Informasi seputar kesehatan masyarakat desa',
            'Pendidikan' => 'Berita tentang pendidikan di desa',
            'Sosial' => 'Kegiatan sosial dan kemasyarakatan',
            'Budaya' => 'Informasi seputar budaya dan tradisi desa'
        ];

        foreach ($categories as $name => $description) {
            NewsCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
                'is_active' => true
            ]);
        }
    }
}