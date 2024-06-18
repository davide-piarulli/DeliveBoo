@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrazione') }}</div>

                    <div class="card-body">
                        <form id="form" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail ') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

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
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- Creazione ristorante --}}

                            <div>
                                <h3>Creazione ristorante</h3>
                            </div>
                            {{-- Nome del ristorante --}}
                            <div class="mb-4 row">
                                <label for="r_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome Attività') }}</label>

                                <div class="col-md-6">
                                    <input id="r_name" type="text"
                                        class="form-control @error('r_name') is-invalid @enderror" name="r_name" required>

                                    @error('r_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Address del ristorante --}}

                            <div class="mb-4 row">
                                <label for="r_address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>

                                <div class="col-md-6">
                                    <input id="r_address" type="text"
                                        class="form-control @error('r_address') is-invalid @enderror" name="r_address"
                                        required>

                                    @error('r_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- phone del ristornate --}}

                            <div class="mb-4 row">
                                <label for="r_phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="r_phone" type="number"
                                        class="form-control @error('r_phone') is-invalid @enderror" name="r_phone" required>

                                    @error('r_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- vat_number del ristorante --}}

                            <div class="mb-4 row">
                                <label for="r_vat_number"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}</label>

                                <div class="col-md-6">
                                    <input id="r_vat_number" type="number"
                                        class="form-control @error('r_vat_number') is-invalid @enderror" name="r_vat_number"
                                        required>

                                    @error('r_vat_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button onclick="submitForm(event)" type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>

        function submitForm(event) {

            let formIsValid = true;

            // Validazione del campo password
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password-confirm');
            const passwordValue = password.value.trim();
            const passwordConfirmValue = passwordConfirm.value.trim();
            const passwordError = document.getElementById('passwordError');

            console.log(passwordValue);
            console.log(passwordConfirmValue);

            if (passwordValue === '') {
                passwordError.textContent = 'Inserisci una password';
                formIsValid = false;
            } else if (passwordValue !== passwordConfirmValue) {
                passwordError.textContent = 'Le password non coincidono';
                formIsValid = false;
            } else {
                passwordError.textContent = '';
            }

            if (!formIsValid) {
                event.preventDefault(); // Impedisce l'invio del form se non è valido
            } else {
                const formId = document.getElementById('form');
                formId.submit(); // Invia il form se è valido
            }
        }
    </script> --}}
@endsection
