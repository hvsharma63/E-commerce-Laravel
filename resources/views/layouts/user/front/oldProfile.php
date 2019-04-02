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
    </div>
    <!--- .breadcrumbs-->
    <div class="content-top text-center no-border">
        <h2>Hello, {{ Auth::user()->firstName }}</h2>
    </div>
    <div class="container">
        <div class="col-md-3">
            <div class="block widget_categories" style="overflow: scroll;height: 400px;overflow-x: hidden;">
                <div class="block-title"><strong><span>Billing Addresses</span></strong></div>
                @if (isset($billings) && count($billings)>0)
                @php
                $i = 1;
                @endphp
                @foreach ($billings as $billing)
                <li>
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
            <!--- .widget_categories-->
        </div>
        <div class="col-md-6">
            <div class="info-portfolio-box">
                <h2>Personal Information</h2>
                <div class="row-content">
                    <div class="left pull-left"><i class="fa fa-user"></i>Name</div>
                    <div class="right pull-right">
                        <p>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p>
                    </div>
                </div>
                <div class="row-content">
                    <div class="left pull-left"><i class="fa fa-google"></i> Email Address:</div>
                    <div class="right pull-right">
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="row-content">
                    <div class="left pull-left"><i class="fa fa-phone"></i> Mobile No:</div>
                    <div class="right pull-right">
                        <p>{{ Auth::user()->mobileNo }}</p>
                    </div>
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
            </div>
            <!--- .info-portfolio-box-->
        </div>
        <div class="col-md-3">
            <div class="block widget_categories">
                <div class="block-title"><strong><span>Shipping Addresses</span></strong></div>
                <ul>
                    <li><a href="#">Fashion</a></li>
                    <li><a href="#">Collection</a></li>
                    <li><a href="#">Furniture</a></li>
                    <li><a href="#">Desgin Concept</a></li>
                    <li><a href="#">Typography</a></li>
                    <li><a href="#">Hot Trends</a></li>
                    <li><a href="#">Techlonogy</a></li>
                </ul>
            </div>
            <!--- .widget_categories-->
        </div>
    </div>
    <!--- .container-->

</div>
<!--- .main-container -->

@endsection

@section('script')
@endsection
