<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Braintree\Gateway;
use App\Mail\NewOrder;
use App\Models\Order;

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


    $validator = Validator::make($form_data,
      [
        'name' => 'required|min:3|max:50',
        'lastname' => 'required|min:3|max:50',
        'email' => 'required|email',
        'amount' => 'min:1|max:999',
        'address' => 'required|min:5|max:255',
        'city' => 'required|min:2|max:60',
        'state' => 'required|size:2',
        'postal_code' => 'required|size:5',
        'phone' => 'required|numeric|digits:10',
        'notes' => 'max:1000'
      ],
      [
        'name.required' => 'Il campo nome è obbligatorio.',
        'name.min' => 'Il campo nome deve contenere almeno :min caratteri.',
        'name.max' => 'Il campo nome non può contenere più di :max caratteri.',

        'lastname.required' => 'Il campo cognome è obbligatorio.',
        'lastname.min' => 'Il campo cognome deve contenere almeno :min caratteri.',
        'lastname.max' => 'Il campo cognome non può contenere più di :max caratteri.',

        'email.required' => 'Il campo email è obbligatorio.',
        'email.email' => 'Inserire una email valida',

        'amount.min' => 'L\'importo deve essere almeno di :min euro',
        'amount.max' => 'L\'importo non può essere maggiore di :max euro',

        'address.required' => 'L\'indirizzo è obbligatorio.',
        'address.min' => 'L\'indirizzo deve contenere almeno :min caratteri.',
        'address.max' => 'L\'indirizzo non può contenere più di :max caratteri.',

        'city.required' => 'Il campo città è obbligatorio.',
        'city.min' => 'Il campo città deve contenere almeno :min caratteri.',
        'city.max' => 'Il campo città non può contenere più di :max caratteri.',

        'state.required' => 'Selezionare una provincia.',
        'state.size' => 'La provincia deve avere :size caratteri',

        'postal_code.required' => 'Il CAP è obbligatorio.',
        'postal_code.size' => 'Il CAP deve contenere esattamente :size caratteri.',

        'phone.required' => 'Il campo telefono è obbligatorio.',
        'phone.numeric' => 'Il campo telefono deve essere un numero.',
        'phone.digits' => 'Il campo telefono deve contenere esattamente :digits cifre.',

        'notes.max' => 'Il campo note non può contenere più di :max caratteri.',
      ]
    );

    if ($validator->fails()) {

      $success = false;
      $errors = $validator->errors();
      return response()->json(compact('success', 'errors'));

    } else {

      $new_order = new Order();
      $new_order->fill($form_data);
      $new_order->save();

      $order_id = $new_order->id;

      $order = Order::find($order_id);

      $pivotData = [];
      foreach ($form_data['products'] as $product) {
        $pivotData[$product['id']] = ['quantity' => $product['quantity']];
      }
      $order->products()->attach($pivotData);

      $result = $gateway->customer()->create([
        'firstName' => $order->name,
        'lastName' => $order->lastname,
        'email' => $order->email,
        'phone' => $order->phone,
      ]);

      $email = $order->email;

      $customer_id = $result->customer->id;

      $result = $gateway->transaction()->sale([
        'customerId' => $customer_id,
        'amount' => $order->amount,
        'paymentMethodNonce' => $form_data['transaction'],
        'options' => [
          'submitForSettlement' => true,
        ],
      ]);

      if ($result->success) {
        $data = [
          'success' => true,
          'message' => 'Transaction was successful',
          'result' => $result,
          'data' => $form_data
        ];

        Mail::to($email)->send(new NewOrder($order));

        return response()->json($data, 200);
      } else {
        $data = [
          'success' => false,
          'message' => 'Transaction failed',
          'result' => $result,
          'data' => $form_data
        ];
        return response()->json($data, 401);
      }

    }
  }
}
