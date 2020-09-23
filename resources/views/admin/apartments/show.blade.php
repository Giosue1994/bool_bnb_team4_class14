@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">{{ $apartment->title }}</h2>
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
            <div class="mb-2">
              <a class="btn btn-primary" href="{{ route('admin.apartments.index')}}"> Torna alla lista post</a>
              {{-- <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post) }}"> Modifica Post</a> --}}
            </div>
            <div class="">
              @foreach ($apartment->images as $image)
                <img src="{{ $image->image_path }}" alt="">
              @endforeach

            </div>

              {{-- @if (!empty($apartment->images->image_path))
              <div>
              @if (File::exists('storage'.'/'. $apartment->images->image_path))
                <img class="card-img-bottom" src="{{asset('storage') . '/' . $apartment->images->image_path}}" alt="{{ $apartment->title }}">
              @else
                <img class="card-img-bottom" src="{{$apartment->images->image_path}}" alt="{{ $apartment->title }}">
              @endif
            </div>
          @endif --}}

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
