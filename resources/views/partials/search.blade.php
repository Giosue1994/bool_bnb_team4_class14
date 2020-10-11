@extends('layouts.app')

@section('title')
  Bool b&b Cerca
@endsection

@section('content')
<section id="search-results">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
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
            <i id="angle" class="fas fa-angle-down"></i><span>Filtri</span>
          </div>
        </div>

        @if (!$sponsoredApartments->isEmpty())
          <div class="heading">
            <h2>Appartamenti in evidenza</h2>
          </div>

          <div class="apartments sponsored-apartments d-flex">
            <div id="carousel" class="carousel slide" data-ride="carousel">
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

        <div class="apartment-count">
          <h2>Risultati appartamenti</h2>

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
