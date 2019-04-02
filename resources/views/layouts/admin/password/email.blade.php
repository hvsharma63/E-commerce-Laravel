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
                                        <div class="text-center m-b-20">
                                            <p class="text-muted m-b-0">Enter your email address and we'll send you an email with instructions to reset your password.  </p>
                                        </div>
                                        <form class="form-horizontal" action="{{ route('password.email') }}" method="POST">
                                            @csrf
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

                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" id="reset" type="submit">{{ __('Send Password Reset Link') }}</button>
                                                </div>
                                            </div>

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
