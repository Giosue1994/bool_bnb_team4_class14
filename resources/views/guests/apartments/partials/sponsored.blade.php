<div class="container">
  <div class="row">
    <h1>Appartamenti in evidenza</h1>

      <div class="row sponsored-apartment">
        @foreach ($apartments as $apartment)
          <a href="{{ route('admin.apartments.show', $apartment) }}">
            <div class="col-4 single-apartment">
              @foreach ($apartment->images as $image)

                @if ($loop->first)
                  <img src="{{ $image->image_path }}" alt="">
                @endif

              @endforeach
              <h2>{{ $apartment->title }}</h2>
            </div>
          </a>
        @endforeach
      </div>

  </div>
</div>
