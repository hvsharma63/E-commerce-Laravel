@extends('layouts.front.app')
@section('title','Products')

@section('content')
    <div class="main-container col2-left-layout ">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"> <a href="#" title="Go to Home Page">Home

                    <li class="category4"> <strong>Products</strong></li>
                </ul>
            </div>
        </div><!--- .breadcrumbs-->
        <div class="container">
            <div class="main">
                <div class="row">
                    <div class="col-left sidebar col-lg-3 col-md-3 left-color color">
                        <div class="block block-layered-nav block-layered-nav--no-filters">
                            <div class="block-title"> <strong><span>Shop By</span></strong></div>
                            <div class="block-content toggle-content">
                                <p class="block-subtitle block-subtitle--filter">Filter</p>
                                <dl id="narrow-by-list">
                                    <dt class="even">By Price</dt>
                                    <dd class="even">
                                        <div class="slider-ui-wrap">
                                            <div id="price-range" class="slider-ui" slider-min="0" slider-max="1000000" slider-min-start="0" slider-max-start="500000"></div>
                                        </div>
                                        <form action="#" class="price-range-form">
                                            <input type="text" class="range_value range_value_min" target="#price-range" /> - <input type="text" class="range_value range_value_max" target="#price-range" />
                                            <input type="submit" class="btn-submit price-submit" value="OK" />
                                        </form>
                                    </dd>
                                    <dt class="odd">Brands</dt>
                                    <dd class="odd">
                                        <ul style="" class="nav-accordion">
                                            @foreach ($categories as $category)
                                                <li class="level0 level-top"><input type="checkbox" class="brand" name="brand" value="{{ $category->id }}" id=""><span> {{ $category->name }}</span></li>
                                            @endforeach
                                        </ul>
                                    </dd>
                                    <dt class="even">By Colors</dt>
                                    <dd class="even">
                                        <ol class="configurable-swatch-list">
                                            @foreach ($colors as $color)
                                                <li>
                                                    <a href="#" class="swatch-link has-image">
                                                        <span class="swatch-label">
                                                            <img src="/kart/resources/front-assets/images/{{$color->colorName}}.png" alt="{{$color->colorName}}" title="{{$color->colorName}}" height="15" width="15">
                                                        </span>
                                                        <span class="count">{{$color->colorName}}</span>
                                                        <input type="checkbox" class="getColor" name="color" value="{{ $color->id }}" id="">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </dd>
                                </dl>
                            </div>
                        </div><!--- .block-layered-nav-->

                    </div><!--- .sidebar-->
                    <div class="col-main col-lg-9 col-md-9 content-color color">
                        <div class="page-title category-title">
                            <h1>Products</h1>
                        </div>
                        <p class="category-image"><img src="http://placehold.it/875x360" alt="Men" title="Men"></p>
                        <div class="category-products">
                            <div class="toolbar">
                                <div class="sorter">
                                    <p class="view-mode">
                                        <label>View as:</label>
                                        <a title="Grid" id="productGrid" class="redirectjs grid" onclick="getTheProducts(this);" value="grid"> <i class="icon-grid icons"></i> </a>
                                        <a title="List" id="productList" class="active" onclick="getTheProducts(this);" value="list"> <i class="icon-list icons"></i> </a>
                                    </p>
                                    <div class="sort-by">
                                        <label>Sort By</label>
                                        <select id="sortType">
                                            <option value="created_at" selected="selected"> Latest</option>
                                            <option value="name"> Name</option>
                                            <option value="price"> Price</option>
                                        </select>
                                        <a class="order" title="Descending Order"><img src="{{URL('resources/front-assets/images/i_asc_arrow.gif')}}" alt="Set Descending Direction"  class="v-middle"></a>
                                    </div>

                                    <div class="pager">
                                        <div class="pages">
                                            <strong>Page:</strong>
                                            <ol>
                                                <li class="current">1</li>
                                                <li><a href="#">2</a></li>
                                                <li class="bor-none"> <a class="next i-next" href="#" title="Next"> <i class="fa fa-angle-right">&nbsp;</i> </a></li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div><!--- .toolbar-->
                            <div class="product-data">

                            </div>
                            <div class="page-nav-bottom">
                                <div class="left">Items 13 to 24 of 38 total</div>
                                <div class="right">
                                    <ul class="page-nav-category">
                                        <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a class="selected" href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </div>
                            </div><!--- .page-nav-bottom-->
                        </div><!--- .category-products-->
                    </div><!--- .col-main-->
                </div><!--- .row-->
            </div><!--- .main-->
        </div><!--- .container-->

        {{-- <div class="alo-brands">
            <div class="container">
                <div class="main">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="footer-brand">
                                <ul class="magicbrand">
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_01" title="brands_01" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_02" title="brands_02" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_03" title="brands_03" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_04" title="brands_04" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_05" title="brands_05" /> </a></li>
                                    <li> <a href="#"> <img class="brand img-responsive" src="http://placehold.it/190x80/ffffff" alt="brands_06" title="brands_06" /> </a></li>
                                </ul>
                            </div><!-- #footer-brand -->
                        </div>
                    </div>
                </div>
            </div><!-- .container-->
        </div><!-- .alo-brands --> --}}
    </div><!--- .main-container -->
