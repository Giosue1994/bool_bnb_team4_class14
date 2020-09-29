{{-- filtra in base ai km --}}
<div class="form-group">
  <input name="rad" type="number" class="form-control" id="form-rad"  placeholder="Raggio in km" value="{{request()->input('rad')}}" />
</div>

<div class="">
  <input name="minRooms" type="number" placeholder="Numero camere" value="{{request()->input('minRooms')}}">
  <input name="minBeds" type="number" placeholder="Numero letti" value="{{request()->input('minBeds')}}">
  <input name="minBaths" type="number" placeholder="Numero cessi" value="{{request()->input('minBaths')}}">
</div>
