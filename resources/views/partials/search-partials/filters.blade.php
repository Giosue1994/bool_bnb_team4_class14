{{-- filtra in base ai km --}}
<div class="form-group">
  <input name="rad" type="number" class="form-control" id="form-rad"  placeholder="Raggio in km" value="{{request()->input('rad')}}" />
</div>
{{-- Filtro per informazioni appartamenti --}}
<div class="form-group">
  <input name="minRooms" type="number" placeholder="Numero camere" value="{{request()->input('minRooms')}}">
  <input name="minBeds" type="number" placeholder="Numero letti" value="{{request()->input('minBeds')}}">
  <input name="minBaths" type="number" placeholder="Numero bagni" value="{{request()->input('minBaths')}}">
</div>
{{-- Filtro per servizi --}}
<div class="form-group d-flex justify-content-between">
  
  <div class="d-flex">
    <input class="mr-2" type="checkbox" name="wifi" value="">
    <label>WiFi</label>
  </div>
  <div class="d-flex">
    <input class="mr-2" type="checkbox" name="parking" value="">
    <label>Parcheggio</label>
  </div>
  <div class="d-flex">
    <input class="mr-2" type="checkbox" name="petsAllowed" value="">
    <label>Animali ammessi</label>
  </div>
  <div class="d-flex">
    <input class="mr-2" type="checkbox" name="airConditioning" value="">
    <label>Aria condizionata</label>
  </div>
  <div class="d-flex">
    <input class="mr-2" type="checkbox" name="swimmingPool" value="">
    <label>Piscina</label>
  </div>
  <div class="d-flex">
    <input class="mr-2" type="checkbox" name="washingMachine" value="">
    <label>Lavatrice</label>
  </div>
  <div class="d-flex">
    <input class="mr-2" type="checkbox" name="tv" value="">
    <label>TV</label>
  </div>
  <div class="d-flex">
    <input class="mr-2" type="checkbox" name="kitchen" value="">
    <label>Cucina</label>
  </div>
  <div class="d-flex">
    <input class="mr-2" type="checkbox" name="breakfast" value="">
    <label>Colazione</label>
  </div>

</div>
