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
            ['id' => 1, 'name' => 'Immobilier', 'type_id' => 1, 'icon' => 'fa-home'],
            ['id' => 2, 'name' => 'Véhicules', 'type_id' => 2, 'icon' => 'fa-car'],
            ['id' => 3, 'name' => 'Bricolage', 'type_id' => 3, 'icon' => 'fa-tools'],
            ['id' => 4, 'name' => 'Multimédia', 'type_id' => 4, 'icon' => 'fa-desktop'],
            ['id' => 5, 'name' => 'Mode', 'type_id' => 5, 'icon' => 'fa-tshirt'],
            ['id' => 6, 'name' => 'Maison', 'type_id' => 6, 'icon' => 'fa-home'],
            ['id' => 7, 'name' => 'Jardin & Plantes', 'type_id' => 7, 'icon' => 'fa-seedling'],
            ['id' => 8, 'name' => 'Librairie & Papeterie', 'type_id' => 1, 'icon' => 'fa-book'],
            ['id' => 9, 'name' => 'Animaux', 'type_id' => 2, 'icon' => 'fa-paw'],
            ['id' => 10, 'name' => 'Alimentation', 'type_id' => 3, 'icon' => 'fa-apple-alt'],
            ['id' => 11, 'name' => 'Sports & Loisirs', 'type_id' => 4, 'icon' => 'fa-football-ball'],
            ['id' => 12, 'name' => 'Beauté & Bien-être', 'type_id' => 5, 'icon' => 'fa-spa'],
            ['id' => 13, 'name' => 'Enfance', 'type_id' => 6, 'icon' => 'fa-child'],
            ['id' => 14, 'name' => 'Art & Spectacle', 'type_id' => 7, 'icon' => 'fa-paint-brush'],
            ['id' => 15, 'name' => 'Collection', 'type_id' => 1, 'icon' => 'fa-archway'],
            ['id' => 16, 'name' => 'Billetterie', 'type_id' => 2, 'icon' => 'fa-ticket-alt'],
            ['id' => 17, 'name' => 'Matériel professionnel', 'type_id' => 3, 'icon' => 'fa-briefcase'],
            ['id' => 18, 'name' => 'CD, Vinyles & Cassettes', 'type_id' => 4, 'icon' => 'fa-compact-disc'],
            ['id' => 19, 'name' => 'Seniors & Handicap', 'type_id' => 5, 'icon' => 'fa-wheelchair'],
            ['id' => 20, 'name' => 'Emploi', 'type_id' => 6, 'icon' => 'fa-briefcase'],
            ['id' => 21, 'name' => 'Divers', 'type_id' => 7, 'icon' => 'fa-cubes'],
         ];

        $subcategories = [
            ['id' => 22,'name' => 'Logements', 'parent_id' => 1],
            ['id' => 23,'name' => 'Villa', 'parent_id' => 1],
            ['id' => 24, 'name' => 'Appartements', 'parent_id' => 1],
            ['id' => 25, 'name' => 'Maisons individuelles', 'parent_id' => 1],
            ['id' => 26, 'name' => 'Chambres d\'hôtes', 'parent_id' => 1],
            ['id' => 27, 'name' => 'Camping-cars', 'parent_id' => 2],
            ['id' => 28, 'name' => 'Berlines', 'parent_id' => 2],
            ['id' => 29, 'name' => 'Utilitaires', 'parent_id' => 2],
            ['id' => 30, 'name' => 'Outillage manuel', 'parent_id' => 3],
            ['id' => 31, 'name' => 'Matériaux de construction', 'parent_id' => 3],
            ['id' => 32, 'name' => 'Équipement électrique', 'parent_id' => 3],
            ['id' => 33, 'name' => 'Ordinateurs portables', 'parent_id' => 4],
            ['id' => 34, 'name' => 'Appareils photo', 'parent_id' => 4],
            ['id' => 35, 'name' => 'Téléviseurs', 'parent_id' => 4],
            ['id' => 36, 'name' => 'Chaussures', 'parent_id' => 5],
            ['id' => 37, 'name' => 'Accessoires de mode', 'parent_id' => 5],
            ['id' => 38, 'name' => 'Vêtements de sport', 'parent_id' => 5],
            ['id' => 39, 'name' => 'Meubles', 'parent_id' => 6],
            ['id' => 40, 'name' => 'Électroménagers', 'parent_id' => 6],
            ['id' => 41, 'name' => 'Décoration intérieure', 'parent_id' => 6],
            ['id' => 42, 'name' => 'Plantes d\'intérieur', 'parent_id' => 7],
            ['id' => 43, 'name' => 'Outils de jardinage', 'parent_id' => 7],
            ['id' => 44, 'name' => 'Mobiliers de jardin', 'parent_id' => 7],
            ['id' => 45, 'name' => 'Cahiers et blocs-notes', 'parent_id' => 8],
            ['id' => 46, 'name' => 'Stylos et crayons', 'parent_id' => 8],
            ['id' => 47, 'name' => 'Fournitures de bureau', 'parent_id' => 8],
            ['id' => 48, 'name' => 'Accessoires pour animaux', 'parent_id' => 9],
            ['id' => 49, 'name' => 'Nourriture pour animaux', 'parent_id' => 9],
            ['id' => 50, 'name' => 'Cages et accessoires', 'parent_id' => 9],
            ['id' => 51, 'name' => 'Produits alimentaires', 'parent_id' => 10],
            ['id' => 52, 'name' => 'Boissons', 'parent_id' => 10],
            ['id' => 53, 'name' => 'Produits de cuisine', 'parent_id' => 10],
            ['id' => 54, 'name' => 'Équipements de sport', 'parent_id' => 11],
            ['id' => 55, 'name' => 'Vélos et accessoires', 'parent_id' => 11],
            ['id' => 56, 'name' => 'Articles de pêche', 'parent_id' => 11],
            ['id' => 57, 'name' => 'Produits de beauté', 'parent_id' => 12],
            ['id' => 58, 'name' => 'Soins capillaires', 'parent_id' => 12],
            ['id' => 59, 'name' => 'Parfums', 'parent_id' => 12],
            ['id' => 60, 'name' => 'Jouets pour bébés', 'parent_id' => 13],
            ['id' => 61, 'name' => 'Vêtements pour enfants', 'parent_id' => 13],
            ['id' => 62, 'name' => 'Articles de puériculture', 'parent_id' => 13],
            ['id' => 63, 'name' => 'Peinture', 'parent_id' => 14],
            ['id' => 64, 'name' => 'Photographie', 'parent_id' => 14],
            ['id' => 65, 'name' => 'Théâtre', 'parent_id' => 14],
            ['id' => 66, 'name' => 'Timbres', 'parent_id' => 15],
            ['id' => 67, 'name' => 'Pièces de monnaie', 'parent_id' => 15],
            ['id' => 68, 'name' => 'Cartes postales', 'parent_id' => 15],
            ['id' => 69, 'name' => 'Concerts', 'parent_id' => 16],
            ['id' => 70, 'name' => 'Événements sportifs', 'parent_id' => 16],
            ['id' => 71, 'name' => 'Théâtre', 'parent_id' => 16],
            ['id' => 72, 'name' => 'Outils de construction', 'parent_id' => 17],
            ['id' => 73, 'name' => 'Fournitures de bureau', 'parent_id' => 17],
            ['id' => 74, 'name' => 'Équipement médical', 'parent_id' => 17],
            ['id' => 75, 'name' => 'Pop', 'parent_id' => 18],
            ['id' => 76, 'name' => 'Rock', 'parent_id' => 18],
            ['id' => 77, 'name' => 'Hip-hop', 'parent_id' => 18],
            ['id' => 78, 'name' => 'Aides à la mobilité', 'parent_id' => 19],
            ['id' => 79, 'name' => 'Soins de santé', 'parent_id' => 19],
            ['id' => 80, 'name' => 'Accessoires pour seniors', 'parent_id' => 19],
            ['id' => 81, 'name' => 'Offres d\'emploi', 'parent_id' => 20],
            ['id' => 82, 'name' => 'Recherche d\'emploi', 'parent_id' => 20],
            ['id' => 83, 'name' => 'Formation professionnelle', 'parent_id' => 20],
            ['id' => 84, 'name' => 'Articles insolites', 'parent_id' => 21],
            ['id' => 85, 'name' => 'Cadeaux originaux', 'parent_id' => 21],
            ['id' => 86, 'name' => 'Objets de collection', 'parent_id' => 21],

        ];

        Category::insert($categories);
        Category::insert($subcategories);

    }
}
