@extends('layouts.front.app')
@section('title','Home')
@section('content')
    @include('layouts.front.common.slider')
        <div class="container">
            <div class="main">
                <div class="row">
                    <div class="col-main col-lg-12">
                        <div class="block block-subscribe popup" style="display:none;">
                            <div id="popup-newsletter"  src="assets/images/popup-newletter.jpg" width="810" height="500">
                                <form action="#" method="post" id="popup-newsletter-validate-detail">
                                    <div class="block-content">
                                        <img src="resources/front-assets/images/template3/logo-newletter.png" alt=""/>
                                        <div class="form-subscribe-header block-title"> <label for="newsletter">Subscribe</label></div>
                                        <p>For all the latest news, products, collection...</p>
                                        <p>Subscribe now to get 20% off</p>
                                        <div class="newsletter-new clearfix">
                                            <div class="input-box"> <input type="text" name="email" id="pnewsletter" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Your email adress ..."/></div>
                                            <div class="actions">
                                                <button type="submit" title="Subscribe" class="button">
                                                    <span><i class="fa fa-play"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="subscribe-bottom"> <input type="checkbox" />Don’t show this popup again</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="std">
                            <div class="alo_column column_container">
                                <div class="alo_text_column alo_content_element">
                                    <h2>Started from small & went BIG</h2>
                                    <p>
                                        The company was founded in a one-car garage in Palo Alto by Bill Hewlett and David Packard, and initially produced a line of electronic test equipment. HP was the world's leading PC manufacturer from 2007 to Q2 2013, at which time Lenovo ranked ahead of HP.[1][2][3] HP specialized in developing and manufacturing computing, data storage, and networking hardware, designing software and delivering services. Major product lines included personal computing devices, enterprise and industry standard servers, related storage devices, networking products, software and a diverse range of printers and other imaging products. HP directly marketed its products to households, small- to medium-sized businesses and enterprises as well as via online distribution, consumer-electronics and office-supply retailers, software partners and major technology vendors. HP also had services and consulting business around its products and partner products.
                                    </p>
                                    <p>My job as a leader is to make sure everybody in the company has great opportunities, and that they feel they're having a meaningful impact and are contributing to the good of society. As a world, we're doing a better job of that. My goal is for Google to lead, not follow that.</p>
                                    {{-- <div class="btn-reamore-left"><a class="btn btn-primary btn-lg" title="Alo Our Team" href="#">Read more</a></div> --}}
                                </div>
                                <div class="alo_img_column alo_content_element"><img class="img-responsive" alt="" src="{{ URL('/resources/front-assets/images/cover-5.jpg')}}" style="height:400px; width:380px" /></div>
                            </div>
                            <div class="block-banner block-banner-home block-banner_01 row">
                                <div class="container-content">
                                    <div class="banner-col-1 col-lg-4 col-md-4 col-sm-4 col-xs-12 clearfix">
                                        <div class="banner-col banner-col-1-1">
                                            <img class="img-responsive" alt="Sample banner" src="{{ URL('/resources/front-assets/images/cover-1.png')}}" />
                                            <div class="text-middle banner-center hover-style-1">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner-col banner-col-1-2">
                                            <img class="img-responsive" alt="Sample banner" style="width:370px; height:500px" src="{{ URL('/resources/front-assets/images/ad-2.jpg')}}" />
                                            <div class="text-middle banner-center hover-style-2">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner-col banner-col-1-3">
                                            <img class="img-responsive" alt="Sample banner" style="width:370px; height:400px" src="{{ URL('/resources/front-assets/images/ad-3.jpg')}}" />
                                            <div class="text-middle banner-center hover-style-3">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-col-2 col-lg-4 col-md-4 col-sm-4 col-xs-12 clearfix">
                                        <div class="banner-col banner-col-2-1">
                                            <img class="img-responsive" alt="Sample banner" style="width:370px; height:350px" src="{{ URL('/resources/front-assets/images/ad-4.jpg')}}" />
                                            <div class="text-middle banner-center hover-style-4">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner-col banner-col-2-2">
                                            <img class="img-responsive" alt="Sample banner"style="width:370px; height:430px" src="{{ URL('/resources/front-assets/images/ad-5.webp')}}" />
                                            <div class="text-middle banner-center hover-style-5">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner-col banner-col-2-3">
                                            <img class="img-responsive" alt="Sample banner" style="width:370px; height:270px" src="{{ URL('/resources/front-assets/images/ad-6.png')}}" />
                                            <div class="text-middle banner-center hover-style-6">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner-col banner-col-2-4">
                                            <img class="img-responsive" alt="Sample banner" "width:370px; height:270px" src="{{ URL('/resources/front-assets/images/ad-6.png')}}"/>
                                            <div class="text-middle banner-center hover-style-7">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="banner-col-3 col-lg-4 col-md-4 col-sm-4 col-xs-12 clearfix">
                                        <div class="banner-col banner-col-3-1">
                                            <img class="img-responsive" alt="Sample banner" style="width:370px; height:450px" src="{{ URL('/resources/front-assets/images/ad-2.jpg')}}" />
                                            <div class="text-middle banner-center hover-style-8">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner-col banner-col-3-2">
                                            <img class="img-responsive" alt="Sample banner" style="width:370px; height:270px" src="{{ URL('/resources/front-assets/images/ad-3.jpg')}}" />
                                            <div class="text-middle banner-center hover-style-9">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="banner-col banner-col-3-3">
                                            <img class="img-responsive" alt="Sample banner" style="width:370px; height:270px" src="{{ URL('/resources/front-assets/images/ad-4.jpg')}}" />
                                            <div class="text-middle banner-center hover-style-10">
                                                <div class="thumb">
                                                    <p class="text-middle1">Cairs earlist</p>
                                                    <p class="text-middle1">concept stretch</p>
                                                    <p class="icon-anchor icons"><span class="hidden">hidden</span></p>
                                                    <a class="button-custom button-custom-now btn-lg" href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="alo-brands">
            <div class="container">
                <div class="main">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <div id="footer-brand">
                                    <ul class="magicbrand">
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_01" title="brands_01" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_02" title="brands_02" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_03" title="brands_03" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_04" title="brands_04" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_05" title="brands_05" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_06" title="brands_06" /> </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
