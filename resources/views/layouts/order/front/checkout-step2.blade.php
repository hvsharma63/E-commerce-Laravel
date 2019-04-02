@extends('layouts.front.app')
@section('title','Checkout Step 3')

{{-- <link href="{{ URL('/resources/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> --}}
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}

@section('content')
    <div class="main-container col1-layout content-color color">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"> <a href="/kart/abani" title="Go to Home Page">Home</a></li>
                    <li> <strong>Checkout</strong></li>
                </ul>
            </div>
        </div><!--- .breadcrumbs-->

        <div class="woocommerce">
            <div class="container">
                <div class="content-top">
                    <h2>Checkout</h2>
                </div><!--- .content-top-->
                <div class="checkout-step-process">
                    <ul>
                        <li>
						    <div class="step-process-item"><i data-href="checkout-step1.html" id="logged" class="redirectjs fa fa-check step-icon"></i><span class="text">Logged In</span></div>
						</li>
                        <li>
                            <div class="step-process-item"><i data-href="checkout-step2.html" id="billingAddress" class="redirectjs fa fa-check step-icon"></i><span class="text">Address</span></div>
                        </li>
                        <li>
                            <div class="step-process-item active"><i class="step-icon-truck step-icon" id="shippingAddress"></i><span class="text">Shipping</span></div>
                        </li>
                        <li>
                            <div class="step-process-item"><i data-href="checkout-step4.html" class="redirectjs step-icon icon-wallet" id="delivery"></i><span class="text">Delivery & Payment</span></div>
                        </li>
                        <li>
                            <div class="step-process-item"><i data-href="checkout-step5.html"  class="redirectjs step-icon icon-notebook" id="order"></i><span class="text">Order Review</span></div>
                        </li>
                    </ul>
                </div><!--- .checkout-step-process --->
                <div class="row">
                    @if($errors->any())
                        <div class="row col-lg-12">
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                        <span>{{ $error }}</span><br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                {{-- <form id="checkoutForm" name="checkout" method="post" class="checkout woocommerce-checkout form-in-checkout" action="{{url('/order/ShippingAddress')}}" enctype="multipart/form-data"> --}}
                    {{-- @csrf --}}

                    <div class="checkout-info-text">
                        <h3>Shipping Address</h3>
                        <p>Choose the appropriate address</p>
                    </div>
                    <ul class="row">
                        <li class="col-md-9">
                            <form id="checkoutForm" name="checkout" method="post" class="checkout woocommerce-checkout form-in-checkout" action="{{url('/checkout/step5')}}" enctype="multipart/form-data">
                                @csrf
                                <ul class="row">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($shippingAddresses as $shippingAddress)
                                        <li class="col-md-6">
                                            <div class="content-radio" id="div{{ $i }}">
                                                <input type="radio" name="shipping_id" value="{{$shippingAddress->id}}" class="payment-radio" id="pr{{ $i }}" checked>
                                                <ul class="step-list-info" >
                                                    <li id="addr">
                                                        <div class="title-step">
                                                            Shipping Address {{ $i }}
                                                            <a class="change" id="change" bid="{{ $i }}">
                                                                CHANGE
                                                            </a>
                                                        </div>
                                                        <h5 id="firstName" style="display:inline"><strong>{{ $shippingAddress->firstName }}</strong></h5>
                                                        <h5 id="lastName" style="display:inline"><strong>{{ $shippingAddress->lastName }}</strong></h5><br>
                                                        <p id="email" style="display:inline">{{ $shippingAddress->email }}</p><br>
                                                        <p id="address" style="display:inline">{{ $shippingAddress->address }}</p><br>
                                                        <p id="city" style="display:inline">{{ $shippingAddress->city }} </p><br><p id="userstate" style="display:inline">{{ $shippingAddress->state }}, </p>
                                                        <p id="zipp" style="display:inline">{{ $shippingAddress->zip }}</p><br>
                                                        <p id="mobile" style="display:inline">{{ $shippingAddress->mobile }}, </p><p id="fax" style="display:inline">{{ $shippingAddress->fax }}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </ul>
                                <ul class="row">
                                    <li class="col-md-12">
                                        <div class="content-radio">
                                            <input type="radio" name="shipping_id" value="new" id="addnew">
                                            <ul>
                                                <p class="title-step">Add New Shipping Address</p>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                                <div class="row" id="newform">
                                    <div class="col-md-12">
                                        <div class="woocommerce-billing-fields">
                                            <ul class="row">
                                                <li class="col-md-4">
                                                    <p class="form-row validate-required" id="shipping_first_name_field">
                                                        <label for="shipping_first_name" class="">First Name <abbr class="required" title="required">*</abbr></label>
                                                        <input type="text" class="form-control input-text " value="" name="firstName" id="shipping_first_name">
                                                    </p>
                                                </li>
                                                <li class="col-md-4">
                                                    <p class="form-row validate-required" id="shipping_last_name_field">
                                                        <label for="shipping_last_name" class="">Last Name <abbr class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text " value="" name="lastName" id="shipping_last_name">
                                                    </p>
                                                </li>
                                                <li class="col-md-4">
                                                    <p class="form-row validate-required validate-email" id="shipping_email_field">
                                                        <label for="shipping_email" class="">Email ID <abbr class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text " value="" name="email" id="shipping_email">
                                                    </p>
                                                </li>
                                            </ul>
                                            <ul class="row">
                                                <li class="col-md-12">
                                                    <p class="form-row validate-required validate-address" id="shipping_address_field">
                                                        <label for="shipping_address" class="">Address <abbr class="required" title="required">*</abbr></label>
                                                        <textarea name="address" id="shipping_address" class="form-control" rows="3" ></textarea>
                                                    </p>
                                                </li>
                                            </ul>
                                            <ul class="row">
                                                <li class="col-md-4">
                                                    <p class="form-row address-field validate-postcode woocommerce-validated" id="shipping_postcode_field">
                                                        <label for="shipping_postcode" class="">Zip code <abbr class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text " name="zip" id="shipping_postcode" value="">
                                                    </p>
                                                </li>
                                                <li class="col-md-4">
                                                    <p class="form-row form-row-wide address-field validate-required" id="shipping_city_field">
                                                        <label for="shipping_city" class="">City <abbr class="required" title="required">*</abbr></label>
                                                        <select class="form-control" style="display:show" name="city" id="shipping_city">
                                                            <option value="">--SELECT--</option>
                                                        </select>
                                                    </p>
                                                </li>
                                                <li class="col-md-4">
                                                    <p class="form-row address-field validate-state woocommerce-validated" id="shipping_state_field">
                                                        <label for="shipping_state_field" class="">State <abbr class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text" placeholder="" name="state" id="shipping_state" value="">
                                                    </p>
                                                </li>
                                            </ul>
                                            <ul class="row">
                                                <li class="col-md-4">
                                                    <p class="form-row validate-required validate-phone woocommerce-validated" id="shipping_phone_field">
                                                        <label for="shipping_phone" class="">Phone number <abbr class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text " name="mobile" id="shipping_phone" placeholder="" value="">
                                                    </p>
                                                </li>
                                                <input type="hidden" id="type" name="type" value="">
                                                <li class="col-md-4">
                                                    <p class="form-row validate-required validate-fax woocommerce-validated" id="shipping_fax_field">
                                                        <label for="shipping_fax" class="">Fax</label>
                                                        <input type="text" class="input-text " name="fax" id="shipping_fax" placeholder="" value="">
                                                    </p>
                                                </li>

                                            </ul>
                                        </div><!--- .woocommerce-billing-fields--->
                                    </div>
                                </div>
                                <hr style="border-top: 4px solid #eee">
                                <div class="row">
                                    <input type="submit" value="Continue" class="btn-step btn-highligh">
                                </div>
                            </li>
                            <li class="col-md-3">
                                @if(isset($billingAddress))
                                    <ul class="step-list-info" >
                                        <li id="addr">
                                            <div class="title-step">
                                                Billing Address
                                                <input type="hidden" name="billingId" value="{{ $billingAddress->id }}">
                                                {{-- <a class="change" id="change" bid="{{ $billingAddress->id }}">
                                                    CHANGE
                                                </a> --}}
                                            </div>
                                            <h5 style="display:inline"><strong>{{ $billingAddress->firstName }}</strong></h5>
                                            <h5 style="display:inline"><strong>{{ $billingAddress->lastName }}</strong></h5><br>
                                            <p style="display:inline">{{ $billingAddress->email }}</p><br>
                                            <p style="display:inline">{{ $billingAddress->address }}</p><br>
                                            <p style="display:inline">{{ $billingAddress->city }} </p><br><p style="display:inline">{{ $billingAddress->state }}, </p>
                                            <p style="display:inline">{{ $billingAddress->zip }}</p><br>
                                            <p style="display:inline">{{ $billingAddress->mobile }}, </p><p style="display:inline">{{ $billingAddress->fax }}</p>
                                        </li>
                                    </ul>
                                @endif
                            </li>
                        </form><!--- form.checkout--->
                    </ul>
                {{-- </form><!--- form.checkout---> --}}

                <div class="row">&nbsp</div>

            </div><!--- .container--->
        </div><!--- .woocommerce--->

    </div><!--- .main-container -->
@endsection

@section('script')

    <script>

        $(document).ready(function () {

            $('form#checkoutForm').parsley();

            $(".change").click(function (e) {
                $("#type").val('edit');
                e.preventDefault();
                $('#newform').trigger('reset');
                $("textarea").val('');
                $("#shipping_city>option").remove();
                id = $(this).attr('bid');
                firstName = $(this).parent().siblings('#firstName').text();
                lastName = $(this).parent().siblings('#lastName').text();
                email = $(this).parent().siblings('#email').text();
                address = $(this).parent().siblings('#address').text();
                cityy = $.trim($(this).parent().siblings('#city').text());

                zipp = $(this).parent().siblings('#zipp').text();
                $.getJSON("http://api.geonames.org/postalCodeLookupJSON?formatted=true&postalcode="+zipp+"&country=IN&username=breach",
                function (data, textStatus, jqXHR) {
                        for(i=0;i<data['postalcodes'].length;i++){
                            value = data['postalcodes'][i]['placeName']+", "+data['postalcodes'][i]['adminName2'];
                            if(value == cityy){
                                $('#shipping_city').append($("<option></option>").attr("value",value).attr("selected",true).text(value));
                            }else{
                                $('#shipping_city').append(new Option(value, value));
                            }
                        }
                    }
                );
                statee = $.trim($(this).parent().siblings('#userstate').text().replace(',',''));
                mobile = $.trim($(this).parent().siblings('#mobile').text().replace(',',""));
                fax = $(this).parent().siblings('#fax').text();
                $("#pr"+id).prop('checked',true);
                $("#shipping_first_name").val(firstName);
                $("#shipping_last_name").val(lastName);
                $("#shipping_email").val(email);
                $("#shipping_address").val(address);
                $("#shipping_postcode").val(zipp);
                $("#shipping_state").val(statee);
                $("#shipping_phone").val(mobile);
                $("#shipping_fax").val(fax);
                $('#newform').show();
            });
            $("#newform").css('display', 'none');
            $("#addnew").click(function (e) {
                $("#type").val('new');
                $('#newform').show();
                $('#newform').trigger('reset');
                $("textarea").val('');
                $("#shipping_city>option").remove();
                $("input[type=text]").text('');
                $("input[type=text]").val('');
            });
            $(".payment-radio").click(function (e) {
                $('#newform').hide();
            });
        });
        $("#shipping_city").click(function (e) {
            e.preventDefault();
        });
        $('#shipping_postcode').blur(function(){
            var zip = $(this).val();
            var city = [];
            $("#shipping_city>option").remove();
            $.getJSON("http://api.geonames.org/postalCodeLookupJSON?formatted=true&postalcode="+zip+"&country=IN&username=breach",
                function (data, textStatus, jqXHR) {
                    for(i=0;i<data['postalcodes'].length;i++){
                        value = data['postalcodes'][i]['placeName']+", "+data['postalcodes'][i]['adminName2'];
                        $('#shipping_city').append(new Option(value, value));
                    }
                    state = data['postalcodes'][0]['adminName1'];
                    $('#shipping_state').val(state);
                }
            );
        });
    </script>
@endsection
