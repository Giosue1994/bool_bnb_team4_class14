@extends('layouts.app')

@section('title')
  Bool b&b
@endsection

@section('content')

<!-- SEZIONE INPUT DI RICERCA -->
  <section class="input-search" id="input-search-admin">
    <div class="container-fluid">
      <div class="row">
        <!-- JUMBOTRON -->
        <div class="col jumbo-col">
            <div class="d-flex jumbo">
              <div class="jumbo-title">
                <h1>Riscopri l'Italia</h1>
                <h3>Cambia quadro. Scopri alloggi nelle vicinanze <br>tutti da vivere, per lavoro o svago.</h3>
              </div>
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
        <h2 class="heading text-center"><span>Appartamenti in evidenza</span></h2>
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
                    <p>{{ $sponsoredApartment->description }}</p>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- Appartamenti -->
      {{-- <h2 class="heading text-center"><span>Appartamenti</span></h2>
      <div class="card card-normal">
        <div class="row apartments all-apartments card-body d-flex justify-content-center">

          @foreach ($apartments as $apartment)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 single-apartment" lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}">
              <a href="{{ route('admin.apartments.show', $apartment) }}">
                <div class="img-container">
                  <img class="apartment-image" src="{{ $apartment->image }}" alt="Immagine appartamento">
                </div>
                <div class="title-container">
                  <h5>{{ $apartment->title }}</h5>
                  <p>{{ $sponsoredApartment->description }}</p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div> --}}

    </div>
  </section>
@endsection
