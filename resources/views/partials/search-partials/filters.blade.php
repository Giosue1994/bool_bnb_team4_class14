{{-- filtra in base ai km --}}
<div class="form-group">
  <input name="rad" type="number" class="ap-input my-number" id="form-rad" placeholder="Raggio in km" value="{{request()->input('rad')}}" />
</div>

{{-- Filtro per informazioni appartamenti --}}
<div class="form-group d-flex">
  <input id="form-minRooms" class="ap-input my-number" name="minRooms" type="number" placeholder="Camere" value="{{request()->input('minRooms')}}">
  <input id="form-minBeds" class="ap-input my-number" name="minBeds" type="number" placeholder="Letti" value="{{request()->input('minBeds')}}">
  <input id="form-minBaths" class="ap-input my-number" name="minBaths" type="number" placeholder="Bagni" value="{{request()->input('minBaths')}}">
</div>

{{-- Filtro per servizi --}}
<div class="form-group justify-content-between">
  <div class="checkboxes">
    <span>Servizi aggiuntivi</span>
      <div class="d-flex">
      @foreach ($services as $service)
        <input class="checkbox" type="checkbox" name="services[]" value="{{$service->id}}">
        <label class="ml-2 mr-2">{{$service->name}}</label>
      @endforeach
    </div>
  </div>
</div>
