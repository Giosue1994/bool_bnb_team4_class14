@extends('layouts.app')

@section('title')
  Bool b&b Cerca
@endsection

@section('content')
<section id="search-results">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-6 col-lg-7 col-md-12">
        <h2 class="heading">Appartamenti nell'area selezionata della mappa</h2>
        <p id="counter"></p>
        <div id="filters-container">
          <form action="{{ route('search') }}" class="form-search-apartment">
            {{-- viene incluso il file che cerca gli appartamenti in base alle città e gli indirizzi --}}
            @include('partials.search-partials.search-city_address')
            <div id="filters-drop" class="card">
              <div class="card-body">
                {{-- viene incluso il file che cerca gli appartamenti filtrandoli --}}
                @include('partials.search-partials.filters')
              </div>
            </div>
          </form>
          <div id="btn-slide"class="text-center">
            <i id="angle" class="fas fa-angle-down"></i>
          </div>
        </div>

        @if (!$sponsoredApartments->isEmpty())
          <div class="heading">
            <h2>Appartamenti in evidenza</h2>
          </div>

          <div class="apartments sponsored-apartments card d-flex">
            <div id="carousel" class="carousel slide card-body" data-ride="carousel">
              <div class="carousel-inner" role="listbox">

                <ol class="carousel-indicators">
                  @foreach ($sponsoredApartments as $sponsoredApartment)
                    <li data-target="#carousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                  @endforeach
                </ol>

                @foreach ($sponsoredApartments as $sponsoredApartment)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                      <div class="single-sponsored">

                        @if (Auth::check())
                        <a href="{{route('admin.apartments.show', $sponsoredApartment)}}">
                        @else
                        <a href="{{route('apartments.show', $sponsoredApartment)}}">
                        @endif

                          <div class="img-sponsored">
                            <div class="dark-filter"></div>
                            <img class="d-block img-fluid" src="{{$sponsoredApartment->image}}" alt="">
                          </div>
                          <div class="carousel-caption d-none d-md-block">
                             <h2>{{$sponsoredApartment->title}}</h2>
                          </div>
                        </a>
                      </div>
                    </div>
                @endforeach

                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>

              </div>
            </div>
          </div>
        @endif


        <div class="handlebars-container">
          <h2 class="heading">Risultati appartamenti</h2>
          <div id="handlebars-apartments"></div>
        </div>
      </div>

      <div class="col-xl-6 col-lg-5 col-md-12">
        {{-- Mappa --}}
        <div id="map-search"></div>
      </div>

      {{-- TEMPLATE HANDLEBARS --}}
        <script id="entry-template" type="text/x-handlebars-template">
          <div  class="row search-results-container">
            <div class="col-12">
              <div class="single-apartment card flex-row" lat="@{{ latitude }}" lng="@{{ longitude }}">
              @if (Auth::check())
                <a href="admin/apartments/@{{id}}" class="btn-blue">
                @else
                <a href="apartments/@{{id}}" class="btn-blue">
              @endif
                  <div class="apartment-image card-body">
                    <img src="@{{ image }}" alt="">
                  </div>
                </a>

                <div class="card-body">
                  <h5 class="card-title">@{{title}}</h5>
                  <p>@{{guests}} ospiti | @{{rooms}} Stanze | @{{beds}} letti | @{{baths}} bagni</p>
                  <span>@{{mqs}} metri quadri</span>
                </div>
              </div>
            </div>
          </div>
        </script>

    </div>
  </div>
</section>
@endsection
