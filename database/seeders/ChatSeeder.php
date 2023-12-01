<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $admin = DB::table('users')->where('email', 'info@seomaniak.com')->first();
        if(!$admin)return;
        $adminId = $admin->id;

        for ($i = 1; $i <= 15; $i++) {
            if($i%3)$is_online=true;
            else $is_online=false;
            $userId = DB::table('users')->insertGetId([
                'last_name' => $faker->name(),
                'first_name' => $faker->name(),
                'email' => $faker->email(),
                'email_verified_at' => now(),
                'password' => Hash::make('user'.$i),
                'is_online' => $is_online,
                'last_login' => now()->subMinutes(rand(0, 500)),
                'role' => 'user',
                'active' => true,
                'profile_photo_path' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'permissions' => '{}',
                'updated_at' => now(),
                'active_status' => $is_online,
                'avatar' => config('chatify.user_avatar.default'),
                'dark_mode' => false,
                'name' => $faker->name(),
                'messenger_color' => '#24A19C',
            ]);
            DB::table('user_infos')->insert([
                'user_id' => $userId,
                'phone' => '+33'.$faker->numerify('##########'),
                'nickname' => 'Nick'.$i,
                'gender' => 'Male', 
                'bio' => 'Lorem ipsum',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $numberOfMessages = rand(5, 15);
            
            if($i<3)$state='deleted';
            else if($i<5)$state='archived';
            else $state='available';


            for ($j = 1; $j <= $numberOfMessages; $j++) {
                $fromUserId=$adminId;
                $toUserId = $userId;
                if($j%2)list($fromUserId,$toUserId)=array($toUserId,$fromUserId);
                $seen=$j<rand(1,$numberOfMessages)?true:false;
                DB::table('ch_messages')->insert([
                    'id' => $faker->uuid(),
                    'from_id' => $fromUserId,
                    'to_id' => $toUserId,
                    'body' => $faker->sentence,
                    'attachment' => null,
                    'seen' =>$seen, 
                    'created_at' => now()->subMinutes(rand(0, 50000)),//More than one month
                    'updated_at' => now(),

                ]);
            }

        }
            
    }
}
