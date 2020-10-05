<div class="container">
  <div class="row">
    <h1>Appartamenti in evidenza</h1>

      <div class="row sponsored-apartment">
        @foreach ($apartments as $apartment)
          <a href="{{ route('apartments.show', $apartment) }}">
            <div lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}" class="col-4 single-apartment">
              <img src="{{ $apartment->image }}" alt="">
              <h2>{{ $apartment->title }}</h2>
            </div>
          </a>
        @endforeach
      </div>

  </div>
</div>
