<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Braintree\Gateway;
use App\Mail\NewOrder;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

  public function generate(Gateway $gateway)
  {
      $token = $gateway->clientToken()->generate();
      $data = [
          'success' => true,
          'token' => $token,
      ];
      return response()->json($data,200);
  }

  public function store_order(Request $request, Gateway $gateway) {


    $form_data = $request->all();



    $validator = Validator::make($form_data,
        [
          'amount' => 'required|numeric|min:1|max:999',
          'address' => 'required|min:5|max:255',
          'phone' => 'required|numeric|digits:10',
          'notes' => 'max:1000'
        ],
        [
          'amount.required' => 'Selezionare almeno un prodotto',
          'amount.max' => 'L\'importo non può essere superiore a :max euro.',

          'address.required' => 'L\'indirizzo di spedizione è obbligatorio.',
          'address.min' => 'L\'indirizzo di spedizione deve avere almeno :min caratteri.',
          'address.max' => 'L\'indirizzo di spedizione non può superare i :max caratteri.',

          'phone.required' => 'Il numero di telefono è obbligatorio.',
          'phone.digits' => 'Il numero di telefono deve essere composto da :digits cifre.',

          'notes.max' => 'Le note non possono superare i :max caratteri.',
        ]
      );

      if($validator->fails()){
        $success = false;
        $errors = $validator->errors();
        return response()->json(compact('success', 'errors'));
      }

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

        if($result->success) {
          $data = [
              'success' => true,
              'message' => 'Transaction was successful'
          ];

          Mail::to($email)->send(new NewOrder($order));

          return response()->json($data, 200);

      } else{
          $data = [
              'success' => false,
              'message' => 'Transaction failed'
          ];
          return response()->json($data, 401);
      }

  }
}
