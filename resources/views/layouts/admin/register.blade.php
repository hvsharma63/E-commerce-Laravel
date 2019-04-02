<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Adminox - Responsive Web App Kit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ URL('/resources/assets/images/favicon.ico') }}">

        <!-- App css -->
        {{-- /resources/assets/assets/css/bootstrap.min.css --}}
        <link href="{{ URL('/resources/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL('/resources/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL('/resources/assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL('/resources/assets/css/style.css')}}" rel="stylesheet" type="text/css" />

        <script src="{{ URL('/resources/assets/js/modernizr.min.js')}}"></script>

    </head>


    <body class="bg-accpunt-pages">

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-logo-box">

                                        <h5 class="text-uppercase font-bold m-b-5 m">{{ __('Register') }}</h5>
                                        <p class="m-b-0">Get access to our admin panel</p>
                                    </div>
                                    <div class="account-content">
                                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label for="firstName">{{ __('First Name') }}</label>
                                                    <input id="firstName" type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName"
                                                     required autofocus>

                                                    @if ($errors->has('firstName'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('firstName') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label for="lastName">{{ __('Last Name') }}</label>
                                                    <input id="lastName" type="text" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{ old('lastName') }}" required autofocus>

                                                    @if ($errors->has('lastName'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('lastName') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label for="emailaddress">{{ __('E-Mail Address') }}</label>
                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label for="mobileNo">{{ __('Mobile Number') }}</label>
                                                    <input id="mobileNo" type="text" class="form-control{{ $errors->has('mobileNo') ? ' is-invalid' : '' }}" name="mobileNo" value="{{ old('mobileNo') }}" required autofocus>

                                                    @if ($errors->has('mobileNo'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mobileNo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label for="password">Password</label>
                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                </div>
                                            </div>

                                            {{-- <div class="form-group row m-b-20">
                                                <div class="col-12">

                                                    <div class="checkbox checkbox-success">
                                                        <input id="remember" type="checkbox" checked="">
                                                        <label for="remember">
                                                            I accept <a href="#">Terms and Conditions</a>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div> --}}



                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">{{ __('Register') }}</button>
                                                </div>
                                            </div>

                                        </form>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div><br />
                                        @endif

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <button type="button" class="btn m-r-5 btn-facebook waves-effect waves-light">
                                                        <i class="fa fa-facebook"></i>
                                                    </button>
                                                    <button type="button" class="btn m-r-5 btn-googleplus waves-effect waves-light">
                                                        <i class="fa fa-google"></i>
                                                    </button>
                                                    <button type="button" class="btn m-r-5 btn-twitter waves-effect waves-light">
                                                        <i class="fa fa-twitter"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row m-t-50">
                                            <div class="col-12 text-center">
                                                <p class="text-muted">Already have an account?  <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign In</b></a></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>


                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ URL('/resources/assets/js/jquery.min.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/tether.min.js')}}"></script><!-- Tether for Bootstrap -->
        <script src="{{ URL('/resources/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/metisMenu.min.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/waves.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/jquery.slimscroll.js')}}"></script>

        <!-- App js -->
        <script src="{{ URL('/resources/assets/js/jquery.core.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/jquery.app.js')}}"></script>

    </body>
</html>
