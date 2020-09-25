<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('guests.apartments.index');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route gruppo Admin
Route::prefix('admin')
  ->namespace('Admin')
  ->middleware('auth')
  ->name('admin.')
  ->group(function() {
    Route::resource('apartments','ApartmentController');
    //Route per cercare gli appartamenti
    Route::get('/search/{searchKey}', 'ApartmentController@search')->name('search');
  });

//Route apartments per tutti gli utenti
Route::get('/', 'ApartmentController@index')->name('apartments.index');
Route::get('/apartments/{apartment}', 'ApartmentController@show')->name('apartments.show');

//Route per cercare gli appartamenti
Route::get('/search/{searchKey}', 'ApartmentController@search')->name('search');
