@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Registrazione') }}</div>

          <div class="card-body">
            <form onsubmit="submitForm(event)" id="form" method="POST" action="{{ route('register') }}">
              @csrf

              <div class="mb-4 row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}<span
                    class="mandatory text-danger fw-bold"> *</span></label>

                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  <span id="nameError" class="error" class="invalid-feedback" role="alert"></span><br>
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-5 row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}<span
                    class="mandatory text-danger fw-bold"> *</span></label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}<span
                    class="mandatory text-danger fw-bold"> *</span></label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">
                  <span id="passwordError" class="error" class="invalid-feedback" role="alert"></span><br>
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <small id="passwordError"></small>
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}<span
                    class="mandatory text-danger fw-bold"> *</span></label>

                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
                  <span id="confirmPasswordError" class="error" class="invalid-feedback" role="alert"></span><br>
                </div>
              </div>

              {{-- Creazione ristorante --}}

              <h4 class="mb-4">Creazione ristorante</h4>

              {{-- Nome del ristorante --}}

              <div class="mb-4 row">
                <label for="r_name" class="col-md-4 col-form-label text-md-right">{{ __('Nome Attività') }}<span
                    class="mandatory text-danger fw-bold"> *</span></label>


                <div class="col-md-6">
                  <input value="{{ old('r_name') }}" id="r_name" type="text"
                    class="form-control @error('r_name') is-invalid @enderror" name="r_name" required>
                  <span id="rNameError" class="error" class="invalid-feedback" role="alert"></span><br>

                  @error('r_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              {{-- Tipologia di ristorante --}}

              <div class="mb-5 row">
                <label for="r_type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo di Attività') }}<span
                    class="mandatory text-danger fw-bold"> *</span></label>


                <div class="col-md-6">

                  <div class="btn-group btn-group-sm d-flex flex-wrap" role="group">

                    @foreach ($types as $type)
                      <input name="types[]" value="{{ $type->id }}" type="checkbox" class="btn-check"
                        id="btncheck{{ $type->id }}" autocomplete="off">
                      <label class="btn btn-outline-primary"
                        for="btncheck{{ $type->id }}">{{ $type->name }}</label>
                    @endforeach

                  </div>

                  <span id="rNameError" class="error" class="invalid-feedback" role="alert"></span><br>

                  @error('r_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              {{-- Indirizzo del ristorante --}}

              <div class="mb-4 row">
                <label for="r_address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}<span
                    class="mandatory text-danger fw-bold"> *</span></label>

                <div class="col-md-6">
                  <input value="{{ old('r_address') }}" id="r_address" type="text"
                    class="form-control @error('r_address') is-invalid @enderror" name="r_address" required>
                  <span id="rAddressError" class="error" class="invalid-feedback" role="alert"></span><br>

                  @error('r_address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              {{-- Telefono del ristornate --}}

              <div class="mb-4 row">
                <label for="r_phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}<span
                    class="mandatory text-danger fw-bold"> *</span></label>

                <div class="col-md-6">
                  <input value="{{ old('r_phone') }}" id="r_phone" type="number"
                    class="form-control @error('r_phone') is-invalid @enderror" name="r_phone" required>
                  <span id="rPhoneError" class="error" class="invalid-feedback" role="alert"></span><br>
                  @error('r_phone')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              {{-- Partita IVA del ristorante --}}

              <div class="mb-4 row">
                <label for="r_vat_number" class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}<span
                    class="mandatory text-danger fw-bold"> *</span></label>

                <div class="col-md-6">
                  <input value="{{ old('r_vat_number') }}" id="r_vat_number" type="number"
                    class="form-control @error('r_vat_number') is-invalid @enderror" name="r_vat_number" required>
                  <span id="rVatNumberError" class="error" class="invalid-feedback" role="alert"></span><br>
                  @error('r_vat_number')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>


              <div class="mb-4 row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Registrati') }}
                  </button>
                  <p class="mandatory text-danger fw-bold mt-2"> * Campi obbligatori</p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function submitForm(event) {

      event.preventDefault();
      document.getElementById('confirmPasswordError').textContent = '';
      document.getElementById('nameError').textContent = '';
      document.getElementById('rNameError').textContent = '';
      document.getElementById('rAddressError').textContent = '';
      document.getElementById('rPhoneError').textContent = '';
      document.getElementById('rVatNumberError').textContent = '';

      const form = document.getElementById('form');
      const name = document.getElementById('name').value.trim();
      const r_name = document.getElementById('r_name').value.trim();
      const r_address = document.getElementById('r_address').value.trim();
      const r_phone = document.getElementById('r_phone').value.trim();
      const r_vat_number = document.getElementById('r_vat_number').value.trim();
      const password = document.getElementById('password').value.trim();
      const passwordConfirm = document.getElementById('password-confirm').value.trim();

      isFormValid = true;

      if (password !== passwordConfirm) {
        document.getElementById('confirmPasswordError').textContent = 'Le password non corrispondono';
        isFormValid = false;
      }

      if (name.length > 50) {
        document.getElementById('nameError').textContent = 'Il nome è troppo lungo!';
        isFormValid = false;
      }

      if (r_name.length > 50) {
        document.getElementById('rNameError').textContent = 'Il nome dell\'attività è troppo lungo!';
        isFormValid = false;
      }

      if (r_address.length > 255) {
        document.getElementById('rAddressError').textContent = 'L\'indirizzo è troppo lungo!';
        isFormValid = false;
      }

      if (r_phone.length !== 10) {
        document.getElementById('rPhoneError').textContent = 'Il numero di telefono deve essere di 10 caratteri!';
        isFormValid = false;
      }

      if (r_vat_number.length !== 11) {
        document.getElementById('rVatNumberError').textContent = 'La partita IVA deve essere di 11 caratteri!';
        isFormValid = false;
      }

      if (isFormValid) {
        form.submit();
      }
    }
  </script>
@endsection
