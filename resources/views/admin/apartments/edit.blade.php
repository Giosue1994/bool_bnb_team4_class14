@extends('layouts.app')
@section('content')

<section id="edit">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <h1> Modifica i dati dell'appartamento</h1>

        {{-- Validazione form --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div>
          <form action="{{ route('admin.apartments.update', $apartment) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
              <label>Visibilità</label>
              <select class="" name="active">
                <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Attiva</option>
                <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>Non attiva</option>
              </select>

            </div>
            <div>
              <label>Titolo:</label>
              <input type="text" name="title" value="{{ old('title') ? old('title') : $apartment->title}}">
            </div>

            <div>
              <label> Descrizione:</label>
              <textarea name="description" rows="8" cols="80">{{ old('description') ? old('description') : $apartment->description}}</textarea>
            </div>

            <div>
              <label>Numero stanze:</label>
              <input type="number" name="rooms" value="{{ old('rooms') ? old('rooms') : $apartment->rooms}}">
            </div>

            <div>
              <label>Numero Bagni:</label>
              <input type="number" name="baths" value="{{ old('baths') ? old('baths') : $apartment->baths}}">
            </div>

            <div>
              <label>Numero letti:</label>
              <input type="number" name="beds" value="{{ old('beds') ? old('beds') :$apartment->beds}}">
            </div>

            <div>
              <label> Metri quadri:</label>
              <input type="number" name="mqs" value="{{old('mqs') ? old('mqs') : $apartment->mqs}}">
            </div>

            <div>
              <label>Numero Ospiti:</label>
              <input type="number" name="guests" value="{{old('guests') ? old('guests') : $apartment->guests}}">
            </div>

            <div class="form-group">
              <label for="form-address">Indirizzo*</label>
              <input value="{{old('address') ? old('address') : $apartment->address}}" name="address" type="search" class="form-control" id="form-address" placeholder="Inserisci l'indirizzo del tuo appartamento" />
            </div>
            <div class="form-group">
              <label for="form-city">Città*</label>
              <input value="{{old('city') ? old('city') : $apartment->city}}" name="city" type="text" class="form-control" id="form-city" placeholder="City" />
            </div>
            <div class="form-group">
              <label for="form-zip">CAP/ZIP*</label>
              <input value="{{old('zip') ? old('zip') : $apartment->zip}}" name="zip" type="text" class="form-control" id="form-zip" placeholder="ZIP code" />
            </div>
            <div class="split" style="display: none">
              <div class="form-group">
                <label for="form-lat">Latitude</label>
                <input value="{{old('latitude') ? old('latitude') : $apartment->latitude}}" name="latitude" type="text" class="form-control" id="form-lat" placeholder="Latitude" />
              </div>
              <div class="form-group">
                <label for="form-lng">Longitude</label>
                <input value="{{old('longitude') ? old('longitude') : $apartment->longitude}}" name="longitude" type="text" class="form-control" id="form-lng" placeholder="Longitude" />
              </div>
            </div>

            <div class="chekboxes">
              <span>Servizi aggiuntivi</span>
              @foreach ($services as $service)
                <div>
                  <input type="checkbox" name="services[]" {{ $apartment->services->contains($service) ? 'checked' : '' }} value="{{$service->id}}">
                  <label>{{$service->name}}</label>
                </div>
              @endforeach
            </div>

            <div class="">
              <label>Inserisci immagine</label>
              <input type="file" name="image_path" accept="image/*">
            </div>

            <input type="submit" name="" value="Salva le modifiche">

          </form>

        </div>

      </div>

    </div>

  </div>
</section>

@endsection
