@extends('layouts.app')
@section('title')
  I tuoi appartamenti
@endsection

@section('content')
<section>
  <div class="container">

    @if (!$userApartments->isEmpty())
      <!-- Appartamenti in evidenza -->
      <h1 class="heading text-center">I tuoi appartamenti</h1>
      <div class="row apartments sponsored-apartments d-flex justify-content-center">
        @foreach ($userApartments as $userApartment)
          <div lat="{{ $userApartment->latitude }}" lng="{{ $userApartment->longitude }}" class="col-4 single-apartment">
            <a href="{{ route('admin.apartments.show', $userApartment) }}">
              <img class="apartment-image" src="{{ $userApartment->image }}" alt="Immagine appartamento">
              <h2 class="text-center">{{ $userApartment->title }}</h2>
            </a>
          </div>
        @endforeach
      </div>
    @endif
</section>



@endsection
