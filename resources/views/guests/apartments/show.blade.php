@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}" class=" single-apartment card-body">
            <a class="btn btn-warning" href="{{ url()->previous('search') }}"> Torna indietro</a>
            <h2 id="title" class="card-title">{{ $apartment->title }}</h2>
            <div class="">
              <img src="{{ $apartment->image }}" alt="">
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

    <div class="col-6">
      <div id="map-example-container"></div>

      <script>
      (function() {

      var title = document.getElementById('title').innerText;

      var latlng = {
        lat: document.querySelector('.single-apartment').getAttribute("lat"),
        lng: document.querySelector('.single-apartment').getAttribute("lng")
      };

      var map = L.map('map-example-container', {
        scrollWheelZoom: false,
        zoomControl: false,
        keyboard: false,
        dragging: false,
        boxZoom: false,
        doubleClickZoom: false,
        tap: false,
        touchZoom: false,
      });

      var osmLayer = new L.TileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          minZoom: 12,
          maxZoom: 18,
          attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }
      );

      map.setView(new L.LatLng(latlng.lat, latlng.lng), 17);

      map.addLayer(osmLayer);

      var marker = L.marker([latlng.lat, latlng.lng])
      .addTo(map)
      .bindPopup(title);

      })();
      </script>
    </div>
  </div>
</div>

@endsection
