@extends('layouts.app')

@section('title')
  Bool b&b
@endsection

@section('content')

<!-- SEZIONE INPUT DI RICERCA -->
  <section class="input-search" id="input-search-admin">
    <div class="container-fluid">
      <div class="row">
        <div class="col jumbo-col">
          <!-- JUMBOTRON -->
            <div class="d-flex jumbo">
              <form action="{{ route('search') }}" class="form-search-apartment d-flex">
                {{-- viene incluso il file che cerca gli appartamenti in base alle città e gli indirizzi --}}
                @include('partials.search-partials.search-city_address')
              </form>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- SEZIONE LISTA APPARTAMENTI -->
  <section class="apartments-admin" id="apartments-admin">
    <div class="container-fluid">

      @if (!$sponsoredApartments->isEmpty())
        <!-- Appartamenti in evidenza -->
        <h2 class="heading text-center">Appartamenti in evidenza</h2>
        <div class="row apartments sponsored-apartments d-flex justify-content-center">

          @foreach ($sponsoredApartments as $sponsoredApartment)
            <div lat="{{ $sponsoredApartment->latitude }}" lng="{{ $sponsoredApartment->longitude }}" class="col-lg-2 col-md-6 col-sm-6 single-apartment">
              <a href="{{ route('admin.apartments.show', $sponsoredApartment) }}">
                <div class="img-container">
                  <img class="apartment-image" src="{{ $sponsoredApartment->image }}" alt="Immagine appartamento">
                  <div class="title-container">
                    <h2 class="text-center">{{ $sponsoredApartment->title }}</h2>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      @endif

      <!-- Appartamenti -->
      <h2 class="heading text-center">Appartamenti</h2>
      <div class="row apartments all-apartments d-flex justify-content-center">

        @foreach ($apartments as $apartment)
          <div lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}" class="col-lg-2 col-md-6 col-sm-6 single-apartment">
            <a href="{{ route('admin.apartments.show', $apartment) }}">
              <div class="img-container">
                <img class="apartment-image" src="{{ $apartment->image }}" alt="Immagine appartamento">
                <div class="title-container">
                  <h2 class="text-center">{{ $apartment->title }}</h2>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>

    </div>
  </section>
@endsection
