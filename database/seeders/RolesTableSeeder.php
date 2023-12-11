<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'slug' => 'administrateur',
            'name' => 'admin',
            'permissions' => json_encode(['admin' => true, 'user' => true]),
        ]);

        Role::create([
            'slug' => 'Regular User',
            'name' => 'user',
            'permissions' => json_encode(['user' => true]),
        ]);
    }
}
