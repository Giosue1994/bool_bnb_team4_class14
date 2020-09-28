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

    $apartments = Apartment::where(
      [
        ['latitude', '=', $lat],
        ['longitude', '=', $lng]
      ])->get();

    return view('guests.apartments.search', compact('apartments'));
  }
}

//lat=45.6136lng=8.1968
