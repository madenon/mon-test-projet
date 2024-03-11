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
        $types = [
            ['id' => 1, 'name' => 'Adoption'],
            ['id' => 2, 'name' => 'Bien'],
            ['id' => 3, 'name' => 'Don'],
            ['id' => 4, 'name' => 'Moment'],
            ['id' => 5, 'name' => 'Prêt et Location'],
            ['id' => 6, 'name' => 'Savoir'],
            ['id' => 7, 'name' => 'Service'],
        ];
        
        

        Type::insert($types);
    }
}
