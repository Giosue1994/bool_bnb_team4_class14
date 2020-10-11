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
    <div class="container-fluid p-0">

      @if (!$sponsoredApartments->isEmpty())
        <!-- Appartamenti in evidenza -->
        <h2 class="heading text-center">Appartamenti in evidenza</h2>
        <div class="card card-sponsored mb-5">
          <div class="row apartments sponsored-apartments card-body d-flex justify-content-center">

            @foreach ($sponsoredApartments as $sponsoredApartment)
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 single-apartment" lat="{{ $sponsoredApartment->latitude }}" lng="{{ $sponsoredApartment->longitude }}">
                <a href="{{ route('admin.apartments.show', $sponsoredApartment) }}">
                  <div class="img-container">
                    <img class="apartment-image" src="{{ $sponsoredApartment->image }}" alt="Immagine appartamento">
                  </div>
                  <div class="title-container">
                    <h5>{{ $sponsoredApartment->title }}</h5>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- Appartamenti -->
      <h2 class="heading text-center">Appartamenti</h2>
      <div class="card card-normal">
        <div class="row apartments all-apartments card-body d-flex justify-content-center">

          @foreach ($apartments as $apartment)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 single-apartment" lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}">
              <a href="{{ route('admin.apartments.show', $apartment) }}">
                <div class="img-container">
                  <img class="apartment-image" src="{{ $apartment->image }}" alt="Immagine appartamento">
                </div>
                <div class="title-container">
                  <h2>{{ $apartment->title }}</h2>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>

    </div>
  </section>
@endsection
