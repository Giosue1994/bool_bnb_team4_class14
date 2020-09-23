<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Statistic;

class StatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) {
          $new_statistic = new Statistic();
          $new_statistic->date = $faker->date;
          $new_statistic->apartment_id = rand(1, 5);
          $new_statistic->save();
        }
    }
}
