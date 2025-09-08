<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = [
            [
                'name' => 'IMRAN, SE',
                'phone_number' => '82217975625',
                'gender' => 'Laki-laki',
                'position' => 'PJ. KADES',
                'is_active' => true
            ],
            [
                'name' => 'MEY NURLAILA ABDURAHMAN',
                'phone_number' => '82271614956',
                'gender' => 'Perempuan',
                'position' => 'SEKDES',
                'is_active' => true
            ],
            [
                'name' => 'RUKIYANI NTUGE',
                'phone_number' => '82192129098',
                'gender' => 'Perempuan',
                'position' => 'KASIE PEMERINTAHAN',
                'is_active' => true
            ],
            [
                'name' => 'ZULFA HELINGO',
                'phone_number' => '82194489673',
                'gender' => 'Perempuan',
                'position' => 'KASIE KESRA',
                'is_active' => true
            ],
            [
                'name' => 'SITI ZOHRA ABDDULLAH',
                'phone_number' => '85240365022',
                'gender' => 'Perempuan',
                'position' => 'KAUR KEUANGAN',
                'is_active' => true
            ],
            [
                'name' => 'AFRIANTI DJAFAR',
                'phone_number' => '85311505624',
                'gender' => 'Perempuan',
                'position' => 'KAUR UMUM PEREN',
                'is_active' => true
            ],
            [
                'name' => 'SITI RIFKA SUMA',
                'phone_number' => '82323627381',
                'gender' => 'Perempuan',
                'position' => 'KADUS 1',
                'is_active' => true
            ],
            [
                'name' => 'BOBY GALA',
                'phone_number' => '87772690601',
                'gender' => 'Perempuan',
                'position' => 'KADUS 2',
                'is_active' => true
            ],
            [
                'name' => 'ZULKIFLI NTUGE',
                'phone_number' => '82292463968',
                'gender' => 'Laki-laki',
                'position' => 'KADUS 3',
                'is_active' => true
            ],
        ];

        foreach ($staff as $data) {
            Staff::create($data);
        }
    }
}