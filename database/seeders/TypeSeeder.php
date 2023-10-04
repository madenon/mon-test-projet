<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = [
            ['name' => 'Adoption'],
            ['name' => 'Bien'],
            ['name' => 'Don'],
            ['name' => 'Moment'],
            ['name' => 'Prêt et Location'],
            ['name' => 'Savoir'],
            ['name' => 'Service'],


        ];

        Type::insert($type);
    }
}
