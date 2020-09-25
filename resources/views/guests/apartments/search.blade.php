@extends('layouts.app')

@section('title')
  Bool b&b Cerca
@endsection

@section('content')
<section id="search-results">
  <div class="container">
    <div class="row">

      <div class="col">
        <input type="text" name="" value="">
        {{-- <a class="btn btn-primary" href="{{ route('search', $searchKey)}}">Cerca</a> --}}
      </div>

      <div class="col">
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
</section>
@endsection
