<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrder;
use App\Models\Order;
use Braintree\Gateway;

class OrderController extends Controller
{
  public function generate(Gateway $gateway)
  {
    $token = $gateway->clientToken()->generate();
    $data = [
      'success' => true,
      'token' => $token,
    ];
    return response()->json($data, 200);
  }

  public function store(Request $request, Gateway $gateway)
  {

    $form_data = $request->all();
    // dump($form_data);
    // dd($gateway);

    $validator = Validator::make(
      $form_data,
      [
        'amount' => 'required|numeric|min:1|max:999',
        'shipment_address' => 'required|min:5|max:255',
        'phone' => 'required|numeric|digits:10',
        'notes' => 'max:1000'
      ],
      [
        'amount.required' => 'Selezionare almeno un prodotto',
        'amount.max' => 'L\'importo non può essere superiore a :max euro.',

        'shipment_address.required' => 'L\'indirizzo di spedizione è obbligatorio.',
        'shipment_address.min' => 'L\'indirizzo di spedizione deve avere almeno :min caratteri.',
        'shipment_address.max' => 'L\'indirizzo di spedizione non può superare i :max caratteri.',

        'phone.required' => 'Il numero di telefono è obbligatorio.',
        'phone.digits' => 'Il numero di telefono deve essere composto da :digits cifre.',

        'notes.max' => 'Le note non possono superare i :max caratteri.',
      ]
    );

    if ($validator->fails()) {
      $success = false;
      $errors = $validator->errors();
      return response()->json(compact('success', 'errors'));
    }

    $new_order = new Order();
    $new_order->fill($form_data);
    $new_order->save();

    $nonceFromTheClient = $request->payment_method_nonce;
    $result = $gateway->transaction()->sale([
      'amount' => $new_order->amount,
      'paymentMethodNonce' => $nonceFromTheClient,
      'options' => [
        'submitForSettlement' => true,
      ],
    ]);
    if ($result->success) {
      $data = [
        'success' => true,
        'message' => 'Transaction was successful',
      ];

      Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewOrder($new_order));
      
      return response()->json($data, 200);
    } else {
      $data = [
        'success' => false,
        'message' => 'Transaction failed',
      ];
      return response()->json($data, 401);
    }
  }
}
