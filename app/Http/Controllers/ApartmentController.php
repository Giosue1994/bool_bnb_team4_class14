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
}
