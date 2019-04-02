<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Adminox - Responsive Web App Kit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ URL('/resources/assets/images/favicon.ico') }}">

        <!-- Toastr css -->
        <link href="{{ URL('/resources/assets/plugins/jquery-toastr/jquery.toast.min.css')}}" rel="stylesheet" />

        <!-- App css -->
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
                                    <div class="text-center account-logo-box">
                                        <h2 class="text-uppercase">
                                            <a href="index.html" class="text-success">
                                                <span><img src="{{URL('/resources/assets/images/logo_dark.png')}}" alt="" height="30"></span>
                                            </a>
                                        </h2>
                                        <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                    </div>
                                    <div class="account-content">

                                        <div class="text-center m-b-20">
                                            <p class="text-muted m-b-0">{{ __('Reset Password') }}</p>
                                        </div>
                                        <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="form-group row m-b-20">
                                                {{-- <div class="col-12"> --}}
                                                    <label for="emailaddress" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                                    <div class="col-md-6">
                                                        <p class="form-control">{{ $email }}</p>
                                                        {{-- <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $email }}" disabled> --}}
                                                        <input type="hidden" name="email" value="{{ $email }}" name="email">
                                                        <input type="hidden" name="token" value="{{ $token }}" name="token">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                </div>
                                            </div>

                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Reset Password') }}
                                                    </button>
                                                </div>
                                            </div>

                                            @if(!empty($errors->first()))
                                                <div class="row col-lg-12">
                                                    <div class="alert alert-danger">
                                                        <span>{{ $errors->first() }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </form>

                                        <div class="clearfix"></div>

                                        <div class="row m-t-40">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted">Back to <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign In</b></a></p>
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
        <!-- jQuery  -->
        <script src="{{ URL('/resources/assets/js/jquery.min.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/tether.min.js')}}"></script><!-- Tether for Bootstrap -->
        <script src="{{ URL('/resources/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/metisMenu.min.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/waves.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/jquery.slimscroll.js')}}"></script>

        <!-- Toastr js -->
        <script src="{{ URL('/resources/assets/plugins/jquery-toastr/jquery.toast.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL('/resources/assets/pages/jquery.toastr.js')}}" type="text/javascript"></script>


        <!-- App js -->
        <script src="{{ URL('/resources/assets/js/jquery.core.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/jquery.app.js')}}"></script>
    </body>
</html>
