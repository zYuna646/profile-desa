<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generalSettings = Setting::where('group', 'general')->orderBy('order')->get();
        $mapSettings = Setting::where('group', 'map')->orderBy('order')->get();
        
        return view('admin.settings.index', compact('generalSettings', 'mapSettings'));
    }

    /**
     * Update the specified settings in storage.
     */
    public function update(Request $request)
    {
        $settings = $request->except('_token', '_method');
        
        foreach ($settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting) {
                // Handle file uploads
                if ($setting->type == 'image' && $request->hasFile($key)) {
                    $file = $request->file($key);
                    
                    // Validate file
                    $validator = Validator::make([$key => $file], [
                        $key => 'image|mimes:jpeg,png,jpg,gif,svg',
                    ]);
                    
                    if ($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
                    }
                    
                    // Delete old file if exists
                    if ($setting->value && Storage::exists('public/' . $setting->value)) {
                        Storage::delete('public/' . $setting->value);
                    }
                    
                    // Store new file
                    $path = $file->store('settings', 'public');
                    $value = $path;
                }
                
                $setting->update(['value' => $value]);
            }
        }
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui');
    }
    
    /**
     * Initialize default settings
     */
    public function initializeSettings()
    {
        // General settings
        $generalSettings = [
            [
                'key' => 'village_name',
                'value' => 'Nama Desa',
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
                'value' => 'Selamat datang di website desa kami',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Kalimat Selamat Datang',
                'description' => 'Kalimat selamat datang yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 3
            ],
            [
                'key' => 'village_chief_greeting',
                'value' => 'Sambutan Kepala Desa',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Sambutan Kepala Desa',
                'description' => 'Sambutan kepala desa yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 4
            ],
            [
                'key' => 'village_chief_name',
                'value' => 'Nama Kepala Desa',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Nama Kepala Desa',
                'description' => 'Nama kepala desa yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 5
            ],
            [
                'key' => 'village_chief_photo',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'label' => 'Foto Kepala Desa',
                'description' => 'Foto kepala desa yang akan ditampilkan di landing page',
                'is_public' => true,
                'order' => 6
            ],
            [
                'key' => 'email',
                'value' => 'desa@example.com',
                'type' => 'email',
                'group' => 'general',
                'label' => 'Email Desa',
                'description' => 'Email kontak desa',
                'is_public' => true,
                'order' => 7
            ],
            [
                'key' => 'phone',
                'value' => '+62 123 4567 890',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Nomor Telepon',
                'description' => 'Nomor telepon kontak desa',
                'is_public' => true,
                'order' => 8
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
                'key' => 'address',
                'value' => 'Jl. Desa No. 123',
                'type' => 'text',
                'group' => 'map',
                'label' => 'Alamat Desa',
                'description' => 'Alamat lengkap desa',
                'is_public' => true,
                'order' => 4
            ],
            [
                'key' => 'coordinates',
                'value' => '-7.7956, 110.3695',
                'type' => 'text',
                'group' => 'map',
                'label' => 'Koordinat',
                'description' => 'Koordinat desa (latitude, longitude)',
                'is_public' => true,
                'order' => 5
            ],
            [
                'key' => 'map_embed',
                'value' => '',
                'type' => 'textarea',
                'group' => 'map',
                'label' => 'Embed Code Peta',
                'description' => 'Kode embed Google Maps atau peta lainnya',
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
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan default berhasil diinisialisasi');
    }
}
