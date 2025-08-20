<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Administrasi Kependudukan',
                'description' => 'Layanan pembuatan surat-surat kependudukan seperti KTP, KK, Akta Kelahiran, dan surat keterangan lainnya.',
                'icon' => 'fas fa-id-card',
                'image' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pelayanan Kesehatan',
                'description' => 'Layanan kesehatan masyarakat melalui Posyandu, Polindes, dan kerjasama dengan Puskesmas setempat.',
                'icon' => 'fas fa-heartbeat',
                'image' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Bantuan Sosial',
                'description' => 'Penyaluran bantuan sosial dari pemerintah pusat dan daerah kepada masyarakat yang membutuhkan.',
                'icon' => 'fas fa-hands-helping',
                'image' => null,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Pemberdayaan Masyarakat',
                'description' => 'Program pemberdayaan ekonomi masyarakat melalui pelatihan keterampilan dan bantuan modal usaha.',
                'icon' => 'fas fa-users',
                'image' => null,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Pengelolaan Sampah',
                'description' => 'Layanan pengelolaan sampah dan kebersihan lingkungan desa untuk menciptakan lingkungan yang sehat.',
                'icon' => 'fas fa-recycle',
                'image' => null,
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}