<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{
  public function index() {
    $apartments = Apartment::all();

    return view('guests.apartments.index', compact('apartments'));
  }

  public function show(Apartment $apartment) {

    return view('guests.apartments.show', compact('apartment'));
  }

  public function search(Request $request) {

    $data = $request->all();
    $lat = $data['lat'];
    $lng = $data['lng'];
    $rad = 20;
    $minRooms = 1;
    $minBeds = 1;
    $minBaths = 1;



    if (isset($data['rad'])) {
      $rad = $data['rad'];
    }
    if (isset($data['minRooms'])) {
      $minRooms = $data['minRooms'];
    }
    if (isset($data['minBeds'])) {
      $minBeds = $data['minBeds'];
    }
    if (isset($data['minBaths'])) {
      $minBaths = $data['minBaths'];
    }

    $apartments = Apartment::selectRaw("*,
                         ( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance", [$lat, $lng, $lat])

                         ->where([
                             ['rooms', '>', $minRooms],
                             ['beds', '>', $minBeds],
                             ['baths', '>', $minBaths],
                         ])
                         
            ->having("distance", "<", $rad)

            ->orderBy("distance",'asc')
            ->offset(0)
            ->limit(20)
            ->get();

            // $arrayService = [];
            // foreach ($apartments as $apartment) {
            //   $apartment_id = $apartment->id;
            //   foreach ($apartment->services as $service) {
            //     $arrayService[] = $service->name;
            //   }
            // }
            //
            // dd($arrayService);


    return view('partials.search', compact('apartments'));
  }
}

//lat=45.6136lng=8.1968
