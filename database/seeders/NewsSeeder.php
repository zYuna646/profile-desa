<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $pembangunan = NewsCategory::where('slug', 'pembangunan')->first();
        $pendidikan = NewsCategory::where('slug', 'pendidikan')->first();
        $kegiatan = NewsCategory::where('slug', 'kegiatan')->first();

        $news = [
            [
                'title' => 'Pembangunan Jalan Desa Tahap 1 Selesai',
                'content' => '<p>Pembangunan jalan desa tahap 1 telah selesai dilaksanakan. Jalan sepanjang 2 kilometer ini menghubungkan dusun A dengan dusun B. Pembangunan ini menggunakan dana desa tahun anggaran 2023.</p><p>Kepala desa menyampaikan bahwa pembangunan ini akan dilanjutkan ke tahap 2 yang menghubungkan dusun B dengan dusun C pada tahun anggaran berikutnya.</p>',
                'is_active' => true,
                'views' => 150,
                'category_id' => $pembangunan->id
            ],
            [
                'title' => 'Pelatihan Keterampilan Digital untuk Pemuda Desa',
                'content' => '<p>Program pelatihan keterampilan digital untuk pemuda desa telah dilaksanakan selama 3 hari di balai desa. Pelatihan ini diikuti oleh 30 pemuda desa yang antusias belajar tentang media sosial, desain grafis, dan pemasaran digital.</p><p>Program ini bertujuan untuk meningkatkan kemampuan digital pemuda desa agar dapat bersaing di era digital.</p>',
                'is_active' => true,
                'views' => 200,
                'category_id' => $pendidikan->id
            ],
            [
                'title' => 'Panen Raya Padi Organik Sukses Besar',
                'content' => '<p>Kelompok tani desa berhasil melakukan panen raya padi organik dengan hasil yang memuaskan. Hasil panen mencapai 7 ton per hektar, meningkat 20% dari panen sebelumnya.</p><p>Keberhasilan ini tidak lepas dari penerapan teknologi pertanian organik dan dukungan penyuluh pertanian yang intensif mendampingi petani.</p>',
                'is_active' => true,
                'views' => 175,
                'category_id' => $kegiatan->id
            ]
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}