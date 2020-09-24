<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\User;
use App\Image;
use App\Service;
use App\Conversation;


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
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationData());

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
        $new_image = new Image();

        if (isset($data['image_path'])) {
          $path = $request->file('image_path')->store('images','public');
          $new_image->image_path = asset('storage'). '/' . $path;
        } else {
          $new_image->image_path = 'https://otticasilingardi.it/wp-content/themes/consultix/images/no-image-found-360x250.png';
        }
        $new_image->apartment_id = $new_apartment->id;
        $new_image->save();

        if (isset($data['services'])) {
          $new_apartment->services()->sync($data['services']);
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
        $user = Auth::user();
        $services = Service::all();
        return view( "admin.apartments.edit", compact('apartment', 'user', 'services'));
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
        $request->validate($this->validationData());

        $data = $request->all();
        $apartment->title = $data['title'];
        $apartment->rooms = $data['rooms'];
        $apartment->baths = $data['baths'];
        $apartment->beds = $data['beds'];
        $apartment->mqs = $data['mqs'];
        $apartment->description = $data['description'];
        $apartment->guests = $data['guests'];
        $apartment->user_id = Auth::id();
        $apartment->latitude = $data['latitude'];
        $apartment->longitude = $data['longitude'];
        $apartment->address = $data['address'];
        $apartment->city = $data['city'];
        $apartment->zip = $data['zip'];

        $image = Image::where('apartment_id' , $apartment->id)->first();

        if (isset($data['image_path'])) {
          $path = $request->file('image_path')->store('images','public');
          $image->image_path = asset('storage'). '/' . $path;
        } else {
          $image->image_path = 'https://otticasilingardi.it/wp-content/themes/consultix/images/no-image-found-360x250.png';
        }

        if (!empty($data['services'])) {
          $apartment->services()->sync($data['services']);
        } else {
          $apartment->services()->detach();
        }

        // Faccio l'update dell'immagine e dell'appartamento
        $image->update();

        $apartment->update();

        return redirect()->route('admin.apartments.show', $apartment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $conversation = Conversation::where('apartment_id' , $apartment->id);
        $image = Image::where('apartment_id' , $apartment->id);

        $apartment->services()->detach();
        $conversation->delete();
        $image->delete();
        $apartment->delete();

        return redirect()->route('admin.apartments.index');
    }

    public function validationData() {
      return [
        'title' => 'required|max:255',
        'rooms' => 'required|integer|min:1|max:10',
        'baths' => 'required|integer|min:1|max:5',
        'beds' => 'required|integer|min:1|max:10',
        'mqs' => 'required|integer|min:25',
        'guests' => 'required|integer|min:1|max:20',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'address' => 'required|max:255',
        'city' => 'required|max:255',
      ];
    }
}
