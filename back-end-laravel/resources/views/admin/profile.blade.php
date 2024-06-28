@extends('layouts.admin')



@section('title')
  - Profilo
@endsection



@section('content')
  <div class="container my-5">
    <h1 class="mb-5">Ciao {{ Auth::user()->name }}!</h1>
    <p>Benvenut* su DeliveBoo! <br>
      Ecco una semplice guida per iniziare ad utilizzare la piattaforma: <br>
    <ul>
      <li>Inizia aggiungendo nuovi prodotti al tuo menù, direttamente dalla sezione "Elenco Prodotti". Inserisci sempre
        tutti i campi obbligatori, cosicchè il tuo menù sia sempre completo.</li>
      <li>Quando ricevi un'ordine, lo visualizzerai all'interno della sezione "Ordini Ricevuti". Da lì potrai visualizzare
        il dettaglio dell'ordine e del cliente.</li>
    </ul>
    </p>
  </div>
@endsection
