@extends('layouts.app')

@section('title')
  Bool b&b create
@endsection

@section('content')
<section id="create">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="create_form">
      <form action="{{route('admin.apartments.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div>
          <label>Titolo appartamento</label>
          <input type="text" name="title" value="{{old('title')}}" placeholder="Titolo appartamento">
        </div>

        <div>
          <label>Descrizione appartamento</label>
          <textarea name="description" rows="8" cols="80" placeholder="description">{{old('description')}}</textarea>
        </div>

        <div>
          <label>Numero stanze</label>
          <input type="number" name="rooms" value="{{old('rooms')}}" placeholder="Numero stanze">
        </div>

        <div>
          <label>Numero bagni</label>
          <input type="number" name="baths" value="{{old('baths')}}" placeholder="Numero bagni">
        </div>

        <div>
          <label>Numero letti</label>
          <input type="number" name="beds" value="{{old('beds')}}" placeholder="Numero letti">
        </div>

        <div>
          <label>Numero ospiti</label>
          <input type="number" name="guests" value="{{old('guests')}}" placeholder="Numero ospiti">
        </div>

        <div>
          <label>Metratura in mq</label>
          <input type="number" name="mqs" value="{{old('mqs')}}" placeholder="Metratura in mq">
        </div>

        <div>
          <label>Indirizzo</label>
          <input type="text" name="city" value="{{old('city')}}" placeholder="Città">
          <input type="text" name="address" value="{{old('address')}}" placeholder="Via / Piazza / Strada">
          <input type="text" name="zip" value="{{old('zip')}}" placeholder="CAP / ZIP">
          <div>
            <label>Latitudine</label>
            <input type="text" name="latitude" value="{{old('latitude')}}" placeholder="Latitudine">
          </div>
          <div>
            <label>Longitudine</label>
            <input type="text" name="longitude" value="{{old('longitude')}}" placeholder="Longitudine">
          </div>
        </div>

        <div class="chekboxes">
          <span>Servizi aggiuntivi</span>
          @foreach ($services as $service)
            <div>
              <input type="checkbox" name="services[]" value="{{$service->id}}">
              <label>{{$service->name}}</label>
            </div>
          @endforeach
        </div>

        <div class="">
          <label>Inserisci immagine</label>
          <input type="file" name="image_path" accept="image/*">
        </div>

        <input type="submit" value="Salva">

      </form>
    </div>
      </div>
    </div>
  </div>
</section>
@endsection
