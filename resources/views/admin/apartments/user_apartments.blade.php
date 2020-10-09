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

      <div class="row">
        @foreach ($userApartments as $userApartment)
          <div lat="{{ $userApartment->latitude }}" lng="{{ $userApartment->longitude }}" class="col-12 single-apartment mb-3">
            <div class="card flex-row">
              <a href="{{ route('admin.apartments.show', $userApartment) }}">
                <img class="apartment-image img-user-apart" src="{{ $userApartment->image }}" alt="Immagine appartamento">
              </a>
              <div class="card-body">
                <h5 class="card-title">{{ $userApartment->title }}</h5>
                <p>{{ $userApartment->description }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Ultimo aggiornamento {{$userApartment->updated_at}}</small>
                @if ($userApartment->active)
                  <div>
                    <small>Attivo</small>
                  </div>
                @else
                  <div>
                    <small>Disattivo</small>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
</section>
@endsection
