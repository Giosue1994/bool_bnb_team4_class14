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

    function in_array_all($arrayA, $arrayB) {
        return empty(array_diff($arrayA, $arrayB));

    }

    if (isset($requestedServices)) {
      $inputServices = $requestedServices;
      //dd($inputServices);
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

          foreach ($apartments as $apartment) {
            $apartmentServices = $apartment->services;
          // prepariamo array per salvare i servizi scelti dall'utente
            $arrayApartmentServices = [];
            foreach ($apartmentServices as $service) {
              $arrayApartmentServices[] = $service->id;
              //var_dump($arrayApartmentServices);
            }
            // usando la funzione dichiarata prima, controlliamo che l'array che contiene i servizi selezionati dall'utente sia completamente contenuto nell'array dei servizi dell'appartamento, se questo e' vero l'appartamento viene salvato

            if (in_array_all( $inputServices, $arrayApartmentServices)){
              $selectedApartments[] = $apartment;
              $apartments = collect($selectedApartments);

            }
            // dd($apartments);
          }

    return view('partials.search', compact('apartments', 'services'));
  }
}
