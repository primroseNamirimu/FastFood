
@extends('layouts.app2')

@section('content')
<link href="{{ url('css/form.css') }}" rel="stylesheet">

<div class="main">
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{ url('plugins/images/signin-image.jpg') }}" alt="food image"></figure>

                </div>

                <div class="signin-form">
                    <h2 class="form-title">Log in</h2>

                    <form method="POST" action="{{ route('login') }}">

                        @if ($message = Session::get('info'))
                        <div class="alert alert-success alert-dismissible fade show" style="width: 100%">
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                                    class="mdi mdi-close"></span>
                            </button>
                            <strong>Hello! </strong> {{$message}}
                        </div>
                        @endif

                        @if($message = Session::get('danger'))
                        <div class="alert alert-danger fade show" style="width: 100%">
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                                    class="mdi mdi-close"></span>
                            </button>
                            <strong>Error!</strong> {{$message}}
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


                                <input id="show-pass" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Your Password" required autocomplete="current-password">
   <!--                         <span style="float: right"><label>
<input type="checkbox" onclick="showPassword()">
</label>Show Password </span>-->
                           <span style="float: right;"> <a  style="color: black" href="javascript:showPassword()" >Show Password</a></span>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                            @endif
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                                <button type="submit"  style="width: 100%" class="btn btn-success">
                                    {{ __('Login') }}
                                </button>

                             <h5 style="margin-top: 10px">No Account? <a href="{{ route('register') }}" >Create an account</a>
                             </h5>



                    </form>
                </div>
            </div>
        </div>
    </section>
    </div>


<script>

    function showPassword() {
        let x = document.getElementById("show-pass");
        console.log(x)
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection
