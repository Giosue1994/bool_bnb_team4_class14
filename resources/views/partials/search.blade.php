@extends('layouts.app')

@section('title')
  Bool b&b Cerca
@endsection

@section('content')
<section id="search-results">
  <div class="container-fluid">
    <div class="row">

      <div class="col-6">
        <form action="{{ route('search') }}" class="form-search-apartment">
          {{-- viene incluso il file che cerca gli appartamenti in base alle città e gli indirizzi --}}
          @include('partials.search-partials.search-city_address')
          {{-- viene incluso il file che cerca gli appartamenti filtrandoli --}}
          @include('partials.search-partials.filters')

          <button type="button" id="btn-search" name="button">Chi cerca trova</button>
        </form>

        <div class="heading">
          <h2>Appartamenti in evidenza</h2>
        </div>

        <div class="apartments sponsored-apartments d-flex">
          @foreach ($sponsoredApartments as $sponsoredApartment)
            <div class="single-sponsored">
              @if (Auth::check())
                <a href="{{route('admin.apartments.show', $sponsoredApartment)}}">
                @else
                <a href="{{route('apartments.show', $sponsoredApartment)}}">
              @endif

                <div class="img-sponsored">
                  <img src="{{$sponsoredApartment->image}}" alt="">
                  <img class="border" src="images/border.png" alt="">
                </div>
                <h2 class="text-center">{{$sponsoredApartment->title}}</h2>
              </a>
            </div>

          @endforeach
        </div>

        <div class="apartment-count">
          <h2>Risultati appartamenti</h2>
          <p id="counter"></p>
        </div>


        <div class="row search-results-container">

        </div>

      </div>

      <div class="col-6">
        {{-- Mappa --}}
        <div id="map-search"></div>
      </div>


        <script id="entry-template" type="text/x-handlebars-template">

            <div class="col-5">
              <div lat="@{{ latitude }}" lng="@{{ longitude }}" class="single-apartment">
                @if (Auth::check())
                  <a href="admin/apartments/@{{id}}" class="btn-blue">
                  @else
                  <a href="apartments/@{{id}}" class="btn-blue">
                @endif
                  <div class="apartment-image">
                    <img src="@{{ image }}" alt="">
                  </div>
                </a>

              </div>
            </div>
            <div class="col-7">
              <h2>@{{title}}</h2>
            </div>


        </script>

    </div>
  </div>
</section>
@endsection
