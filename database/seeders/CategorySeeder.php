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
        $categories = [
            ['id' => 1, 'name' => 'Immobilier', 'type_id' => 1],
            ['id' => 2,'name' => 'Véhicules' , 'type_id' => 2],
            ['id' => 3,'name' => 'Bricolage', 'type_id' => 3],
            ['id' => 4,'name' => 'Multimédia', 'type_id' => 4],
            ['id' => 5,'name' => 'Mode', 'type_id' => 5],
            ['id' => 6,'name' => 'Maison', 'type_id' => 6],
            ['id' => 7,'name' => 'Jardin & Plantes', 'type_id' => 7],
            ['id' => 8,'name' => 'Librairie & Papeterie', 'type_id' => 1],
            ['id' => 9,'name' => 'Animaux', 'type_id' => 2],
            ['id' => 10,'name' => 'Alimentation', 'type_id' => 3],
            ['id' => 11,'name' => 'Sports & Loisirs', 'type_id' => 4],
            ['id' => 12,'name' => 'Beauté & Bien-être', 'type_id' => 5],
            ['id' => 13,'name' => 'Enfance', 'type_id' => 6],
            ['id' => 14,'name' => 'Art & Spectacle', 'type_id' => 7],
            ['id' => 15,'name' => 'Collection', 'type_id' => 1],
            ['id' => 16,'name' => 'Billetterie', 'type_id' => 2],
            ['id' => 17,'name' => 'Matériel professionnel', 'type_id' => 3],
            ['id' => 18,'name' => 'CD, Vinyles & Cassettes', 'type_id' => 4],
            ['id' => 19,'name' => 'Seniors & Handicap', 'type_id' => 5],
            ['id' => 20,'name' => 'Emploi', 'type_id' => 6],
            ['id' => 21,'name' => 'Divers', 'type_id' => 7]

        ];

        $subcategories = [
            ['id' => 22,'name' => 'subcategory test under immobilier', 'parent_id' => 1],
            ['id' => 23,'name' => 'subcategory test under Véhicules', 'parent_id' => 2],
        ];

        Category::insert($categories);
        Category::insert($subcategories);

    }
}
