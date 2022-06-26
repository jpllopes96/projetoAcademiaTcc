@extends('layouts.appHome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-5 py-4 mt-5" style="max-width: 400px">

                <div class="card bg-white text-dark rounded-lg fw-light shadow-lg">
                    <div class="card-body p-4">

                        <h1 class="text-center fw-bold fs-5 mb-4 ">{{ __('Login') }}</h1>
                        @if (session('erro_login_social'))
                            <div class="alert alert-danger text-center" role="alert">
                                <strong>Login do {{ session('erro_login_social') }} não autorizado</strong>
                            </div>
                        @endif

                        <h2 class="visually-hidden">Login com rede social</h2>
                        <div class="text-center d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('social.login', ['provider' => 'github']) }}" class="text-color-github"
                                title="Github">
                                <i class="fab fa-github fa-3x"></i>
                            </a>
                            <a href="{{ route('social.login', ['provider' => 'google']) }}" title="Google">
                                <img src="{{ asset('imagens/icons/google.svg') }}" width="40">
                            </a>
                            <a href="{{ route('social.login', ['provider' => 'linkedin']) }}" class="text-color-linkedin "
                                title="Linkedin">
                                <i class="fab fa-linkedin fa-3x"></i>
                            </a>
                        </div>

                        <div class="fw-lighter text-center text-muted mb-4">ou preencha abaixo</div>


                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-form-label visually-hidden">{{ __('Email Address') }}</label>


                                <input id="email" type="email" placeholder="E-mail"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-form-label visually-hidden">{{ __('Password') }}</label>


                                <input id="password" type="password" placeholder="Senha"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-3">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                            </div>

                            <div class="row mb-0">
                                <div class=" ">
                                    <button type="submit" class="btn btn-warning  w-100">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-dark w-100" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
