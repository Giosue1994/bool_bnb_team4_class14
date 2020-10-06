{{-- struttura per la ricerca in base alle città e gli indirizzi --}}
<div class="form-group">
  <input id="form-city" name="city" type="text"  placeholder="Inizia la ricerca" value="{{request()->input('city')}}"/>
</div>


{{-- latitudine e longitudine rimangono display: none perchè non sappiamo ancora nasconderli per bene --}}
<div class="split" style="display: none">
  <input name="lat" type="text" class="form-control" id="form-lat" placeholder="Latitude" value="{{request()->input('lat')}}"/>
  <input name="lng" type="text" class="form-control" id="form-lng" placeholder="Longitude" value="{{request()->input('lng')}}"/>
</div>
