@extends('layouts.app')
@section('title')
  I tuoi appartamenti
@endsection

@section('content')
<section id="user-apartments">
  <div class="container">

    @if (!$userApartments->isEmpty())
      <!-- Appartamenti in evidenza -->
      <h1 class="heading text-center">I tuoi appartamenti</h1>

      <div class="row">
        @foreach ($userApartments as $userApartment)
          <div lat="{{ $userApartment->latitude }}" lng="{{ $userApartment->longitude }}" class="col-12 single-apartment mb-3">
            <div class="card flex-row align-items-center">
              <a href="{{ route('admin.apartments.show', $userApartment) }}">
                <img class="apartment-image img-user-apart" src="{{ $userApartment->image }}" alt="Immagine appartamento">
              </a>

              <div class="card-body">
                <h5 class="card-title">{{ $userApartment->title }}</h5>
                <p>{{ $userApartment->description }}</p>
              </div>

              <div class="card-footer">
                <div class="last-update">
                  <small class="text-muted">Ultimo aggiornamento: <br>{{$userApartment->updated_at}}</small>
                </div>
                @if ($userApartment->active)
                  <div class="status active">
                    <small>Attivo</small>
                  </div>
                @else
                  <div class="status disabled">
                    <small>Disattivo</small>
                  </div>
                @endif
              </div>

            </div>
          </div>
        @endforeach
      </div>

      @else
        <div class="row">
          <div class="col-12 text-center p-5">
            <h2>OPS! Non hai ancora nessun appartamento</h2>
            <a class="btn btn-primary btn-style mt-5" href="{{ route('admin.apartments.index') }}"> Torna alla HomePage</a>
          </div>

        </div>
    @endif
</section>
@endsection
