@extends('layouts.app')

@section('title')
  Bool b&b Cerca
@endsection

@section('content')
<section id="search-results">
  <div class="container">
    <div class="row">

      <div class="col">
        {{-- <form class="" action="{{ route('search') }}" method="GET">
          <input type="text" name="city" value="{{ request()->input('city') }}">
          <input type="submit" value="Cerca">
        </form> --}}
      </div>

      <h2>Risultati appartamenti</h2>
      <p>{{ $apartments->count() }} risultati per {{ ucfirst(request()->input('city')) }}</p>
      <div class="col">
        <div id="search-results">
          @foreach ($apartments as $apartment)
            <a href="{{ route('apartments.show', $apartment) }}">
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
      </div>
    </div>
  </div>
</section>
@endsection
