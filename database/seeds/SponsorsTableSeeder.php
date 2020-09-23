<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 3; $i++) {
          $new_sponsor = new Sponsor();
          $new_sponsor->name = $faker->word;
          $new_sponsor->price = $faker->randomElement([2.99, 5.99, 9.99]);
          $new_sponsor->duration = $faker->randomElement([24, 72, 144]);
          $new_sponsor->save();

        }
    }
}
