<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="template-3 template-all">
    <head>
        @include('layouts.front.common.header')
        <link href="{{ URL('/resources/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <title>Thank you for purchasing..</title>
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
                <div class="main-container cms-no-route-2 col1-layout content-color color">
                    <div class="breadcrumbs">
                        <div class="container">
                            <ul>
                                <li class="home"> <a href="#" title="Go to Home Page">Home</a></li>
                                <li> <strong>404 Page</strong></li>
                            </ul>
                        </div>
                    </div><!--- .breadcrumbs-->

                    <div class="container">
                        <div class="page-not-found-2">
                            <div class="page-title">
                                <h1>Order has been placed!</h1>
                            </div>
                            <p>Thank you for choosing us.</p>
                        </div><!--- .page-not-found-2-->
                    </div><!--- .container-->

                    <div class="alo-brands">
                        <div class="container">
                            <div class="main">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="footer-brand">
                                            <ul class="magicbrand">
                                                <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_01" title="brands_01" /> </a></li>
                                                <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_02" title="brands_02" /> </a></li>
                                                <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_03" title="brands_03" /> </a></li>
                                                <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_04" title="brands_04" /> </a></li>
                                                <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_05" title="brands_05" /> </a></li>
                                                <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_06" title="brands_06" /> </a></li>
                                            </ul>
                                        </div><!-- #footer-brand -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- .container-->
                    </div><!-- .alo-brands -->
                </div><!--- .main-container -->
                @include('layouts.front.common.footer')
        @include('layouts.front.common.script')
        <script>
            $(document).ready(function () {
                setTimeout(function(){
                    window.location= 'abani'}
                , 500);
            });

        </script>
    </body>
</html>
