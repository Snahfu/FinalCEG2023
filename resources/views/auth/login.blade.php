@extends('layouts.app')

@section('css')
<style>
    body{
        background: url('{{ asset('assets') }}/background/background.png');
        background-repeat:no-repeat;
        background-position: center center;
        
    }
    .card{
        background-color:rgba(255,255,255,0.8);
        border: 0px;
    }

    .btn-primary {
        color: #fff;
        background-color: #25683f;
        border-color: #25683f;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #63b6b0;
        border-color: #63b6b0;
    }

    .btn-primary:focus,
    .btn-primary.focus {
        color: #fff;
        background-color: #63b6b0;
        border-color: #63b6b0;
        box-shadow: 0 0 0 0.2rem rgba(37, 104, 63, 1);
    }


    .btn-primary:not(:disabled):not(.disabled):active,
    .btn-primary:not(:disabled):not(.disabled).active,
    .show > .btn-primary.dropdown-toggle {
        color: #fff;
        background-color: #63b6b0;
        border-color: #63b6b0;
    }

    a{
        text-decoration: none;
        color: #515940;
    }
    .navbar{
        display: none;
    }
    footer{
        display: none;
    }
</style>

@endsection

@section('content')
<h1>HALO AKU MAU COBA</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="content-wrapper" style="top:25%;position: relative;">
                <div class="content-header row">
                    <div class="content-body py-4 my-4">
                        <div class="auth-wrapper auth-basic px-2">
                            <div class="auth-inner my-2">
                                <div class="d-flex justify-content-center">
                                    <div class="card" style="width: 400px;">
        
                                        <div class="card-body" style=" ">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <h3 style="margin: 10px 0px 20px;text-align: center;">Login</h3>
                                                <h4 style="text-align: left;">Welcome to CEG 2023! 👋 </h4>
                                                <p>Please sign-in to your account</p>
        
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Username</label>
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
        
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
        
                                                </div>
        
                                                <div class="mb-2">
                                                
                                                    <div class="d-flex justify-content-between">
                                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                                        @if (Route::has('password.request'))
                                                            <a href="{{ route('password.request') }}"  style="font-size:12px;">
                                                                {{ __('Forgot Password?') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                                        required autocomplete="current-password">

        
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror 
                                                </div>
        
                                                <div class="mb-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" style="" {{ old('remember') ? 'checked' : '' }}>
        
                                                        <label class="form-check-label" for="remember">
                                                            {{ __('Remember Me') }}
                                                        </label>
                                                    </div>
                                                    
                                                </div>
        
                                                <div class="d-flex justify-content-center mb-3">
                                                    <button type="submit" class="btn btn-primary w-100">
                                                        <h5 class="my-1">{{ __('Log In') }}</h5>
                                                    </button>
                                                </div>
        
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">Username</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
