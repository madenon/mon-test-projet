<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\OfferImages;
use Faker\Factory as Faker;


class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 100; $i++) { 
            $offer = Offer::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'condition' => $faker->randomElement(["NEW", "VERY_GOOD", "GOOD", "MEDIUM", "BAD", "BROKEN"]),
                'experience' => $faker->randomElement( ['NO_EXPERIENCE', 'LESS_THAN_5_YEARS', 'BETWEEN_5_AND_10_YEARS', 'BETWEEN_10_AND_25_YEARS', 'MORE_THAN_25_YEARS']),
                'offer_default_photo' => '656ddc92f2ad6.png',
                'slug' => $faker->slug,
                'countdown' => $faker->randomNumber(2),
                'countdownTo' =>  $faker->randomElement([null, $faker->dateTimeBetween('now', '+1 month')]),
                'active_offer' => $faker->boolean,
                'archive_offer' => $faker->boolean,
                'published_at' => $faker->dateTimeThisMonth,
                'buy_authorized' => $faker->boolean,
                'send_authorized' => $faker->boolean,
                'price' => $faker->randomNumber(3),
                'perimeter_authorized' => $faker->boolean,
                'perimeter' => $faker->word,
                'specify_proposition' => $faker->sentence,
                'user_id' => $faker->numberBetween(1, 10),
                'type_id' => $faker->numberBetween(1, 5),
                'department_id' => $faker->numberBetween(1, 10),
                'created_at' => $faker->dateTimeThisMonth,
                'updated_at' => $faker->dateTimeThisMonth,
                'subcategory_id' => $faker->numberBetween(30, 200),
                'deleted_at' => null,
                'dynamic_inputs' => $faker->text,
            ]);  
            $defaultImage = OfferImages::create([
                'offer_photo' => '656ddc92f2ad6.png',
                'offer_id' => $offer->id,
            ]);
            $offer->update(['default_image_id' => $defaultImage->id]);

        }
    }
}
