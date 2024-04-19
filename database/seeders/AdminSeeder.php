<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'name' => 'SeomaniakAdmin',
            'email' => 'info@seomaniak.com',
            'permissions' => '{"platform.systems.roles":true,"platform.systems.users":true,"platform.systems.attachment":true,"platform.index":true}',
            'password' => Hash::make('se0m@niaK'),
            'is_admin' => true,
            'email_verified_at' => now(),
            'is_online' => false,
            'last_login' => now(),
            'role' => 'admin',
            'active' => true,
            'profile_photo_path' => null,
            'remember_token' => Str::random(10),
            'avatar' => config('chatify.user_avatar.default'),
            'active_status' => 'active',
            'dark_mode' => false,
            'messenger_color' => '#24A19C',
        ]);
        
        DB::table('user_infos')->insert([
            'user_id' => $userId,
            'phone' => '+33'.Str::random(10),
            'nickname' => 'Admin',
            'gender' => 'Male', 
            'bio' => 'Lorem ipsum',
            'created_at' => now(),
            'updated_at' => now(),
        ]);



    }
}
// se0m@niaK
