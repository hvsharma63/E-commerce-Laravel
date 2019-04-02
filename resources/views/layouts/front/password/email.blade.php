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
                                <div class="col-lg-6 offset-3" style="padding-top:200px;padding-bottom:200px;">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('message'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <form method="POST" class="password-reset form-in-checkout" action="{{ route('password.email') }}">
                                        @csrf
                                        <p class="form-row">
                                            <label for="email">Email address <span class="required">*</span></label>
                                            <input type="email" class="input-text" name="email" id="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </p>
                                        <div class="clear"></div>
                                        <div class="checkout-col-footer">
                                            <button type="submit" class="button btn-step">{{ __('Send Password Reset Link') }}</button>
                                        </div>
                                    </form><!--- form--->
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
            @yield('script')
        </script>
    </body>
</html>
