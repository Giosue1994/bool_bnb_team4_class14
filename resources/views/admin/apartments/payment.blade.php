@extends('layouts.app')
@section('content')

  <div class="container">

    @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
      <div class="col-12">
        <h2>Sponsorizza la stanza “{{ $apartment->title }}”</h2>
        <h3>Scegli la modalità di sponsorizzazione:</h3>
      </div>
      <div class="col-12">
        <form method="post" id="payment-form" action="{{ url('admin/checkout', $apartment) }}">
          @csrf
          <section>
            @foreach ($sponsors as $sponsor)
              <div>
                <input type="radio" name="sponsors[]" value="{{$sponsor->price}}">
                <label>{{ $sponsor->price }} € per {{ $sponsor->duration }} ore di sponsorizzazione</label>
              </div>
            @endforeach

              <div class="bt-drop-in-wrapper">
                  <div id="bt-dropin"></div>
              </div>
          </section>

          <input id="nonce" name="payment_method_nonce" type="hidden" />
          <button class="button" type="submit"><span>Test Transaction</span></button>
      </form>
    </div>
  </div>
</div>

<script>
    var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";
    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      // paypal: {
      //   flow: 'vault'
      // }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      form.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }
          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
    });
</script>

@endsection
