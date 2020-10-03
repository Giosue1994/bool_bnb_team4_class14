@extends('layouts.app')

@section('title')
  Bool b&b
@endsection

@section('content')
<section id="input-search">
  <div class="container">
    <div class="row">
      <div class="col">
        <form action="{{ route('search') }}" class="form">
          {{-- viene incluso il file che cerca gli appartamenti in base alle città e gli indirizzi --}}
          @include('partials.search-partials.search-city_address')

          <input id="btn-index-search" type="submit" value="Cerca">
        </form>
      </div>
    </div>
  </div>
</section>

<section id="sponsored">
  @include('admin.apartments.partials.sponsored')
</section>
@endsection
