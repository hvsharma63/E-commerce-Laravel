@extends('layouts.front.app')
{{-- <link href="{{ URL('/resources/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> --}}
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
@section('title','Checkout Step 2')
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
                            <div class="step-process-item active"><i data-href="checkout-step2.html" id="billingAddress" class="redirectjs step-icon icon-pointer"></i><span class="text">Address</span></div>
                        </li>
                        <li>
                            <div class="step-process-item"><i class="step-icon-truck step-icon" id="shippingAddress"></i><span class="text">Shipping</span></div>
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
                <form id="checkoutForm" name="checkout" method="post" class="checkout woocommerce-checkout form-in-checkout" action="{{url('/checkout/step3')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="checkout-info-text">
                        <h3>Billing Address</h3>
                        <p>Choose the appropriate address</p>
                    </div>
                    <ul class="row">
                        @php
                            $i = 1;
                        @endphp
                        @if (isset($billingAddresses) && count($billingAddresses)>0)
                            @foreach ($billingAddresses as $billingAddress)
                                <li class="col-md-4">
                                    <div class="content-radio" id="div{{ $i }}">
                                        <input type="radio" name="payment_radio" value="{{$billingAddress->id}}" class="payment-radio" id="pr{{ $i }}" checked >
                                        <ul class="step-list-info" >
                                            <li id="addr">
                                                <div class="title-step">
                                                    Billing Address {{ $i }}
                                                    <a class="change" id="change" bid="{{ $i }}">
                                                        CHANGE
                                                    </a>
                                                </div>
                                                <h5 id="firstName" style="display:inline"><strong>{{ $billingAddress->firstName }}</strong></h5>
                                                <h5 id="lastName" style="display:inline"><strong>{{ $billingAddress->lastName }}</strong></h5><br>
                                                <p id="email" style="display:inline">{{ $billingAddress->email }}</p><br>
                                                <p id="address" style="display:inline">{{ $billingAddress->address }}</p><br>
                                                <p id="city" style="display:inline">{{ $billingAddress->city }} </p><br><p id="userstate" style="display:inline">{{ $billingAddress->state }}, </p>
                                                <p id="zipp" style="display:inline">{{ $billingAddress->zip }}</p><br>
                                                <p id="mobile" style="display:inline">{{ $billingAddress->mobile }}, </p><p id="fax" style="display:inline">{{ $billingAddress->fax }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        @else
                        <li class="col-md-4"><h3> No Addresses found. Kindly Add the addresses from the below</h3></li>
                        @endif
                    </ul>
                    <ul class="row">
                        <li class="col-md-12">
                            <div class="content-radio">
                                <input type="radio" name="payment_radio" value="new" id="addnew" >
                                <ul>
                                    <p class="title-step">Add New Address</p>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="row" id="newform">
                        <div class="col-md-12">
                            <div class="woocommerce-billing-fields">
                                <ul class="row">
                                    <li class="col-md-4">
                                        <p class="form-row validate-required" id="billing_first_name_field">
                                            <label for="billing_first_name" class="">First Name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="form-control input-text " value="" name="firstName" id="billing_first_name" >
                                        </p>
                                    </li>
                                    <li class="col-md-4">
                                        <p class="form-row validate-required" id="billing_last_name_field">
                                            <label for="billing_last_name" class="">Last Name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " value="" name="lastName" id="billing_last_name" >
                                        </p>
                                    </li>
                                    <li class="col-md-4">
                                        <p class="form-row validate-required validate-email" id="billing_email_field">
                                            <label for="billing_email" class="">Email ID <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " value="" name="email" id="billing_email" >
                                        </p>
                                    </li>
                                </ul>
                                <ul class="row">
                                    <li class="col-md-12">
                                        <p class="form-row validate-required validate-address" id="billing_address_field">
                                            <label for="billing_address" class="">Address <abbr class="required" title="required">*</abbr></label>
                                            <textarea name="address" id="billing_address" class="form-control" rows="3" ></textarea>
                                        </p>
                                    </li>
                                </ul>
                                <ul class="row">
                                    <li class="col-md-4">
                                        <p class="form-row address-field validate-postcode woocommerce-validated" id="billing_postcode_field">
                                            <label for="billing_postcode" class="">Zip code <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="zip" id="billing_postcode" value="" >
                                        </p>
                                    </li>
                                    <li class="col-md-4">
                                        <p class="form-row form-row-wide address-field validate-required" id="billing_city_field">
                                            <label for="billing_city" class="">City <abbr class="required" title="required">*</abbr></label>
                                            <select class="form-control" style="display:show" name="city" id="billing_city" >
                                                <option value="">--SELECT--</option>
                                            </select>
                                        </p>
                                    </li>
                                    <li class="col-md-4">
                                        <p class="form-row address-field validate-state woocommerce-validated" id="billing_state_field">
                                            <label for="billing_state_field" class="">State <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text" placeholder="" name="state" id="billing_state" value="" >
                                        </p>
                                    </li>
                                </ul>
                                <ul class="row">
                                    <li class="col-md-4">
                                        <p class="form-row validate-required validate-phone woocommerce-validated" id="billing_phone_field">
                                            <label for="billing_phone" class="">Phone number <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="input-text " name="mobile" id="billing_phone" placeholder="" value="" >
                                        </p>
                                    </li>
                                    <input type="hidden" id="type" name="type" value="">
                                    <li class="col-md-4">
                                        <p class="form-row validate-required validate-fax woocommerce-validated" id="billing_fax_field">
                                            <label for="billing_fax" class="">Fax</label>
                                            <input type="text" class="input-text " name="fax" id="billing_fax" placeholder="" value="" >
                                        </p>
                                    </li>

                                </ul>
                            </div><!--- .woocommerce-billing-fields--->
                        </div>
                    </div>
                    <hr style="border-top: 6px solid #eee">
                    <div class="row">
                        <ul class="row">
                            <li class="col-md-3">
                                <div class="content-radio">
                                    <input type="radio" name="shipping_method" id="rs3" value="same" checked>
                                    <p class="title-step">Ship to selected address</p>
                                </div>
                            </li>
                            <li class="col-md-3">
                                <div class="content-radio">
                                    <input type="radio" name="shipping_method" id="rs4" value="different">
                                    <p class="title-step">Ship to different address</p>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <div class="row">
                        <input type="submit" value="Continue" class="btn-step btn-highligh">
                    </div>
                </form><!--- form.checkout--->

                <div class="row">&nbsp</div>

            </div><!--- .container--->
        </div><!--- .woocommerce--->

    </div><!--- .main-container -->
@endsection

@section('script')

    <script>

        $(document).ready(function () {

            $('form#checkoutForm').parsley();
            $("#rs3").click(function () {
                $("i#shippingAddress").removeClass("step-icon-truck");
                $("i#delivery").removeClass("icon-wallet");
                $("i#shippingAddress").addClass("fa fa-check");
                $("i#delivery").addClass("fa fa-check");

            });

            $("#rs4").click(function () {
                $("i#shippingAddress").removeClass("fa fa-check");
                $("i#shippingAddress").addClass("step-icon-truck");
                $("i#delivery").removeClass("fa fa-check");
                $("i#delivery").addClass("icon-wallet");


            });

            $(".change").click(function (e) {
                $("#type").val('edit');
                e.preventDefault();
                $('#newform').trigger('reset');
                $("textarea").val('');
                $("#billing_city>option").remove();
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
                                $('#billing_city').append($("<option></option>").attr("value",value).attr("selected",true).text(value));
                            }else{
                                $('#billing_city').append(new Option(value, value));
                            }
                        }
                    }
                );
                statee = $.trim($(this).parent().siblings('#userstate').text().replace(',',''));
                mobile = $.trim($(this).parent().siblings('#mobile').text().replace(',',""));
                fax = $(this).parent().siblings('#fax').text();
                $("#pr"+id).prop('checked',true);
                $("#billing_first_name").val(firstName);
                $("#billing_last_name").val(lastName);
                $("#billing_email").val(email);
                $("#billing_address").val(address);
                $("#billing_postcode").val(zipp);
                $("#billing_state").val(statee);
                $("#billing_phone").val(mobile);
                $("#billing_fax").val(fax);
                $('#newform').show();
            });
            @if(count($billingAddresses)>0)
                $("#newform").css('display', 'none');
            @else
                $("#addnew").attr("checked","checked");
                $('#newform').show();
                $("#type").val('new');
                $('#newform').trigger('reset');
                $("textarea").val('');
                $("#billing_city>option").remove();
                $("input[type=text]").text('');
                $("input[type=text]").val('');
            @endif

            $("#addnew").click(function (e) {
                $("#type").val('new');
                $('#newform').show();
                $('#newform').trigger('reset');
                $("textarea").val('');
                $("#billing_city>option").remove();
                $("input[type=text]").text('');
                $("input[type=text]").val('');
            });
            $(".payment-radio").click(function (e) {
                $('#newform').hide();
            });
        });
        $("#billing_city").click(function (e) {
            e.preventDefault();
        });
        $('#billing_postcode').blur(function(){
            var zip = $(this).val();
            var city = [];
            $("#billing_city>option").remove();
            $.getJSON("http://api.geonames.org/postalCodeLookupJSON?formatted=true&postalcode="+zip+"&country=IN&username=breach",
                function (data, textStatus, jqXHR) {
                    for(i=0;i<data['postalcodes'].length;i++){
                        value = data['postalcodes'][i]['placeName']+", "+data['postalcodes'][i]['adminName2'];
                        $('#billing_city').append(new Option(value, value));
                    }
                    state = data['postalcodes'][0]['adminName1'];
                    $('#billing_state').val(state);
                }
            );
        });
    </script>
@endsection
