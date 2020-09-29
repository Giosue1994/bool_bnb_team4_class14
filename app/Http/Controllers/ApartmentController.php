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
    // $rad = $data['rad']; // radius in km
    if (isset($data['rad'])) {
      $rad = $data['rad'];
    }

    // dd($data['rad']);

    // $R = 6371; // earth's mean radius, km // first-cut bounding box (in degrees)
    // $maxLat = $lat + rad2deg($rad/$R);
    // $minLat = $lat - rad2deg($rad/$R);
    // $maxLng = $lng + rad2deg(asin($rad/$R) / cos(deg2rad($lat)));
    // $minLng = $lng - rad2deg(asin($rad/$R) / cos(deg2rad($lat)));
    // $apartments = Apartment::where(
    //   [
    //     ['latitude', '>', $minLat, 'and', '<', $maxLat],
    //     ['longitude', '>', $minLng, 'and', '<', $maxLng]
    //   ])->get();
    $apartments = Apartment::selectRaw("*,
                         ( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance", [$lat, $lng, $lat])

            ->having("distance", "<", $rad)
            ->orderBy("distance",'asc')
            ->offset(0)
            ->limit(20)
            ->get();




    return view('partials.search', compact('apartments'));
  }
}

//lat=45.6136lng=8.1968
