@extends('layouts.front.app')
@section('title','Cart')

@section('content')
    <div class="main-container col1-layout content-color color">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"> <a href="#" title="Go to Home Page">Home</a></li>
                    <li> <strong>Cart</strong></li>
                </ul>
            </div>
        </div><!--- .breadcrumbs-->

        <div class="container" id="productCart">
            <div id="productTable">
                <div class="content-top no-border">
                    <h2>Cart</h2>
                    {{-- <div class="wish-list-notice"><i class="icon-check"></i>Product with Variants has been added to your wishlist. <a href="#">Click here</a> to continue shopping.</div> --}}
                </div>
            {{-- <div class="popup-newsletter" style="background-color:royalblue;width: 342px;height: 85px;margin-right: 20px;">Hiiiiiiiiiiiiii</div> --}}
                @if (isset($products) && !empty($products))
                    <div class="table-responsive-wrapper">
                        <table class="table-order table-wishlist">
                            <thead>
                                <tr>
                                    <td>Remove</td>
                                    <td>Product</td>
                                    <td>Price</td>
                                    <td>Quantity</td>
                                    <td>Total Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                    $pt = count($products);
                                @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td><button type="button" class="button-remove" pid="{{ $product['productId'] }}"><i class="icon-close"></i></button></td>
                                            <td style="text-align: center">
                                                <img src="/kart/resources/assets/images/products/{{ $product['productId'] }}/{{ $product['thumbnail'] }}" style="height:115px;width:115px"/>
                                                <p>{{ $product['name'] }}</p>
                                            </td>
                                            <td style="text-align: center" id="price{{ $product['productId'] }}">{{ $product['price'] }}</td>
                                            <td class="wish-list-control">
                                                <div class="number-input">
                                                    <button type="button" value="minus" pid="{{ $product['productId'] }}" title="minus" class="minus action">-</button>
                                                    <input type="number" pid="{{ $product['productId'] }}" value="{{ $product['qty'] }}" min="0" max="1000" class="qty" id="qty">
                                                    <button type="button" value="plus" pid="{{ $product['productId'] }}" title="plus" class="plus action">+</button>
                                                </div>
                                            </td>

                                                <td style="text-align: center" class="totalPrice" id="singleProductPrice{{ $product['productId'] }}">
                                                    <span id="change{{ $product['productId'] }}">
                                                        {{ $product['qty']*$product['price'] }}
                                                    </span>
                                                </td>
                                        </tr>
                                        @php
                                            $totalPrice = $totalPrice + $product['qty']*$product['price'];
                                        @endphp
                                    @endforeach
                            </tbody>
                        </table>
                        <table class="table-order table-order-review-bottom">
                            <tr>
                                <td class="first large" width="80%">Total Payment</td>
                                <td id="finalPrice" class="price large" width="80%">
                                    <span id="finalPriceValue">
                                        £ {{ $totalPrice }}
                                    </span>
                                </td>
                                <td class="right">
                                    <a href="checkout">
                                        <input type="submit" value="Place Order" class="btn-step btn-highligh">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div><!--- .table-responsive-wrapper-->
                @else
                    <div class="table-responsive-wrapper">
                        <table class="table-order table-order-review-bottom">
                            <tr>
                                <td colspan="5">There's nothing in the cart</td>
                            </tr>
                        </table>
                    </div><!--- .table-responsive-wrapper-->
                @endif
            </div>

        </div><!--- .container-->



    </div><!--- .main-container -->
@endsection
@section('script')
    <script>
        // sum = 0;
        // $(".totalPrice").each(function (index, element) {
        //         // element == this
        //     sum += parseFloat($(this).text());
        // });
        // $("#finalPrice").text(sum);


        $(document).on("click", "td>button.button-remove", function () {
            productId = $(this).attr('pid');
            $(this).closest('tr').remove();
            $(this).removeProduct(productId);
            $.toast({
                heading: 'Product Removed',
                text: 'Product has been removed from the cart!',
                position: 'bottom-left',
                loaderBg: '#bf441d',
                icon: 'error',
                hideAfter: 3000,
                stack: 2
            });
        });

        (function( $ ){
            $.fn.ajaxFunction = function(id,qty) {

                $.ajax({
                    type: "POST",
                    url: "/kart/qty/action",
                    data: {_token:'{{csrf_token()}}',id:id,qty:qty},
                    dataType: "json",
                    success: function (response) {
                        // $(".table-order.table-wishlist").load(" .table-order.table-wishlist");
                        $("td#singleProductPrice"+id).load(location.href + " #change"+id);
                        // // $("#change"+id+"#singleProductPrice"+id).load(location.href + " #singleProductPrice"+id);
                        $("td#finalPrice").load(location.href + " #finalPriceValue");
                        $("div#cart-total-content").load(location.href + " div#cart-total-content");
                        // jQuery.when($.trim($("td#finalPrice").text()) == "").then(function(data,textStatus,jqXHR){
                        //     $("div#productCart").load(location.href + " #productTable");
                        // })
                    }
                });
                return this;
            };

            $.fn.removeProduct = function(productId){
                console.log("the request went from removeProduct function");
                $.ajax({
                    type: "post",
                    url: "/kart/session/deleteSingleProduct",
                    data: {_token:'{{csrf_token()}}',productId:productId},
                    dataType: "json",
                    success: function (response) {
                        $("td#finalPrice").load(location.href + " #finalPriceValue");
                        $("div#cart-total-content").load(location.href + " div#cart-total-content");
                        // jQuery.when($.trim($("td#finalPrice").text()) == "").then(function(data,textStatus,jqXHR){
                        //     $("div#productCart").load(location.href + " #productTable");
                        // })
                        if($("tr").length < 3){
                            $("div#productCart").load(location.href + " #productTable");
                        }
                    }
                });
                return this;
            }

        })( jQuery );
        // click = 0;
        $(document).on("click",".action",function(e){
            if( $(this).val() == 'plus'){
                status = $(this).val();
                pid = $(this).attr('pid');
                console.log(pid);
                qty = $(this).prev().val();
                $.toast({
                    heading: 'Well done!',
                    text: 'Quantity Increased',
                    position: 'bottom-left',
                    loaderBg: '#5ba035',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 2
                });
            }

            if( $(this).val() == 'minus'){
                status = $(this).val();
                pid = $(this).attr('pid');
                console.log(pid);
                qty = $(this).next().val();
                $.toast({
                    heading: 'Quantity Decreased',
                    // text: 'Quantity Decreased',
                    position: 'bottom-left',
                    loaderBg: '#bf441d',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 2
                });

            }
            if(qty == 0){
                console.log("it is 0 and pid is " + pid);
                $(this).closest('tr').remove();
                $(this).removeProduct(pid);
            }else{
                id = $(this).attr('pid');
                $(this).ajaxFunction(id,qty);
            }

        });

        $(document).on("change",".qty", function(e){
            id = $(this).attr('pid');
            qty = $(this).val();
            if(qty == 0){
                $(this).closest('tr').remove();
                $(this).removeProduct(id);
            }else{
                // $("#singleProductPrice"+id).text(qty*$("#price"+id).text());
                $(this).ajaxFunction(id,qty);
            }

        });

        $(document).on("keypress", 'input[type=number]' ,function (e) {
            var regex = new RegExp("^[0-9]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

    </script>
@endsection
