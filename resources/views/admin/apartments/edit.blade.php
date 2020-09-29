@extends('layouts.app')
@section('content')

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
              <label>Titolo:</label>
              <input type="text" name="title" value="{{ old('title') ? old('title') : $apartment->title}}">
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

            <div>
              <label>latitudine</label>
              <input type="text" name="latitude" value="{{old('latitude') ? old('latitude') : $apartment->latitude}}">
            </div>

            <div>
              <label>longitudine</label>
              <input type="text" name="longitude" value="{{old('longitude') ? old('longitude') : $apartment->longitude}}">
            </div>

            <div>
              <label>Indirizzo</label>
              <input type="text" name="address" value="{{old('address') ? old('address') : $apartment->address}}">
            </div>

            <div>
              <label>Città</label>
              <input type="text" name="city" value="{{old('city') ? old('city') : $apartment->city}}">
            </div>

            <div>
              <label>Codice postale</label>
              <input type="number" name="zip" value="{{old('zip') ? old('zip') : $apartment->zip}}">
            </div>

            <div>
              <label> Descrizione:</label>
              <textarea name="description" rows="8" cols="80">{{ old('description') ? old('description') : $apartment->description}}</textarea>
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

@endsection
