<div class="container">
  <div class="row">
    <h1>Appartamenti in evidenza</h1>

      <div class="row sponsored-apartment">
        @foreach ($apartments as $apartment)
          <div class="col-4 single-apartment">
            @foreach ($apartment->images as $image)

              @if ($loop->first)
                <a href="{{ route('admin.apartments.show', $apartment) }}">
                  <img src="{{ $image->image_path }}" alt="">
                </a>
              @endif

            @endforeach
            <h2>{{ $apartment->title }}</h2>
          </div>
        @endforeach
      </div>

  </div>
</div>
