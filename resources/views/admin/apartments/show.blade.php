@extends('layouts.app')
@section('content')
  <section id="admin-show" class="show">
    <div class="container">
      <div class="card">
        <div class="row card-body">

          <div class="col-12 single-apartment" lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}">
            <div class="d-flex justify-content-between">
              <div class="col-6">
                <h2 id="title" class="card-title">{{ $apartment->title }}</h2>
                <h4>{{ $apartment->address }}, {{ $apartment->city }}, {{ $apartment->zip }}</h4>
              </div>
              <div>
                @if ($logged_user->id === $apartment->user->id)
                  <a class="btn btn-success btn-style" href="{{ route('admin.payment', $apartment) }}">Sponsorizza appartamento</a>
                  <a class="btn btn-warning btn-style" href="{{ route('admin.statistics', $apartment) }}">Visualizza statistiche</a>
                @endif
              </div>


            </div>
            <div class="apartment-image">
              <img src="{{ $apartment->image }}" alt="">
            </div>
            <p><small class="text-muted">Autore: {{ $apartment->user->name }} - Creato il: {{ $apartment->created_at->format('d/m/y') }}</small></p>
          </div>

          <div class="col-lg-6 col-md-12 apartment-informations">
            <div class="informations card mb-2">
              <div class="card-body">
                <h3>Informazioni</h3>
                <ul>
                  <li>Numero stanze: {{ $apartment->rooms }}</li>
                  <li>Numero bagni: {{ $apartment->baths }}</li>
                  <li>Numero letti: {{ $apartment->beds }}</li>
                  <li>Numero Ospiti: {{ $apartment->guests }}</li>
                  <li>Metri quadri: {{ $apartment->mqs }}</li>
                </ul>
              </div>
            </div>

            <div class="services-list card mb-2">
              <div class="card-body">
                <h3>Servizi aggiuntivi</h3>
                @if ($apartment->services->isEmpty())
                  <p>Non ci sono servizi</p>
                @else
                  <ul>
                    @foreach ($apartment->services as $service)
                      <li>
                        @if ($service->name == 'Wifi')
                          <i class="fas fa-wifi"></i>
                        @elseif ($service->name == 'Parcheggio')
                            <i class="fas fa-parking"></i>
                          @elseif ($service->name == 'Animali ammessi')
                              <i class="fas fa-dog"></i>
                            @elseif ($service->name == 'Aria condizionata')
                              <i class="fas fa-fan"></i>
                            @elseif ($service->name == 'Servizio lavanderia')
                              <i class="fas fa-washer"></i>
                            @elseif ($service->name == 'Tv')
                              <i class="fas fa-tv"></i>
                            @elseif ($service->name == 'Cucina')
                              <i class="fas fa-utensils"></i>
                            @elseif ($service->name == 'Breakfast')
                              <i class="far fa-coffee"></i>
                            @elseif ($service->name == 'Piscina')
                              <i class="fas fa-swimming-pool"></i>
                        @endif
                        {{$service->name}}</li>
                    @endforeach
                  </ul>
                @endif
              </div>
            </div>

            <div class="description card mb-2">
              <div class="card-body">
                <h3>Descrizione</h3>
                <p>{{ $apartment->description }}</p>
              </div>
            </div>

            @if (!($endSponsors->isEmpty()) && $logged_user->id === $apartment->user->id)
              <h3>Sponsorizzazioni attive</h3>
              <ol>
                @foreach ($endSponsors as $sponsor)
                  <li>Scade il: {{$sponsor}}</li>
                @endforeach
              </ol>
            @endif
          </div>

          <div class="col-lg-6 col-md-12">
            <div class="col-12 apartment-map">
              <div class="card mb-2">
                <div class="card-body">
                  <h3>Mappa appartamento</h3>
                  <div id="map-show"></div>
                </div>
              </div>

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
            <div class="col-12 apartment-email">
              <div class="message-form card mb-2">
                <div class="card-body">
                  <h3>Scrivi al proprietario</h3>
                  <form class="email-form" action="{{route('admin.send-email', $apartment)}}" method="post">
                    @csrf
                    @method('POST')
                    <div>
                      <input type="text" name="userMail" value="{{$logged_user->email}}" readonly placeholder="Email">
                    </div>
                    <div>
                      <textarea name="bodyMessage" rows="8" cols="46" placeholder="Scrivi un messaggio"></textarea>
                    </div>
                    <div>
                      <input type="submit" name="" value="Invia">
                    </div>
                  </form>
                </div>
              </div>
              @if (session('success'))
                <div id="success_message" class="message ">
                  {{session('success')}}
                </div>
              @endif
            </div>
          </div>

          <div class="col-12 apartment-admin-function">
            {{-- <a class="btn btn-primary" href="{{ route('admin.apartments.index')}}"> Torna alla lista appartamenti</a> --}}
            @if ($logged_user->id === $apartment->user->id)
              <a class="btn btn-primary btn-style" href="{{ route('admin.apartments.edit', $apartment) }}"> Modifica Appartamento</a>
              <form class="delete" action="{{ route('admin.apartments.destroy', $apartment) }}" method="post">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger btn-style" type="submit" value="Elimina">
              </form>
            @endif
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection
