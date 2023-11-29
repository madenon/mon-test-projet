<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'name' => 'Seomaniak',
            'email' => 'info@seomaniak.com',
            'permissions' => '{"platform.systems.roles":true,"platform.systems.users":true,"platform.systems.attachment":true,"platform.index":true}',
            'password' => Hash::make('se0m@niaK'),
            'is_admin' => true
            // Add other fields as needed
        ]);
    }
}
// se0m@niaK
