<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,
            SettingSeeder::class,
            ServiceSeeder::class,
            PotentialSeeder::class,
            NewsCategorySeeder::class,
            NewsSeeder::class,
            UmkmCategorySeeder::class,
            UmkmSeeder::class,
            StaffSeeder::class,
            NavigationSeeder::class,
            InfographicTypeSeeder::class,
        ]);
    }
}
