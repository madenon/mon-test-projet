<?php

namespace Database\Seeders;

use App\Models\Information;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Information::create([
                'facebook' => 'https://www.facebook.com/fraistroquer.fr/',
                'youtube'=> 'https://www.youtube.com/channel/UCAPv8iQcz4dmhZfHUizP46Q/videos',
                'instagram'=>'https://www.instagram.com/?hl=fr',
                'contrat'=>'https://www.faistroquer.fr/pdf/contrat-echange.pdf',
                'email'=>'contact@faistroquer.fr',
                'phone'=>'+343-33-32-40-43'
            ]);
        }
    
}
