@extends('layouts.app')

@section('title')
  Bool b&b
@endsection

@section('content')
<section id="input-search">
  <div class="container">
    <div class="row">
      <div class="col">
        {{-- <form class="" action="{{ route('search') }}" method="GET">
          <input type="text" name="query" value="">
          <input type="submit" name="" value="Cerca">
          <a class="btn btn-primary" href="{{ route('search', $searchKey)}}">Cerca</a>
        </form> --}}

        <div id="searchbox">

        </div>

        <div id="hits">

        </div>

      </div>
    </div>
  </div>
</section>

<section id="sponsored">
  @include('admin.apartments.partials.sponsored')
</section>
@endsection
