@extends('layouts.app')

@section('title')
  Bool b&b
@endsection

@section('content')
<!-- SEZIONE INPUT DI RICERCA-->
<section class="input-search" id="input-search-admin">
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
<section class="sponsored" id="sponsored-admin">
  <div class="container">
    <div class="row">
      <div class="title-section-sponsored d-flex">
        <h1>Appartamenti in evidenza</h1>
        <a class="btn btn-primary" href="{{ route('admin.apartments.create')}}">Inserisci il tuo appartamento</a>
      </div>

      <div class="row sponsored-apartment">
        @foreach ($apartments as $apartment)
          <a href="{{ route('admin.apartments.show', $apartment) }}">
            <div lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}" class="col-4 single-apartment">
              <img src="{{ $apartment->image }}" alt="">
              <h2>{{ $apartment->title }}</h2>
            </div>
          </a>
        @endforeach
      </div>

    </div>
  </div>
</section>
@endsection
