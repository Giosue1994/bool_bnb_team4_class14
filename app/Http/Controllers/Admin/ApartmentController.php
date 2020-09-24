<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\User;
use App\Image;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments= Apartment::all();

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $new_apartment = new Apartment();
        $new_apartment->user_id = Auth::id();
        $new_apartment->title = $data['title'];
        $new_apartment->description = $data['description'];
        $new_apartment->rooms = $data['rooms'];
        $new_apartment->baths = $data['baths'];
        $new_apartment->beds = $data['beds'];
        $new_apartment->guests = $data['guests'];
        $new_apartment->mqs = $data['mqs'];
        $new_apartment->city = $data['city'];
        $new_apartment->address = $data['address'];
        $new_apartment->zip = $data['zip'];
        $new_apartment->latitude = $data['latitude'];
        $new_apartment->longitude = $data['longitude'];

        $new_apartment->save();

        if (isset($data['image_path'])) {
          $new_image = new Image();
          $path = $request->file('image_path')->store('images','public');
          $new_image->image_path = asset('storage'). '/' . $path;
          $new_image->apartment_id = $new_apartment->id;
          $new_image->save();
        }

        return redirect()->route('admin.apartments.show', $new_apartment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //dd($apartment->images);
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $user =Auth::user();
        return view( "admin.apartments.edit", compact('apartment', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $request_data = $request->all();
        $apartment->title = $request_data['title'];
        $apartment->rooms = $request_data['rooms'];
        $apartment->baths = $request_data['baths'];
        $apartment->beds = $request_data['beds'];
        $apartment->mqs = $request_data['mqs'];
        $apartment->description = $request_data['description'];
        $apartment->guests = $request_data['guests'];
        $apartment->user_id = Auth::id();
        $apartment->latitude = $request_data['latitude'];
        $apartment->longitude = $request_data['longitude'];
        $apartment->address = $request_data['address'];
        $apartment->city = $request_data['city'];
        $apartment->zip = $request_data['zip'];

        $image = Image::where('apartment_id' , $apartment->id)->first();

        if (isset($request_data['image_path'])) {
          $path = $request->file('image_path')->store('images','public');
          $image->image_path = asset('storage'). '/' . $path;
        } else {
          $image->image_path = 'https://otticasilingardi.it/wp-content/themes/consultix/images/no-image-found-360x250.png';
        }
        // Faccio l'update dell'immagine e dell'appartamento
        $image->update();

        $apartment->update();
        $apartment->save();

        return redirect()->route('admin.apartments.show', $apartment);











    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
