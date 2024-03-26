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
            ['id' => 1, 'name' => 'Bien'],
            ['id' => 2, 'name' => 'Service'],
            ['id' => 3, 'name' => 'Prêt & Location'],
            ['id' => 4, 'name' => 'Adoption'],
            ['id' => 5, 'name' => 'Savoir'],
            ['id' => 6, 'name' => 'Don'],
            ['id' => 7, 'name' => 'Moment'],
        ];
        
        

        Type::insert($types);
    }
}
