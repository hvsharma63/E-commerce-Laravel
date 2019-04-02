@extends('layouts.front.app')
@section('title','Final Step')

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
                            <div class="step-process-item"><i data-href="checkout-step1.html" class="redirectjs fa fa-check step-icon"></i><span class="text">Checkout method</span></div>
                        </li>
                        <li>
                            <div class="step-process-item"><i data-href="checkout-step2.html" class="redirectjs fa fa-check step-icon"></i><span class="text">Address</span></div>
                        </li>
                        <li>
                            <div class="step-process-item"><i class="fa fa-check step-icon"></i><span class="text">Shipping</span></div>
                        </li>
                        <li>
                            <div class="step-process-item"><i data-href="checkout-step3.html" class="redirectjs fa fa-check step-icon"></i><span class="text">Delivery & Payment</span></div>
                        </li>
                        <li>
                            <div class="step-process-item active"><i data-href="checkout-step4.html" class="redirectjs step-icon icon-notebook"></i><span class="text">Order Review</span></div>
                        </li>
                    </ul>
                </div><!--- .checkout-step-process-->
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
                <form id="orderPlace" name="orderPlace" method="post" class="checkout woocommerce-checkout form-in-checkout" action="{{url('/order/confirm')}}" enctype="multipart/form-data">
                    @csrf

                    <ul class="row">
                        <li class="col-md-9 col-padding-right">
                            <table class="table-order table-order-review">
                                <thead>
                                    <tr>
                                        <td width="68">Product Name</td><td width="14">price</td><td width="14">QTY</td><td width="14">Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($productsOfCart))
                                        @php
                                            $totalAmount = 0;
                                        @endphp
                                        @foreach ($productsOfCart as $productOfCart)
                                            <tr>
                                                <td class="name">{{ $productOfCart->productName }}</td>
                                                <td>{{ $productOfCart->productPrice }}</td>
                                                <td>{{ $productOfCart->qty }}</td>
                                                <td class="price">{{ $productOfCart->qty*$productOfCart->productPrice }}</td>
                                            </tr>
                                            @php
                                                $totalAmount = $totalAmount + ($productOfCart->qty*$productOfCart->productPrice);
                                            @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <table class="table-order table-order-review-bottom">
                                <tr>
                                    <td class="first large">Total Payment</td>
                                    <td class="price large">${{ $totalAmount }}</td>
                                </tr>
                                <tfoot>
                                    <td colspan="2">
                                        <div class="left">Forgot an Item? <a href="#">Edit Your Cart</a></div>
                                        <div class="right">
                                            <input type="button" value="Back" class="btn-step">
                                            <input type="submit" value="Place Order" class="btn-step btn-highligh">
                                        </div>
                                    </td>
                                </tfoot>
                            </table>
                        </li>
                        <li class="col-md-3">
                            <ul class="step-list-info" >
                                @if(isset($billingAddress))
                                    <li>
                                        <div class="title-step">
                                            Billing Address
                                            {{-- <a class="change" id="change" bid="{{ $billingAddress->id }}">
                                                CHANGE
                                            </a> --}}
                                            {{-- <input type="hidden" name="billingId" value="{{ $billingAddress->id }}"> --}}
                                        </div>
                                        <h5 id="firstName" style="display:inline"><strong>{{ $billingAddress->firstName }}</strong></h5>
                                        <h5 id="lastName" style="display:inline"><strong>{{ $billingAddress->lastName }}</strong></h5><br>
                                        <p id="email" style="display:inline">{{ $billingAddress->email }}</p><br>
                                        <p id="address" style="display:inline">{{ $billingAddress->address }}</p><br>
                                        <p id="city" style="display:inline">{{ $billingAddress->city }} </p><br><p id="userstate" style="display:inline">{{ $billingAddress->state }}, </p>
                                        <p id="zipp" style="display:inline">{{ $billingAddress->zip }}</p><br>
                                        <p id="mobile" style="display:inline">{{ $billingAddress->mobile }}, </p><p id="fax" style="display:inline">{{ $billingAddress->fax }}</p>
                                    </li>
                                @endif
                                @if (isset($shippingAddresses))
                                    <li>
                                        <div class="title-step">
                                            Shipping Address
                                            {{-- <a class="change" id="change" bid="{{ $i }}">
                                                CHANGE
                                            </a> --}}
                                            {{-- <input type="hidden" name="shippingId" value="{{ $shippingAddresses->id }}"> --}}
                                        </div>
                                        <h5 id="firstName" style="display:inline"><strong>{{ $shippingAddresses->firstName }}</strong></h5>
                                        <h5 id="lastName" style="display:inline"><strong>{{ $shippingAddresses->lastName }}</strong></h5><br>
                                        <p id="email" style="display:inline">{{ $shippingAddresses->email }}</p><br>
                                        <p id="address" style="display:inline">{{ $shippingAddresses->address }}</p><br>
                                        <p id="city" style="display:inline">{{ $shippingAddresses->city }} </p><br><p id="userstate" style="display:inline">{{ $shippingAddresses->state }}, </p>
                                        <p id="zipp" style="display:inline">{{ $shippingAddresses->zip }}</p><br>
                                        <p id="mobile" style="display:inline">{{ $shippingAddresses->mobile }}, </p><p id="fax" style="display:inline">{{ $shippingAddresses->fax }}</p>
                                    </li>
                                @endif
                            </ul>
                        </li>

                    </ul>
                </form><!--- form.checkout--->

                <div class="row">&nbsp</div>

            </div><!--- .container--->
        </div><!--- .woocommerce--->

    </div><!--- .main-container -->
@endsection

@section('script')

    <script>

        $(document).ready(function () {

            $('form#orderPlace').parsley();


        });
    </script>
@endsection
