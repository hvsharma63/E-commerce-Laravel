<!DOCTYPE html>
<html>
    <head>
        @include('layouts.admin.common.header')
        {{-- @yield('links') --}}
    </head>
    <body>
        <!-- Begin page -->
        <div id="wrapper">
            @include('layouts.admin.common.navbar')
            @include('layouts.admin.common.sidebar')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">

                <!-- Start content -->
                <div class="content">

                    @yield('content')

                </div>
                <!-- content -->
            @include('layouts.admin.common.footer')
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->
        @include('layouts.admin.common.script')
        @yield('script')
    </body>
</html>
