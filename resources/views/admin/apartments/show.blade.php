@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">{{ $apartment->title }}</h2>
            <h4>{{ $apartment->address }}, {{ $apartment->city }}, {{ $apartment->zip }}</h4>
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
    </div>
  </div>
</div>

@endsection
