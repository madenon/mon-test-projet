<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['id' => 1, 'name' => 'Alsace'],
            ['id' => 2, 'name' => 'Aquitaine'],
            ['id' => 3, 'name' => 'Auvergne'],
            ['id' => 4, 'name' => 'Basse-Normandie'],
            ['id' => 5, 'name' => 'Bourgogne'],
            ['id' => 6, 'name' => 'Bretagne'],
            ['id' => 7, 'name' => 'Centre'],
            ['id' => 8, 'name' => 'Champagne-Ardenne'],
            ['id' => 9, 'name' => 'Corse'],
            ['id' => 10, 'name' => 'Franche-Comte'],
            ['id' => 11, 'name' => 'Haute-Normandie'],
            ['id' => 12, 'name' => 'Ile-de-France'],
            ['id' => 13, 'name' => 'Languedoc-Roussillon'],
            ['id' => 14, 'name' => 'Limousin'],
            ['id' => 15, 'name' => 'Lorraine'],
            ['id' => 16, 'name' => 'Midi-Pyrenees'],
            ['id' => 17, 'name' => 'Nord-Pas-de-Calais'],
            ['id' => 18, 'name' => 'Pays de la Loire'],
            ['id' => 19, 'name' => 'Picardie'],
            ['id' => 20, 'name' => 'Poitou-Charentes'],
            ['id' => 21, 'name' => 'Provence-Alpes-Cote d\'Azur'],
            ['id' => 22, 'name' => 'Rhone-Alpes'],
            ['id' => 23, 'name' => 'La Reunion'],
            ['id' => 24, 'name' => 'Mayotte'],
            ['id' => 25, 'name' => 'Guyane'],
            ['id' => 26, 'name' => 'Guadeloupe'],
            ['id' => 27, 'name' => 'Martinique']
        ];

        Region::insert($regions);
    }
}
