@extends('layouts.site')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h2>Login</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-4 offset-md-2">
            <h5>Already have an account?</h5>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                    
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    
                
            </form>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class=" text-center">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <h5>New Customer? Create account...</h5>
                <p><a href="{{ route('register') }}" class="btn btn-primary">Make a new register</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
