<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="template-3 template-all">
    <head>
        @include('layouts.front.common.header')
        <title>@yield('title')</title>
        <style>
            input[type="checkbox"]{
                margin: 0;
            }
        </style>
    </head>
    {{-- <body class="cms-index-index cms-abani-home04"> --}}
    <body>
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
                {{-- <div class="main-container col1-layout content-color color"> --}}
                    @yield('content')
                {{-- </div> --}}
                @include('layouts.front.common.footer')
            </div>
        </div>
        @include('layouts.front.common.script')
        @include('layouts.front.common.script2')
        @yield('script')
    </body>
</html>
