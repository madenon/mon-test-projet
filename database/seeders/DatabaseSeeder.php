<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            TypeSeeder::class,
            CategorySeeder::class,
            TypeCategorySeeder::class,
            RegionSeeder::class,
            DepartmentSeeder::class,
            AdminSeeder::class,
            ChatSeeder::class,
            OfferSeeder::class,
            BadgeSeeder::class,
            InformationSeeder::class,
            RolesTableSeeder::class,
            
        ]);
    }
}
