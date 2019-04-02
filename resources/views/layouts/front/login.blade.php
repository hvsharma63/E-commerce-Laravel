<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="template-3 template-all">
    <head>
        @include('layouts.front.common.header')
        <link href="{{ URL('/resources/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <title>Login</title>

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
                                    <form method="POST" class="login form-in-checkout" action="{{ route('login') }}">
                                        @csrf
                                        <div class="checkout-info-text">
                                            <h3>Login</h3>
                                            <p>Already Registed? Please login below.</p>
                                        </div>
                                        <p class="form-row">
                                            <label for="username">Email address <span class="required">*</span></label>
                                            <input type="email" class="input-text" name="email" id="username">
                                        </p>
                                        <p class="form-row">
                                            <label for="password">Password <span class="required">*</span></label>
                                            <input class="input-text" type="password" name="password" id="password">
                                        </p>
                                        <p class="form-row">
                                            <a class="lost_password" href="{{ route('user.password.request') }}">Forgot your password?</a>
                                        </p>
                                        <div class="clear"></div>
                                        <div class="checkout-col-footer">
                                            <input type="submit" class="button btn-step" name="login" value="Login">
                                            <label for="rememberme" class="inline">
                                                <input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember me?
                                            </label>
                                        </div>
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
            @yield('script')
        </script>
    </body>
</html>
