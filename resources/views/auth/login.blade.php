{{-- @extends('layouts.app2') --}}
@extends('layouts.app2')

@section('content')
<link href="{{ url('css/form.css') }}" rel="stylesheet">
<div class="main">
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    {{-- <figure><img src="public/images/signin-image.jpg" alt="food image"></figure> --}}
                    <figure><img src="{{ url('plugins/images/signin-image.jpg') }}" alt="food image"></figure>
                    <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Log in</h2>
     
                    <form method="POST" action="{{ route('login') }}">
                       @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}
                    </div>
                    @endif
			 @csrf
                      
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>

                           
                                <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your email" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div> 

                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>

                        
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Your Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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
        </div>
    </div>
</div>
@endsection
