<ol class="products-list" id="productsList">
    @foreach ($products as $product)
        <li class="item">
            <div class="row">
                <div class="col-mobile-12 col-xs-5 col-md-4 col-sm-4 col-lg-4">
                    <div class="products-list-container">
                        <div class="images-container">
                            <div class="product-hover">
                                {{-- <span class="sticker top-left"><span class="labelnew">New</span></span> --}}
                                <a href="products/{{ $product->id }}" title="" class="product-image">
                                    <img id="product-collection-image-8" class="img-responsive" src="/kart/resources/assets/images/products/{{ $product->id }}/{{ $product->thumbnail }}" width="278" height="355" alt="">
                                </a>
                                {{-- <div class="product-hover-box">
                                    <a class="detail_links" href="#"></a>
                                    <div class="link-view"> <a title="Quick View" href="#" class="link-quickview"><i class="icon-magnifier icons"></i>Quick View</a></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-shop col-mobile-12 col-xs-7 col-md-8 col-sm-8 col-lg-8">
                    <div class="f-fix">
                        <div class="product-primary products-textlink clearfix">
                            <h2 class="product-name"><a href="products/{{ $product->id }}" title="Configurable Product">{{ $product->name }}</a></h2>
                            <div class="price-box"> <span class="regular-price"> <span class="price">₹ {{ $product->price }} </span> </span></div>

                        </div>
                        <div class="desc std">
                            <p>Aliquam condimentum pharetra metus sed posuere. Ut euismod nisl sit amet enim consectetur volutpat. Nulla vitae magna dictum, adipiscing mauris eu, gravida tellus. Nulla tempor, felis feugiat fermentum suscipit.</p>
                        </div>
                        <div class="product-secondary actions-no actions-list clearfix">
                            <p class="action"><button type="button" id="buttonCart" title="Add to Cart" value="{{ $product->id }}" class="button btn-cart pull-left" ><span><i class="icon-handbag icons"></i><span>Add to Cart</span></span></button></p>
                            {{-- <ul class="add-to-links">
                                <li class="pull-left"><a href="#" title="Add to Wishlist" class="link-wishlist"><i class="icon-heart icons"></i>Add to Wishlist</a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </li><!--- .item-->
    @endforeach
</ol><!--- .products-list-->
