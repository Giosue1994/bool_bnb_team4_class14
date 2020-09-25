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

  public function search($searchKey) {
    $apartments = Apartment::search($searchKey)->get();

    return view('guests.apartments.search', compact('apartments'));
  }
}
