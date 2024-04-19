<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeSeeder extends Seeder
{
    public function run()
    {
        // Account Age Badges
        DB::table('badges')->insert([
            'type' => 'accountOld',
            'value' => 'More than one year',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('badges')->insert([
            'type' => 'accountOld',
            'value' => 'More than 3 years',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('badges')->insert([
            'type' => 'accountOld',
            'value' => 'More than 5 years',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Other Badges
        DB::table('badges')->insert([
            'type' => 'Honor',
            'value' => 'Honor Badge',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('badges')->insert([
            'type' => 'ContestWinner',
            'value' => 'Contest Winner Badge',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('badges')->insert([
            'type' => 'MonthTopMaker',
            'value' => 'Top Depositor Badge (Monthly)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('badges')->insert([
            'type' => 'MonthTopTaker',
            'value' => 'Top Trader Badge (Monthly)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
