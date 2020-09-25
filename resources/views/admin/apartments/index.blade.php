@extends('layouts.app')

@section('title')
  Bool b&b
@endsection

@section('content')
<section id="input-search">
  <div class="container">
    <div class="row">
      <div class="col">
        <input type="text" name="" value="">
        <a class="btn btn-primary" href="{{ route('admin.search', 'c')}}">Cerca</a>
      </div>
    </div>
  </div>
</section>

<section id="sponsored">
  @include('admin.apartments.partials.sponsored')
</section>
@endsection
