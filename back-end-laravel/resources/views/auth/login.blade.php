@extends('layouts.app')

@section('content')

    <section class="gradient-custom" style="height: 100vh">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form onsubmit="submitForm(event)" id="form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">{{ __('Accedi') }}</h2>
                                    <p class="text-white-50 mb-5">Inserisci i tuoi dati !</p>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="email">{{ __('E-Mail *') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <span id="emailError" class="error" class="invalid-feedback"
                                            role="alert"></span><br>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                      <label class="form-label" for="email">{{ __('Password *') }}</label>

                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    @if (Route::has('password.request'))
                                        <p class="small mb-5 pb-lg-2"><a class="btn text-decoration-none text-white btn-link"
                                                href="{{ route('password.request') }}">
                                                {{ __('Password dimenticata?') }}
                                            </a></p>
                                    @endif
                                    <button data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-outline-light btn-lg px-5" type="submit">{{ __('Accedi') }}</button>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i
                                                class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>

                                </div>

                                <div>
                                    <p class="mb-0">Non hai un Account? <a href="{{route('register')}}"
                                            class="text-white-50 fw-bold">Registrati</a>
                                    </p>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function validateEmail(email) {
            const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return re.test(String(email).toLowerCase());
        }

        function submitForm(event) {

            event.preventDefault();
            document.getElementById('emailError').textContent = '';

            const form = document.getElementById('form');
            const email = document.getElementById('email').value.trim();

            isFormValid = true;

            if (!validateEmail(email)) {
                document.getElementById('emailError').textContent = 'Email non valida!';
                isFormValid = false;
            }

            if (isFormValid) {
                form.submit();
            }

        }
    </script>
@endsection