@endsection
@section('script')
    <script>

        (function( $ ){
            $.fn.ajaxFunction = function(view,brandIds,colorIds,min_price,max_price) {
                min_price = $('.range_value_min').val()
                max_price = $('.range_value_max').val()
                sortType = $("#sortType").val()
                if($('a.order').attr('title') == 'Descending Order'){
                    orderType = 'asc';
                }else{
                    orderType = 'desc';
                }
                $.ajax({
                    url: "/kart/viewProducts",
                    type: "POST",
                    data: {_token:'{{csrf_token()}}',type: view,brandId: brandIds,colorId: colorIds,min_price: min_price,max_price: max_price,
                    sortType: sortType,orderType: orderType},
                    dataType: "html",
                    success: function (response) {
                        $(".product-data").html(response);
                    }
                })

                return this;
            };


        })( jQuery );

        function getTheProducts(el){
            viewType = $(el).attr('title');
            console.log(viewType);

            if(viewType == 'Grid'){
                if($("#productList").hasClass("active")){
                    $("#productList").removeClass("active");
                }
                $(el).addClass("active");
                view = 'grid';
            }else{
                if($("#productGrid").hasClass("active")){
                    $("#productGrid").removeClass("active");
                }
                $(el).addClass("active");
                view = 'list';
            }
            $(this).ajaxFunction(view,brandIds,colorIds)
        }

        var brandIds = new Array();
        $(".brand").click(function (e) {
            brandIds = [];
            $('input[name="brand"]:checked').each(function(){
                brandIds.push(this.value);
            });
            if($("#productList").hasClass("active")){
                view = 'list';
            }else{
                view = 'grid';
            }
            $(this).ajaxFunction(view,brandIds,colorIds)
        });

        var colorIds = new Array();
        $(".getColor").click(function (e) {
            console.log('color');
            colorIds = [];
            $('input[name="color"]:checked').each(function(){
                colorIds.push(this.value);
            });
            if($("#productList").hasClass("active")){
                view = 'list';
            }else{
                view = 'grid';
            }
            $(this).ajaxFunction(view,brandIds,colorIds)
        });


        $(document).ready(function () {
            if($("#productList").hasClass("active")){
                $(this).ajaxFunction('list',brandIds,colorIds);
            }
        });

        $(".price-submit").click(function (e) {
            e.preventDefault();
            if($("#productList").hasClass("active")){
                view = 'list';
            }else{
                view = 'grid';
            }
            min = $('.range_value_min').val()
            max = $('.range_value_max').val()

            $(this).ajaxFunction(view,brandIds,colorIds,min,max)

        });

        $("#sortType").change(function () {
            sortType = $("#sortType").val();
            if($("#productList").hasClass("active")){
                view = 'list';
            }else{
                view = 'grid';
            }
            min = $('.range_value_min').val()
            max = $('.range_value_max').val()
            $(this).ajaxFunction(view,brandIds,colorIds,min,max,sortType)

        });

        $("a.order").click(function (e) {
            e.preventDefault();
            order = $(this).attr('title');
            if(order == 'Descending Order'){
                $(this).attr('title', 'Ascending Order');
                $("a.order>img").css("transform","rotate(-180deg)");
                orderType = 'desc';
            }else{
                $(this).attr('title', 'Descending Order');
                $("a.order>img").css("transform","rotate(360deg)")
                orderType = 'asc';
            }
            if($("#productList").hasClass("active")){
                view = 'list';
            }else{
                view = 'grid';
            }
            min = $('.range_value_min').val()
            max = $('.range_value_max').val()
            sortType = $("#sortType").val();
            $(this).ajaxFunction(view,brandIds,colorIds,min,max,sortType,orderType)

        });
        // $(function () {


        //     $("#productGrid").click(function () {

        //         if($("#productList").hasClass("active")){
        //             $("#productList").removeClass("active");
        //         }
        //         viewType = $(this).attr("title");
        //         $(this).addClass("active");
        //         $(this).addProduct(viewType);
        //     });

        //     $("#productList").click(function () {

        //         if($("#productGrid").hasClass("active")){
        //             $("#productGrid").removeClass("active");
        //         }
        //         viewType = $(this).attr("title");
        //         $(this).addClass("active");
        //         $(this).addProduct(viewType);
        //     });

        // });

        $(document).on("click", "button.btn-cart", function (e) {
            e.preventDefault();
            productId = $(this).val();
            $.ajax({
                type: "post",
                url: "/kart/session/addSingleProductToCart",
                data: {_token:'{{csrf_token()}}',productId:productId,quantity:1},
                dataType: "json",
                success: function (data) {
                    $.toast({
                        heading: 'Well done!',
                        text: 'Product has been successfully added to cart',
                        position: 'bottom-left',
                        loaderBg: '#5ba035',
                        icon: 'success',
                        hideAfter: 3000,
                        stack: 2
                    });
                    $("div#cart-total-content").load(" div#cart-total-content");
                    // alert(location.href);
                }
            });
        });
        // $(document).on("click", "a.btn-remove", function (e) {
        //     e.preventDefault();
        //     productId = $(this).attr('pid');
        //     // alert(productId);
        //     $(this).closest('li').remove();
        //     $.ajax({
        //         type: "post",
        //         url: "/kart/session/deleteSingleProduct",
        //         data: {_token:'{{csrf_token()}}',productId:productId},
        //         dataType: "json",
        //         success: function (response) {
        //             if(response.data == true){
        //                 console.log(response.message);
        //                 $("p.subtotal").load(" p.subtotal");
        //             }
        //         }
        //     });
        // });
    </script>
@endsection
