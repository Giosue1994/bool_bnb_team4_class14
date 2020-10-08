@extends('layouts.app')
@section('title')
  I tuoi messaggi
@endsection

@section('content')
<section>
  <div class="container">

    @if (!$emailsReceived->isEmpty())
      <!-- Appartamenti in evidenza -->
      <h1 class="heading text-center">I tuoi messaggi</h1>

      <div class="row">
        @foreach ($emailsReceived as $emailReceived)
          <div class="col-12 single-email mb-3">
            <div class="card flex-row">
              {{-- <a href="{{ route('admin.apartments.show', $userApartment) }}">
                <img class="apartment-image img-user-apart" src="{{ $userApartment->image }}" alt="Immagine appartamento">
              </a> --}}
              <div class="card-body">
                <small class="card-title">{{ $emailReceived->email }}</small>
                <p>{{ $emailReceived->message }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Ricevuto il {{$emailReceived->date}}</small>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    @else
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body d-flex justify-content-center align-center">
              <h1>Non hai email da visualizzare</h1>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <a class="btn btn-primary mt-3" href="{{ route('admin.apartments.index')}}"> Torna alla lista appartamenti</a>
          </div>

        </div>

      </div>
    @endif
</section>
@endsection
