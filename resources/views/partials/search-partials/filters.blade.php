{{-- filtra in base ai km --}}
<div class="form-group">
  <input name="rad" type="number" class="form-control" id="form-rad"  placeholder="Raggio in km" value="{{request()->input('rad')}}" />
</div>
{{-- Filtro per informazioni appartamenti --}}
<div class="form-group">
  <input id="form-minRooms" name="minRooms" type="number" placeholder="Numero camere" value="{{request()->input('minRooms')}}">
  <input id="form-minBeds" name="minBeds" type="number" placeholder="Numero letti" value="{{request()->input('minBeds')}}">
  <input id="form-minBaths" name="minBaths" type="number" placeholder="Numero bagni" value="{{request()->input('minBaths')}}">
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
