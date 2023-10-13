<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['name' => 'Immobilier', 'type_id' => 1],
            ['name' => 'Véhicules' , 'type_id' => 2],
            ['name' => 'Bricolage', 'type_id' => 3],
            ['name' => 'Multimédia', 'type_id' => 4],
            ['name' => 'Mode', 'type_id' => 5],
            ['name' => 'Maison', 'type_id' => 6],
            ['name' => 'Jardin & Plantes', 'type_id' => 7],
            ['name' => 'Librairie & Papeterie', 'type_id' => 1],
            ['name' => 'Animaux', 'type_id' => 2],
            ['name' => 'Alimentation', 'type_id' => 3],
            ['name' => 'Sports & Loisirs', 'type_id' => 4],
            ['name' => 'Beauté & Bien-être', 'type_id' => 5],
            ['name' => 'Enfance', 'type_id' => 6],
            ['name' => 'Art & Spectacle', 'type_id' => 7],
            ['name' => 'Collection', 'type_id' => 1],
            ['name' => 'Billetterie', 'type_id' => 2],
            ['name' => 'Matériel professionnel', 'type_id' => 3],
            ['name' => 'CD, Vinyles & Cassettes', 'type_id' => 4],
            ['name' => 'Seniors & Handicap', 'type_id' => 5],
            ['name' => 'Emploi', 'type_id' => 6],
            ['name' => 'Divers', 'type_id' => 7],

        ];

        Category::insert($category);

    }
}
