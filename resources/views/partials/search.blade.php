@extends('layouts.app')

@section('title')
  Bool b&b Cerca
@endsection

@section('content')
<section id="search-results">
  <div class="container-fluid">
    <div class="row">

      <div class="col-5">
        <form action="{{ route('search') }}" class="form-search-apartment">
          {{-- viene incluso il file che cerca gli appartamenti in base alle città e gli indirizzi --}}
          @include('partials.search-partials.search-city_address')
          {{-- viene incluso il file che cerca gli appartamenti filtrandoli --}}
          @include('partials.search-partials.filters')

          <button type="button" id="btn-search" name="button">Chi cerca trova</button>
        </form>

        <div class="apartment-count">
          <h2>Risultati appartamenti</h2>
          <p id="counter"></p>
        </div>

        <div class="search-results-container"></div>
      </div>

      <div class="col-7">
        {{-- Mappa --}}
        <div id="map-search"></div>
      </div>


        <script id="entry-template" type="text/x-handlebars-template">

            <div lat="@{{ latitude }}" lng="@{{ longitude }}" class="single-apartment">
              @if (Auth::check())
                <a href="admin/apartments/@{{id}}" class="btn-blue">
                @else
                <a href="apartments/@{{id}}" class="btn-blue">
              @endif
                  <img src="@{{ image }}" alt="">
                <h2>@{{title}}</h2>
              </a>

          </div>
        </script>

    </div>
  </div>
</section>
@endsection
