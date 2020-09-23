<?php

use Illuminate\Database\Seeder;

use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $services = [
        'wifi',
        'parking',
        'pets_allowed',
        'air_conditioning',
        'swimming_pool',
        'washingmachine',
        'tv',
        'kitchen',
        'breakfast',
      ];
      foreach ($services as $service) {
        $new_service = new Service();
        $new_service->name = $service;
        $new_service->save();
      }
    }
}
