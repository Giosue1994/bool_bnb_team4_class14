<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

class ApartmentController extends Controller
{
  public function index() {
    $apartments = Apartment::all();

    return view('guests.apartments.index', compact('apartments'));
  }

  public function show(Apartment $apartment) {

    return view('guests.apartments.show', compact('apartment'));
  }

  function matchingServices($arrayA, $arrayB) {
    $match = true;
    foreach ($arrayA as $singleInputService) {
      if (!in_array($singleInputService, $arrayB)) {
        $match = false;
      }
    }
    return $match;
  }

  public function search(Request $request) {

    $services = Service::all();
    $data = $request->all();
    $lat = $data['lat'];
    $lng = $data['lng'];
    $rad = 20;
    $minRooms = 1;
    $minBeds = 1;
    $minBaths = 1;
    $inputServices = [];
    $requestedServices = $request->services;
    $selectedApartments = [];

    if (isset($requestedServices)) {
      $inputServices = $requestedServices;
    }

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

    $apartments = Apartment::selectRaw("*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) -
                                    radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance", [$lat, $lng, $lat])
     ->where([
       ['rooms', '>=', $minRooms],
       ['beds', '>=', $minBeds],
       ['baths', '>=', $minBaths],
     ])
     ->having("distance", "<", $rad)
     ->orderBy("distance",'asc')
     ->offset(0)
     ->limit(20)
     ->get();

  foreach ($apartments as $apartment) {
    $apartmentServices = $apartment->services;
    // prepariamo array per salvare i servizi scelti dall'utente
    $arrayApartmentServices = [];
    foreach ($apartmentServices as $service) {
      $arrayApartmentServices[] = $service->id;
    }

    $match = $this->matchingServices( $inputServices, $arrayApartmentServices);
      if ($match == true) {
        $selectedApartments[] = $apartment;
      }
      $apartments = collect($selectedApartments);
  }

  if($request->ajax())
  {
    return response()->json($apartments);
  }

    return view('partials.search', compact('apartments', 'services', 'requestedServices'));
  }
}
