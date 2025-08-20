<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General settings
        $generalSettings = [
            [
                'key' => 'village_name',
                'value' => 'Desa Sejahtera',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Nama Desa',
                'description' => 'Nama desa yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 1
            ],
            [
                'key' => 'village_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'label' => 'Logo Desa',
                'description' => 'Logo desa yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 2
            ],
            [
                'key' => 'welcome_message',
                'value' => 'Selamat Datang di Desa Sejahtera',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Kalimat Selamat Datang',
                'description' => 'Kalimat selamat datang yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 3
            ],
            [
                'key' => 'welcome_description',
                'value' => 'Desa yang indah dengan berbagai potensi dan keramahan masyarakatnya.',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Deskripsi Desa',
                'description' => 'Deskripsi singkat tentang desa',
                'is_public' => true,
                'order' => 4
            ],
            [
                'key' => 'village_chief_greeting',
                'value' => 'Selamat datang di desa kami. Mari bersama membangun desa yang lebih baik.',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Sambutan Kepala Desa',
                'description' => 'Sambutan kepala desa yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 5
            ],
            [
                'key' => 'village_chief_name',
                'value' => 'Bapak Slamet Riyadi',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Nama Kepala Desa',
                'description' => 'Nama kepala desa yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 6
            ],
            [
                'key' => 'village_chief_photo',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'label' => 'Foto Kepala Desa',
                'description' => 'Foto kepala desa yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 7
            ],
            [
                'key' => 'village_email',
                'value' => 'info@desasejahtera.desa.id',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Email Desa',
                'description' => 'Alamat email desa untuk kontak',
                'is_public' => true,
                'order' => 8
            ],
            [
                'key' => 'village_phone',
                'value' => '(0274) 123456',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Telepon Desa',
                'description' => 'Nomor telepon desa untuk kontak',
                'is_public' => true,
                'order' => 9
            ],
        ];
        
        // Map settings
        $mapSettings = [
            [
                'key' => 'village_latitude',
                'value' => '-7.7956',
                'type' => 'text',
                'group' => 'map',
                'label' => 'Latitude Desa',
                'description' => 'Koordinat latitude desa untuk peta',
                'is_public' => true,
                'order' => 1
            ],
            [
                'key' => 'village_longitude',
                'value' => '110.3695',
                'type' => 'text',
                'group' => 'map',
                'label' => 'Longitude Desa',
                'description' => 'Koordinat longitude desa untuk peta',
                'is_public' => true,
                'order' => 2
            ],
            [
                'key' => 'map_zoom',
                'value' => '15',
                'type' => 'number',
                'group' => 'map',
                'label' => 'Zoom Peta',
                'description' => 'Level zoom untuk peta desa',
                'is_public' => true,
                'order' => 3
            ],
            [
                'key' => 'village_coordinates',
                'value' => '-7.7956,110.3695',
                'type' => 'text',
                'group' => 'map',
                'label' => 'Koordinat Desa',
                'description' => 'Koordinat desa untuk link Google Maps (format: latitude,longitude)',
                'is_public' => true,
                'order' => 4
            ],
            [
                'key' => 'village_address',
                'value' => 'Jl. Desa Sejahtera No. 123, Kecamatan Makmur, Kabupaten Bahagia, Provinsi Damai',
                'type' => 'textarea',
                'group' => 'map',
                'label' => 'Alamat Desa',
                'description' => 'Alamat lengkap desa',
                'is_public' => true,
                'order' => 5
            ],
            [
                'key' => 'map_embed_code',
                'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1440623403906!2d110.36693731477882!3d-7.795599994384184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5787bd5b6bc5%3A0x21723fd4d3684f71!2sAlun-Alun%20Yogyakarta!5e0!3m2!1sid!2sid!4v1628478976228!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'type' => 'textarea',
                'group' => 'map',
                'label' => 'Kode Embed Peta',
                'description' => 'Kode embed peta dari Google Maps',
                'is_public' => true,
                'order' => 6
            ],
        ];
        
        // Combine all settings
        $allSettings = array_merge($generalSettings, $mapSettings);
        
        // Create settings if not exists
        foreach ($allSettings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}