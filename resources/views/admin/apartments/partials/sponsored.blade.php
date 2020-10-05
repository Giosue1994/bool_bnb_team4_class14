<div class="container">
  <div class="row">
    <h1>Appartamenti in evidenza</h1>
    <br>
    <div>
      <a class="btn btn-primary" href="{{ route('admin.apartments.create')}}">Inserisci il tuo appartamento</a>
    </div>

      <div id="sponsored" class="row sponsored-apartment">
        @foreach ($apartments as $apartment)
          <a href="{{ route('admin.apartments.show', $apartment) }}">
            <div lat="{{ $apartment->latitude }}" lng="{{ $apartment->longitude }}" class="col-4 single-apartment">
              <img src="{{ $apartment->image }}" alt="">
              <h2>{{ $apartment->title }}</h2>
            </div>
          </a>
        @endforeach
      </div>

  </div>
</div>
