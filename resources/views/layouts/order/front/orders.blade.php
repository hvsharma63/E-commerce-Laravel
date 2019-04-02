@extends('layouts.front.app')

{{-- <link href="{{ URL('/resources/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> --}}
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
@section('title','Checkout Step 1')
@section('content')
    <div class="main-container col1-layout content-color color">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"> <a href="/kart/abani" title="Go to Home Page">Home</a></li>
                    <li> <strong>Orders</strong></li>
                </ul>
            </div>
        </div><!--- .breadcrumbs-->
        <div class="container">
            <div class="content-top no-border">
                <h2>Orders</h2>
            </div>
            @if (count($orders)>0)
                <div class="table-responsive-wrapper">
                    <table class="table-order table-wishlist">
                        <thead>
                            <tr>
                                <td>Sr. No.</td>
                                <td>Name</td>
                                <td>Total Amount</td>
                                <td>Total Quantity</td>
                                <td>Payment Status</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($orders as $order)
                                <tr style="text-align: center">
                                    <td style="text-align: center">{{$i}}</td>
                                    <td style="text-align: center">{{$order->name}}</td>
                                    <td style="text-align: center">{{$order->totalAmount}}</td>
                                    <td style="text-align: center">{{$order->totalQty}}</td>
                                    <td style="text-align: center">
                                        @if ($order->paymentStatus == 0)
                                            Pending
                                        @elseif($order->paymentStatus == 1)
                                            Confirmed
                                        @elseif($order->paymentStatus == 2)
                                            Dispatched
                                        @elseif($order->paymentStatus == 3)
                                            Delivered
                                        @elseif($order->paymentStatus == 4)
                                            Cancelled
                                        @endif
                                    </td>
                                    <td class="post-large-detail" style="text-align: center">
                                        {{-- <div class="post-large-detail"> --}}
                                        <a class="btn-view-post" id="{{$order->id}}">View order</a>

                                            {{-- </div> --}}
                                        {{-- </div> --}}
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    
                </div><!--- .table-responsive-wrapper-->
            @else
                <div class="table-responsive-wrapper">
                    <table class="table-order table-order-review-bottom">
                        <tr>
                            <td colspan="5">You haven't ordered anything yet!</td>
                        </tr>
                    </table>
                </div><!--- .table-responsive-wrapper-->
            @endif
        </div><!--- .container-->
    </div><!--- .main-container -->
    <div class="block block-subscribe popup" style="display:none;">
        <div id="popup-newsletter">
            <div class="container">
                <div class="content-top no-border">
                    <h2 class="text-center">Products in the Order</h2>
                </div>
                <div class="table-responsive-wrapper">
                    <table class="table-order table-wishlist">
                        <thead>
                            <tr>
                                <td>Sr. No.</td>
                                <td>Product Name</td>
                                <td>Product Quantity</td>
                                <td>Product Amount</td>
                                <td>Subtotal</td>
                            </tr>
                        </thead>
                        <tbody id="productData">
                            
                        </tbody>
                    </table>
                    <table class="table-order table-order-review-bottom">
                        <tr>
                            <td class="first" width="80%">Total Payment</td>
                            <td id="finalPrice" class="price large" width="80%">
                                <span id="finalPriceValue">
                                    {{-- £ {{ $totalPrice }} --}}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div><!--- .table-responsive-wrapper-->
            </div><!--- .container-->

        </div>
    </div>
@endsection

@section('script')
    <script>

        // $(document).ready(function () {
        // });
        $(".btn-view-post").click(function () {
            // e.preventDefault();
            // alert("HI");
            popup();
            orderId = $(this).attr('id');
            $("#productData").empty();
            $("#finalPriceValue").empty();
            $.ajax({
                type: "POST",
                url: "getProductsByOrder",
                data: {_token:'{{csrf_token()}}',orderId:orderId},
                dataType: "json",
                success: function (response) {
                    total = 0;
                    for(i=0; i<response.length;i++){
                        html = '<tr style="text-align: center">'
                        +   '<td style="text-align: center">' + (i+1) +'</td>'        
                        +   '<td style="text-align: center">' + response[i]['productName'] +'</td>'
                        +   '<td style="text-align: center">' + response[i]['productQty'] +'</td>'
                        +   '<td style="text-align: center">' + response[i]['productPrice'] +'</td>'
                        +   '<td style="text-align: center">' + response[i]['productQty'] * response[i]['productPrice'] +'</td>'
                        +   '</tr>';
                        $("#productData").append(html);
                        total = total + (response[i]['productQty'] * response[i]['productPrice']);
                    }
                    $("#finalPriceValue").append("$ " + total);
                    console.log(response);
                }
            });
        });

        function popup() {
            var overlay = "#353535";
            var popup = $("#popup-newsletter");
            var popupWrapper = popup.parent();
            // var imageUrl = "assets/images/popup-newletter.jpg";
            var pwidth = 810;
            var pheight = 500;
            // if (popup.attr("imageurl")) imageUrl = popup.attr("imageurl");
            if (popup.attr("pwidth")) pwidth = popup.attr("pwidth");
            if (popup.attr("pheight")) pheight = popup.attr("pheight");
            popup.append("<div class='close-btn'></div>");
            popup.css({
                "background": "white",
                width: "100%",
                "max-width": pwidth + "px",
                "min-height": pheight + "px"
            });
            $("body").addClass("modal-active");
            popupWrapper.fadeIn(400);
            popupWrapper.bind("click", function(event) {
                var selector = $(event.target);
                if (selector.hasClass("popup") || selector.hasClass("close-btn")) {
                    popupWrapper.fadeOut(400);
                    $("body").removeClass("modal-active");
                }
            });
            // Center for popup
            popup_center();
            $(window).resize(function() {
                popup_center();
            });
        }

            // Center for popup
        function popup_center() {
            var popup = $("#popup-newsletter");
            var pH = popup.height();
            var wH = $(window).height();
            if (pH < wH) {
                var mT = (wH - pH) / 2 - 35;
                popup.css({
                    "margin-top": mT + "px"
                });
            } else {
                popup.css({
                    "margin-top": "none"
                });
            }
        }
    </script>
@endsection
