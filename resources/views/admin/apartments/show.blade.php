@extends('layouts.app')
@section('content')
  <section id="admin-show">
    <div class="container">
      <div class="card">
        <div class="row">
          <div class="col-6">
            <div lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}" class=" single-apartment card-body">
              <h2 id="title" class="card-title">{{ $apartment->title }}</h2>
              <h4>{{ $apartment->address }}, {{ $apartment->city }}, {{ $apartment->zip }}</h4>
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
                <a class="btn btn-primary" href="{{ route('admin.apartments.index')}}"> Torna alla lista appartamenti</a>
                @if ($logged_user->id === $apartment->user->id)
                <a class="btn btn-warning" href="{{ route('admin.payment', $apartment) }}">Sponsorizza appartamento</a>
                <a class="btn btn-warning" href="{{ route('admin.apartments.edit', $apartment) }}"> Modifica Appartamento</a>
                <form class="delete" action="{{ route('admin.apartments.destroy', $apartment) }}" method="post">

                  @csrf
                  @method('DELETE')

                  <input class="btn btn-danger" type="submit" value="Elimina">
                </form>
                @endif
              </div>
            </div>
          </div>
          <div class="col-6">

            <div class="col-12">
              <h3>Mappa appartamento</h3>
              <div id="map-show"></div>

              <script>
              (function() {

              var title = document.getElementById('title').innerText;

              var latlng = {
                lat: document.querySelector('.single-apartment').getAttribute("lat"),
                lng: document.querySelector('.single-apartment').getAttribute("lng")
              };

              var map = L.map('map-show', {
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
            <div class="col-12">
              <h3>Scrivi al proprietario</h3>
              <div class="message-form">
                <form action="index.html" method="post">
                  <input type="text" name="" value="" placeholder="Email">
                  <textarea name="name" rows="8" cols="61" placeholder="Scrivi un messaggio"></textarea>
                  <input type="submit" name="" value="Invia">
                </form>
              </div>
            </div>

        </div>
        </div>
      </div>
    </div>
  </section>
@endsection
