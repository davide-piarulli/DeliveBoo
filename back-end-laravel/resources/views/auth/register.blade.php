@extends('layouts.app')

@section('content')
    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form onsubmit="submitForm(event)" id="form"  method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">{{ __('Registrazione') }}</h2>
                                    <p class="text-white-50 mb-5">Inserisci i tuoi dati !</p>

                                    <div class="form-outline form-white mb-4">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}<span
                                                class="mandatory text-danger fw-bold"> *</span></label>

                                        <div class="col-md-6 w-100">
                                            <input id="name" type="text"
                                                class="form-control w-100 @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            <span id="nameError" class="error" class="invalid-feedback"
                                                role="alert"></span><br>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label for="email"
                                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}<span
                                                    class="mandatory text-danger fw-bold"> *</span></label>

                                            <div class="col-md-6 w-100">
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

                                        <div class="form-outline form-white mb-4">
                                            <label for="password"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}<span
                                                    class="mandatory text-danger fw-bold"> *</span></label>

                                            <div class="col-md-6 w-100">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password">
                                                <span id="passwordError" class="error" class="invalid-feedback"
                                                    role="alert"></span><br>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small id="passwordError"></small>
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label for="password-confirm"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}<span
                                                    class="mandatory text-danger fw-bold"> *</span></label>

                                            <div class="col-md-6 w-100">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">
                                                <span id="confirmPasswordError" class="error" class="invalid-feedback"
                                                    role="alert"></span><br>
                                            </div>
                                        </div>

                                        <h4 class="mb-4">Creazione ristorante</h4>

                                        <div class="form-outline form-white mb-4">
                                            <label for="r_name"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Nome Attività') }}<span
                                                    class="mandatory text-danger fw-bold"> *</span></label>


                                            <div class="col-md-6 w-100">
                                                <input value="{{ old('r_name') }}" id="r_name" type="text"
                                                    class="form-control @error('r_name') is-invalid @enderror"
                                                    name="r_name" required>
                                                <span id="rNameError" class="error" class="invalid-feedback"
                                                    role="alert"></span><br>

                                                @error('r_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label for="r_type"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Tipo di Attività') }}<span
                                                    class="mandatory text-danger fw-bold"> *</span></label>

                                            <div class="col-md-6 w-100">

                                                <div class="btn-group btn-group-sm d-flex flex-wrap" role="group">

                                                    <div class="container-fluid">

                                                        <div class="row row-cols-1 row-cols-lg-2">

                                                            @foreach ($types as $type)
                                                                <div class="col mb-2">
                                                                    <input name="types[]" value="{{ $type->id }}"
                                                                        type="checkbox" class="btn-check w-100"
                                                                        id="btncheck{{ $type->id }}"
                                                                        autocomplete="off">
                                                                    <label class="btn register-btn btn-outline-dark w-100 mb-2"
                                                                        for="btncheck{{ $type->id }}">{{ $type->name }}</label>
                                                                </div>
                                                            @endforeach

                                                        </div>

                                                        <span id="rTypeError" class="error" class="invalid-feedback"
                                                            role="alert"></span><br>

                                                    </div>

                                                </div>

                                                <span id="rNameError" class="error" class="invalid-feedback"
                                                    role="alert"></span><br>

                                                @error('r_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label for="r_address"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}<span
                                                    class="mandatory text-danger fw-bold"> *</span></label>

                                            <div class="col-md-6 w-100">
                                                <input value="{{ old('r_address') }}" id="r_address" type="text"
                                                    class="form-control @error('r_address') is-invalid @enderror"
                                                    name="r_address" required>
                                                <span id="rAddressError" class="error" class="invalid-feedback"
                                                    role="alert"></span><br>

                                                @error('r_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label for="r_phone"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}<span
                                                    class="mandatory text-danger fw-bold"> *</span></label>

                                            <div class="col-md-6 w-100">
                                                <input value="{{ old('r_phone') }}" id="r_phone" type="number"
                                                    class="form-control @error('r_phone') is-invalid @enderror"
                                                    name="r_phone" required>
                                                <span id="rPhoneError" class="error" class="invalid-feedback"
                                                    role="alert"></span><br>
                                                @error('r_phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label for="r_vat_number"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}<span
                                                    class="mandatory text-danger fw-bold"> *</span></label>

                                            <div class="col-md-6 w-100">
                                                <input value="{{ old('r_vat_number') }}" id="r_vat_number"
                                                    type="number"
                                                    class="form-control @error('r_vat_number') is-invalid @enderror"
                                                    name="r_vat_number" required>
                                                <span id="rVatNumberError" class="error" class="invalid-feedback"
                                                    role="alert"></span><br>
                                                @error('r_vat_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <button data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-outline-light btn-lg px-5"
                                            type="submit">{{ __('Registrati') }}</button>
                                    </div>

                                    <div>
                                        <p class="mb-0">Hai già un account? <a href="{{ route('login') }}"
                                                class="text-white-50 fw-bold">Accedi</a></p>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function submitForm(event) {

            event.preventDefault();
            document.getElementById('confirmPasswordError').textContent = '';
            document.getElementById('nameError').textContent = '';
            document.getElementById('rNameError').textContent = '';
            document.getElementById('rAddressError').textContent = '';
            document.getElementById('rPhoneError').textContent = '';
            document.getElementById('rVatNumberError').textContent = '';
            document.getElementById('rTypeError').textContent = '';

            const form = document.getElementById('form');
            const name = document.getElementById('name').value.trim();
            const r_name = document.getElementById('r_name').value.trim();
            const r_address = document.getElementById('r_address').value.trim();
            const r_phone = document.getElementById('r_phone').value.trim();
            const r_vat_number = document.getElementById('r_vat_number').value.trim();
            const password = document.getElementById('password').value.trim();
            const passwordConfirm = document.getElementById('password-confirm').value.trim();
            const r_types = document.getElementsByName('types[]');

            // console.log(r_types);

            isFormValid = true;

            const checkedTypes = [];

            r_types.forEach(type => {
                if (type.checked) {
                    checkedTypes.push(type);
                }
            });

            console.log(checkedTypes);

            if (checkedTypes.length === 0) {
                document.getElementById('rTypeError').textContent = 'Selezionare almeno un tipo di attività';
                isFormValid = false;
            }


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
