@extends('layouts.front.app')

@section('title','My Profile')
@section('content')
    <div class="main-container col1-layout content-color color">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"> <a href="/kart/abani" title="Go to Home Page">Home</a></li>
                    <li> <strong>Profile</strong></li>
                </ul>
            </div>
        </div><!--- .breadcrumbs-->
        <div class="container">
            <div class="col-md-4 col-right">
                <div class="block widget_categories">
                    <div class="block-title"><strong><span>Hello, {{ Auth::user()->firstName }}</span></strong></div>
                    <ul>
                        <li><a href="orders">My Orders</a></li>
                        <li><a href="profile">Profile Information</a></li>
                        {{-- <li><a>Manage Addresses</a>
                            <ul style="margin-left: 1.5em; margin-bottom:0;">
                                <li><a href="#" class="addr" title="Billing">Billing Addresses</a></li>
                                <li><a href="#" class="addr" title="Shipping">Shipping Addresses</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </div><!--- .widget_categories-->
            </div>
            <div class="col-sm-6">
                <div id="personal" class="info-portfolio-box">
                    <h2>Personal Information</h2>
                    <div class="row-content">
                        <div class="left pull-left"><i class="fa fa-user"></i>Name</div>
                        <div class="right pull-right"><p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p></div>
                    </div>
                    <div class="row-content">
                        <div class="left pull-left"><i class="fa fa-google"></i> Email Address:</div>
                        <div class="right pull-right"><p>{{ Auth::user()->email }}</p></div>
                    </div>
                    <div class="row-content">
                        <div class="left pull-left"><i class="fa fa-phone"></i> Mobile No:</div>
                        <div class="right pull-right"><p>{{ Auth::user()->mobileNo }}</p></div>
                    </div>
                    <div class="row-content">
                        <div class="left pull-left"><i class="fa fa-tag"></i> Tags:</div>
                        <div class="right pull-right">Creative, Brading, Web</div>
                    </div>
                    <div class="row-content last">
                        <div class="left pull-left"><i class="fa fa-link"></i> Live Demo</div>
                        <div class="right pull-right"><a href="#">www.domainname.com</a></div>
                    </div>
                    <div class="social-personal">
                        <span class="social-label">Share on:</span>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div><!--- .info-portfolio-box-->
                <div id="Billing" style="display:none">
                    @if (isset($billings) && count($billings)>0)
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($billings as $billing)
                            <li style="float:left">
                                <div class="content-radio" style="margin-top: -20px;
                                                    padding-left: 15px;" id="div{{ $i }}">
                                    <ul class="step-list-info">
                                        <li id="addr">
                                            <div class="title-step">
                                                Billing Address {{ $i }}
                                                <a class="change" id="change" bid="{{ $i }}">
                                                    CHANGE
                                                </a>
                                            </div>
                                            <h5 id="firstName" style="display:inline"><strong>{{ $billing->firstName }}</strong></h5>
                                            <h5 id="lastName" style="display:inline"><strong>{{ $billing->lastName }}</strong></h5><br>
                                            <p id="email" style="display:inline">{{ $billing->email }}</p><br>
                                            <p id="address" style="display:inline">{{ $billing->address }}</p><br>
                                            <p id="city" style="display:inline">{{ $billing->city }} </p><br>
                                            <p id="userstate" style="display:inline">{{ $billing->state }}, </p>
                                            <p id="zipp" style="display:inline">{{ $billing->zip }}</p><br>
                                            <p id="mobile" style="display:inline">{{ $billing->mobile }}, </p>
                                            <p id="fax" style="display:inline">{{ $billing->fax }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    @endif
                </div>
            </div>
        </div><!--- .container-->

    </div><!--- .main-container -->

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(".addr").click(function (e) {
                title = $(this).attr('title');
                alert(title);
                $("#"+title).toggle();
                $("#personal").toggle();

            });
        });

    </script>
@endsection
