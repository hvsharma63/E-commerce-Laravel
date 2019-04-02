@extends('layouts.admin.app')
@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Dashboard</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">Adminox</li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-box-two widget-two-custom">
                    <i class="mdi mdi-currency-usd widget-two-icon"></i>
                    <div class="wigdet-two-content">
                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Orders</p>
                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ $orderCount }}</span></h2>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-box-two widget-two-custom">
                    <i class="mdi mdi-account-multiple widget-two-icon"></i>
                    <div class="wigdet-two-content">
                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Users</p>
                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ $userCount }}</span></h2>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-box-two widget-two-custom">
                    <i class="mdi mdi-crown widget-two-icon"></i>
                    <div class="wigdet-two-content">
                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Products</p>
                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ $productCount }}</span></h2>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-box-two widget-two-custom">
                    <i class="mdi mdi-crown widget-two-icon"></i>
                    <div class="wigdet-two-content">
                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Order Cost</p>
                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ $totalOrderAmount }}</span></h2>
                    </div>
                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            {{-- <div class="col-lg-6">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b>Recent Candidates</b></h4>
                    <p class="text-muted font-14 m-b-20">
                        Your awesome text goes here.
                    </p>

                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-actions-bar">

                            <thead>
                            <tr>
                                <th>
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-secondary btn-xs dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Dropdown link</a>
                                            <a class="dropdown-item" href="#">Dropdown link</a>
                                        </div>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Job Timing</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <img src="assets/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    <h5 class="m-b-0 m-t-0 font-600">Tomaslau</h5>
                                    <p class="m-b-0"><small>Web Designer</small></p>
                                </td>

                                <td>
                                    <i class="mdi mdi-map-marker text-primary"></i> New York
                                </td>

                                <td>
                                    <i class="mdi mdi-clock text-success"></i> Full Time
                                </td>

                                <td>
                                    <i class="mdi mdi-currency-usd text-warning"></i> 3265
                                </td>

                                <td>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <img src="assets/images/users/avatar-3.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    <h5 class="m-b-0 m-t-0 font-600">Erwin E. Brown</h5>
                                    <p class="m-b-0"><small>Programmer</small></p>
                                </td>

                                <td>
                                    <i class="mdi mdi-map-marker text-primary"></i> California
                                </td>

                                <td>
                                    <i class="mdi mdi-clock text-success"></i> Part Time
                                </td>

                                <td>
                                    <i class="mdi mdi-currency-usd text-warning"></i> 1365
                                </td>

                                <td>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/users/avatar-4.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    <h5 class="m-b-0 m-t-0 font-600">Margeret V. Ligon</h5>
                                    <p class="m-b-0"><small>Web Designer</small></p>
                                </td>

                                <td>
                                    <i class="mdi mdi-map-marker text-primary"></i> New York
                                </td>

                                <td>
                                    <i class="mdi mdi-clock text-success"></i> Full Time
                                </td>

                                <td>
                                    <i class="mdi mdi-currency-usd text-warning"></i> 115248
                                </td>

                                <td>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/users/avatar-5.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    <h5 class="m-b-0 m-t-0 font-600">Jose D. Delacruz</h5>
                                    <p class="m-b-0"><small>Web Developer</small></p>
                                </td>

                                <td>
                                    <i class="mdi mdi-map-marker text-primary"></i> New York
                                </td>

                                <td>
                                    <i class="mdi mdi-clock text-success"></i> Part Time
                                </td>

                                <td>
                                    <i class="mdi mdi-currency-usd text-warning"></i> 2451
                                </td>

                                <td>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <img src="assets/images/users/avatar-8.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                </td>

                                <td>
                                    <h5 class="m-b-0 m-t-0 font-600">Luke J. Sain</h5>
                                    <p class="m-b-0"><small>Web Designer</small></p>
                                </td>

                                <td>
                                    <i class="mdi mdi-map-marker text-primary"></i> Australia
                                </td>

                                <td>
                                    <i class="mdi mdi-clock text-success"></i> Part Time
                                </td>

                                <td>
                                    <i class="mdi mdi-currency-usd text-warning"></i> 3265
                                </td>

                                <td>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                                    <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- end col --> --}}




            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">Order Analysis</h4>

                    <div class="widget-chart text-center">

                        <div id="pie-chart" style="height: 300px;"></div>

                        <div class="row text-center m-t-30">
                            <div class="col-6">
                                <h3 data-plugin="counterup">{{ $CODAmount }}</h3>
                                <p class="text-muted m-b-5">Payment Done</p>
                            </div>
                            <div class="col-6">
                                <h3 data-plugin="counterup">{{ $PAmount }}</h3>
                                <p class="text-muted m-b-5">Payment Due</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!--- end row -->

    </div> <!-- container -->

@endsection
@section('script')
    <script>
    !function($) {
        "use strict";

        var ChartC3 = function() {};

        ChartC3.prototype.init = function () {

            //Pie Chart
            c3.generate({
            bindto: '#pie-chart',
            data: {
                columns: [
                    ['Pending', {{ $pendingOrders }}],
                    ['Cancelled', {{ $cancelledOrders }}],
                    ['Confirmed', {{ $confirmedOrders }}],
                    ['Dispatched', {{ $dispatchedOrders }}],
                    ['Delieverd', {{ $deliveredOrders }}],
                ],
                type : 'pie'
            },
            color: {
                pattern: ["#FCEC58",'#FF213E','#2CB5F9', "#C872F9", "#22F472"]
            },
            pie: {
                label: {
                    show: false
                }
            }
            });

        },
        $.ChartC3 = new ChartC3, $.ChartC3.Constructor = ChartC3

        }(window.jQuery),

        //initializing
        function($) {
            "use strict";
            $.ChartC3.init()
        }(window.jQuery);
    </script>
@endsection
