@extends('layouts.app')

@section('title')
  Bool b&b
@endsection

@section('content')

<!-- INCLUDE DEL JUMBOTRON -->
  @include('partials.jumbo')

<!-- SEZIONE INPUT DI RICERCA-->
<section class="input-search" id="input-search-guest">
  <div class="container">
    <div class="row">
      <div class="col">
        <form action="{{ route('search') }}" class="form-search-apartment d-flex">
          <h6>Cerca appartamenti</h6>
          {{-- viene incluso il file che cerca gli appartamenti in base alle città e gli indirizzi --}}
          @include('partials.search-partials.search-city_address')

          <input class="btn-index-search" type="submit" value="">
          <i class="fas fa-search-location icon-search"></i>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- SEZIONE LISTA APPARTAMENTI-->
<section class="apartments-guests" id="apartments-guests">
  <div class="container">

    @if (!$sponsoredApartments->isEmpty())
      <!-- Appartamenti in evidenza -->
      <h1 class="heading text-center">Appartamenti in evidenza</h1>
      <div class="row apartments sponsored-apartments d-flex justify-content-center">
        @foreach ($sponsoredApartments as $sponsoredApartment)
          <div lat="{{ $sponsoredApartment->latitude }}" lng="{{ $sponsoredApartment->longitude }}" class="col-4 single-apartment">
            <a href="{{ route('apartments.show', $sponsoredApartment) }}">
              <img class="apartment-image" src="{{ $sponsoredApartment->image }}" alt="Immagine appartamento">
              <h2 class="text-center">{{ $sponsoredApartment->title }}</h2>
            </a>
          </div>
        @endforeach
      </div>
    @endif

    <!-- Appartamenti -->
    <h2 class="heading text-center">Appartamenti</h2>
    <div class="row apartments all-apartments d-flex justify-content-center">

      @foreach ($apartments as $apartment)
        <div lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}" class="col-4 single-apartment">
          <a href="{{ route('apartments.show', $apartment) }}">
            <img class="apartment-image" src="{{ $apartment->image }}" alt="Immagine appartamento">
            <h2 class="text-center">{{ $apartment->title }}</h2>
          </a>
        </div>
      @endforeach
    </div>

  </div>
</section>
@endsection
