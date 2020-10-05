<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree;

class PaymentController extends Controller
{
  public function payment() {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    // dd($gateway);

    $token = $gateway->clientToken()->generate();

    return view('admin.apartments.payment', [
        'token' => $token
    ]);
  }
}
