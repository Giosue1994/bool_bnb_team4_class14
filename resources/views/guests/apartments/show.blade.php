@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">{{ $apartment->title }}</h2>
            <div class="">
              @foreach ($apartment->images as $image)
                <img src="{{ $image->image_path }}" alt="">
              @endforeach

            </div>
            <p class="card-text">{{ $apartment->description }}</p>
            <p class="card-text"><small class="text-muted">Author: {{ $apartment->user->name }} - Creato il: {{ $apartment->created_at->format('d/m/y') }}</small></p>

            <div>
              <ul>
                <li>Numero stanze: {{ $apartment->rooms }}</li>
                <li>Numero bagni: {{ $apartment->baths }}</li>
                <li>Numero letti: {{ $apartment->beds }}</li>
                <li>Numero ospiti: {{ $apartment->guests }}</li>
                <li>Metri quadri: {{ $apartment->mqs }}</li>
                <li>Indirizzo: {{ $apartment->address }} {{ $apartment->city }} {{ $apartment->zip }}</li>
              </ul>

            </div>

            <div class="services-list">
              <h3>Servizi aggiuntivi</h3>
              @if ($apartment->services->isEmpty())
                <p>Non ci sono servizi</p>
              @else
                  <ul>
                    @foreach ($apartment->services as $service)
                      <li>{{$service->name}}</li>
                    @endforeach
                  </ul>
              @endif
            </div>

            <div class="mb-2">
              <a class="btn btn-primary" href="{{ route('apartments.index')}}"> Torna alla lista appartamenti</a>

            </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
