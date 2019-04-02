<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="template-3 template-all">
    <head>
        @include('layouts.front.common.header')
        <link href="{{ URL('/resources/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <style>
        .dropdown-toggle::after{
            display:none;
        }
        </style>
    </head>
    <body class=" cms-index-index cms-abani-home04">
        <div class="wrapper">
            <noscript>
                <div class="global-site-notice noscript">
                    <div class="notice-inner">
                        <p> <strong>JavaScript seems to be disabled in your browser.</strong><br /> You must have JavaScript enabled in your browser to utilize the functionality of this website.</p>
                    </div>
                </div>
            </noscript>
            <div class="page">
                @include('layouts.front.common.navbar')
                <div class="main-container col1-layout content-color color">
                    <div class="container">
                        <div class="main">
                            <div class="row">
                                <div class="col-6 offset-3" style="padding-top:100px;padding-bottom:200px;">
                                    <form method="POST" class="login form-in-checkout" action="{{ route('register') }}">
                                        @csrf
                                        <div class="checkout-info-text">
                                            <h3>Register</h3>
                                        </div>
                                        <p class="form-row">
                                            <label for="firstName">First Name <span class="required">*</span></label>
                                            <input type="text" class="input-text" name="firstName" id="firstName" value="{{ old('firstName') }}" required autofocus>
                                            @if ($errors->has('firstName'))
                                                <span style="color:#E40000">{{ $errors->first('firstName') }}</span>
                                            @endif
                                        </p>
                                        <p class="form-row">
                                            <label for="lastName">Last Name <span class="required">*</span></label>
                                            <input type="text" class="input-text" name="lastName" id="lastName" value="{{ old('lastName') }}" required autofocus>
                                            @if ($errors->has('lastName'))
                                                <span style="color:#E40000">{{ $errors->first('lastName') }}</span>
                                            @endif
                                        </p>
                                        <p class="form-row">
                                            <label for="email">Email address <span class="required">*</span></label>
                                            <input data-parsley-type="email" type="email" class="input-text" name="email" value="{{ old('email') }}" id="email" required autofocus>
                                            @if ($errors->has('email'))
                                                <span style="color:#E40000">{{ $errors->first('email') }}</span>
                                            @endif
                                        </p>
                                        <p class="form-row">
                                            <label for="mobileNo">Mobile Number <span class="required">*</span></label>
                                            <input data-parsley-type="number" id="mobileNo" type="text" class="input-text" name="mobileNo" value="{{ old('mobileNo') }}" value="{{ old('mobileNo') }}" required autofocus>
                                            @if ($errors->has('mobileNo'))
                                                <span style="color:#E40000">{{ $errors->first('mobileNo') }}</span>
                                            @endif
                                        </p>
                                        <p class="form-row">
                                            <label for="password">Password <span class="required">*</span></label>
                                            <input class="input-text" type="password" name="password" id="password" required autofocus>
                                            @if ($errors->has('password'))
                                                <span style="color:#E40000">{{ $errors->first('password') }}</span>
                                            @endif
                                        </p>
                                        <p class="form-row">
                                            <label for="password-confirm">Confirm Password <span class="required">*</span></label>
                                            <input id="password-confirm" type="password" class="input-text" name="password_confirmation" required>
                                        </p>
                                        {{-- <div class="checkout-col-footer"> --}}
                                            <input type="submit" class="button btn-step" name="register" value="Register">
                                        {{-- </div> --}}
                                        {{-- <div class="clear"></div> --}}
                                    </form><!--- form.login--->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.front.common.footer')
            </div>
        </div>
        @include('layouts.front.common.script')
        <script>
            $(document).ready(function () {
                $('form').parsley();
            });
        </script>
    </body>
</html>
