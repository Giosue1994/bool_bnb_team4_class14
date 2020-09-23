<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        SponsorsTableSeeder::class,
        ServicesTableSeeder::class,
        ApartmentsTableSeeder::class,
        ConversationsTableSeeder::class,
        StatisticsTableSeeder::class,
        ImagesTableSeeder::class,
      ]);
    }
}
