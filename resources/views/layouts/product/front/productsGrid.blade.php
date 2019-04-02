<ul id="productsGrid" class="products-grid row products-grid--max-3-col last odd">
    @foreach ($products as $product)
        <li class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-mobile-12 item">
            <div class="category-products-grid">
                <div class="images-container">
                    <div class="product-hover">
                        <a href="products/{{ $product->id }}" title="Configurable Product" class="product-image">
                            <img id="product-collection-image-8" class="img-responsive" src="/kart/resources/assets/images/products/{{ $product->id }}/{{ $product->thumbnail }}" alt="" height="355" width="278">
                            {{-- <span class="product-img-back"> <img class="img-responsive" src="http://placehold.it/278x355?text=hover" alt="" height="355" width="278"> </span>  --}}
                        </a>
                    </div>
                    <div class="actions-no hover-box">
                        <div class="actions">
                            <button type="button" title="Add to Cart" value="{{ $product->id }}" class="button btn-cart pull-left"><span><i class="icon-handbag icons"></i><span>Add to Cart</span></span></button>
                            {{-- <ul class="add-to-links pull-left">
                                <li class="pull-left"><a href="#" title="Add to Wishlist" class="link-wishlist"><i class="icon-heart icons"></i>Add to Wishlist</a></li>
                                <li class="pull-left"><a href="#" title="Add to Compare" class="link-compare"><i class="icon-bar-chart icons"></i>Add to Compare</a></li>
                                <li class="link-view pull-left"> <a title="Quick View" href="#" class="link-quickview"><i class="icon-magnifier icons"></i>Quick View</a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="product-info products-textlink clearfix">
                    <h2 class="product-name"><a href="products/{{ $product->id }}" title="Configurable Product">{{ $product->name }}</a></h2>

                    <div class="price-box"> <span class="regular-price"> <span class="price">₹ {{ $product->price }}</span> </span></div>

                </div>
            </div>
        </li>
    @endforeach
</ul><!--- .products-grid-->
