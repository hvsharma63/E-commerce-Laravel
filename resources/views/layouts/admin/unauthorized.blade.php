<!DOCTYPE html>
<html>
    <head>
        @include('layouts.admin.common.header')
    </head>

    <body class="bg-accpunt-pages">

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">

                        <div class="wrapper-page">
                            <div class="account-pages">
                                <div class="account-box">

                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="index.html" class="text-success">
                                                <span><img src="assets/images/logo_dark.png" alt="" height="30"></span>
                                            </a>
                                        </h2>
                                    </div>

                                    <div class="account-content">
                                        <h1 class="text-error">401</h1>
                                        <h2 class="text-uppercase text-danger m-t-30">Unauthorized Request</h2>
                                        <p class="text-muted m-t-30">Sorry, You do not have Confidential Access & Clearance</p>
                                        <a class="btn btn-md btn-block btn-primary waves-effect waves-light m-t-20" href="{{ route('login') }}"> Return to Login</a>
                                    </div>
                                </div>
                            </div>

                        </div>

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
        <script src="assets/js/jquery.slimscroll.js"></script>

        <!-- App js -->
        <script src="{{ URL('/resources/assets/js/jquery.core.js')}}"></script>
        <script src="{{ URL('/resources/assets/js/jquery.app.js')}}"></script>

    </body>
</html>
