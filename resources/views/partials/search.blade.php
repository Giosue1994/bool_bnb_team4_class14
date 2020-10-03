@extends('layouts.app')

@section('title')
  Bool b&b Cerca
@endsection

@section('content')
<section id="search-results">
  <div class="container">
    <div class="row">

      <div class="col-12">
        <form action="{{ route('search') }}" class="form">
          {{-- viene incluso il file che cerca gli appartamenti in base alle città e gli indirizzi --}}
          @include('partials.search-partials.search-city_address')
          {{-- viene incluso il file che cerca gli appartamenti filtrandoli --}}
          @include('partials.search-partials.filters')

          {{-- Mappa --}}
          <div id="map-example-container"></div>

          <button type="button" id="btn-search" name="button">Chi cerca trova</button>
        </form>
      </div>

      <div class="col">
        <h2>Risultati appartamenti</h2>
        <p id="counter"></p>
      </div>

      {{-- <div class="col-12">
        <div id="search-results">
          @foreach ($apartments as $apartment)
            @if (Auth::check())
              <a href="{{ route('admin.apartments.show', $apartment) }}">
              @else
                <a href="{{ route('apartments.show', $apartment) }}">
            @endif

              <div class="col-12 single-apartment">
                @foreach ($apartment->images as $image)

                  @if ($loop->first)
                    <img src="{{ $image->image_path }}" alt="">
                  @endif

                @endforeach
                <h2>{{ $apartment->title }}</h2>
              </div>
            </a>
          @endforeach
        </div>
      </div> --}}

      <div class="col-12 search-results-container">

      </div>

        <script id="entry-template" type="text/x-handlebars-template">


            <div class="entry">
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
