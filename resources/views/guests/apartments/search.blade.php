@extends('layouts.app')

@section('title')
  Bool b&b Cerca
@endsection

@section('content')
<section id="search-results">
  <div class="container">
    <div class="row">

      <div class="col">
        <style>
          form {
            width: 100%;
          }
          .form-control {
            width: 100%;
            box-sizing: border-box;
            padding-left: 16px;
            line-height: 40px;
            height: 40px;
            border: 1px solid #ccc;
            border-radius: 3px;
            outline: none;
          }

          .form-group {
            margin-bottom: 1em;
            clear: both;
          }

          .form-group label {
            display: block;
            font-weight: 700;
            font-size: 0.8em;
          }

          .split {
            display: flex;
            flex-direction: row;
            width: 100%;
          }

          .split > * {
            flex-grow: 1;
          }

          .split > *:first-child {
            margin-right: 0.5em;
          }

          .split > *:last-child {
            margin-left: 0.5em;
          }
        </style>

        <form action="{{ route('search') }}" class="form">
          <div class="form-group">
            <label for="form-city">Cerca appartamenti</label>
            <input id="form-city" name="city" type="text" class="form-control" placeholder="Città/Via" />
          </div>

          <div class="split" style="display: none">
            <div class="form-group">
              <input name="lat" type="text" class="form-control" id="form-lat" placeholder="Latitude" />
            </div>
            <div class="form-group">
              <input name="lng" type="text" class="form-control" id="form-lng" placeholder="Longitude" />
            </div>

          </div>
          <div class="form-group">
            <input name="rad" type="number" class="form-control" id="form-rad"  placeholder="Raggio in km" />
          </div>


          <input id="btn-search" type="submit" value="Cerca">
        </form>
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
