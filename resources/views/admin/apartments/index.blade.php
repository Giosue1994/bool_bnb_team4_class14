@extends('layouts.app')

@section('title')
  Bool b&b
@endsection

@section('content')
<section id="input-search">
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

          <input id="btn-search" type="submit" value="Cerca">
        </form>
      </div>
    </div>
  </div>
</section>

<section id="sponsored">
  @include('admin.apartments.partials.sponsored')
</section>
@endsection
