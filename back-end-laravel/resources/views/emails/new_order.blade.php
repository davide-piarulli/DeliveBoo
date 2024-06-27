<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Conferma Ordine - DeliveBoo</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    .order-details {
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ddd;
    }

    .product-list {
      margin-top: 20px;
    }

    .product-item {
      border-bottom: 1px solid #ddd;
      padding: 10px 0;
    }

    .product-item:last-child {
      border-bottom: none;
    }

    .product-name {
      font-weight: bold;
    }

    .footer {
      margin-top: 20px;
      text-align: center;
      color: #777;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Conferma Ordine - DeliveBoo</h1>

    <div class="order-details">
      <p>Gentile {{ $order->name }} {{ $order->lastname }},</p>
      <p>Grazie per il tuo ordine! Qui di seguito trovi i dettagli:</p>
      <p><strong>Numero ordine:</strong> {{ $order->id }}</p>
      <p><strong>Data ordine:</strong> {{ $order->created_at }}</p>
      <p><strong>Spedizione:</strong>€ 4,99</p>
      <p><strong>Totale ordine:</strong> {{ number_format($order->amount, 2, ',', '') }}</p>
    </div>

    <div class="product-list">
      <h3>Prodotti acquistati:</h3>
      @foreach ($products as $product)
        <div class="product-item">
          <p class="product-name">{{ $product->name }}</p>
          <p>Quantità: {{ $product->pivot->quantity }}</p>
          <p>Prezzo unitario: € {{ number_format($product->pivot->quantity * $product->price, 2, ',', '') }}</p>
        </div>
      @endforeach
    </div>

    <div class="footer">
      <p>Grazie per aver scelto il nostro servizio.</p>
      <p>Copyright &copy; {{ date('Y') }} DeliveBoo. Tutti i diritti riservati.</p>
    </div>
  </div>
</body>

</html>
