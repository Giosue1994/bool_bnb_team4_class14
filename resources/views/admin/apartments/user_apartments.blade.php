@extends('layouts.app')
@section('title')
  I tuoi appartamenti
@endsection

@section('content')
<section>
  <div class="container">

    @if (!$userApartments->isEmpty())
      <!-- Appartamenti in evidenza -->
      <h1 class="heading text-center">I tuoi appartamenti</h1>
      {{-- <div class="row apartments sponsored-apartments d-flex justify-content-center">
        @foreach ($userApartments as $userApartment)
          <div lat="{{ $userApartment->latitude }}" lng="{{ $userApartment->longitude }}" class="col-4 single-apartment">
            <select class="select" name="active">
              <option value="1" {{ $userApartment->active == 1 ? 'selected' : '' }}>Attiva</option>
              <option value="0" {{ $userApartment->active == 0 ? 'selected' : '' }}>Non attiva</option>
            </select>
            <a href="{{ route('admin.apartments.show', $userApartment) }}">
              <img class="apartment-image" src="{{ $userApartment->image }}" alt="Immagine appartamento">
              <h2 class="text-center">{{ $userApartment->title }}</h2>
            </a>
          </div>
        @endforeach
      </div> --}}
      <div class="row">
        @foreach ($userApartments as $userApartment)
          <div lat="{{ $userApartment->latitude }}" lng="{{ $userApartment->longitude }}" class="col-12 single-apartment mb-3">
            <div class="card flex-row">
              <a href="{{ route('admin.apartments.show', $userApartment) }}">
                <img class="apartment-image img-user-apart" src="{{ $userApartment->image }}" alt="Immagine appartamento">
              </a>
              <div class="card-body">
                <h5 class="card-title">{{ $userApartment->title }}</h5>
                <p>{{ $userApartment->description }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Ultimo aggiornamento {{$userApartment->updated_at}}</small>
                <select class="select" name="active">
                  <option value="1" {{ $userApartment->active == 1 ? 'selected' : '' }}>Attiva</option>
                  <option value="0" {{ $userApartment->active == 0 ? 'selected' : '' }}>Non attiva</option>
                </select>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
</section>
@endsection
