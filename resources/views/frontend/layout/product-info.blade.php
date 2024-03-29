<div class="product-miniature js-product-miniature item-one first-item">
    <div class="thumbnail-container {{ request()->route()->named('home')? '' : 'border' }}">
        <a href="{{route('product', $product)}}">
            <img class="img-fluid image-cover"
                src="{{$product->firstImage()->image}}" alt="img">
            @if ($product->secondImage())
                <img class="img-fluid image-secondary" 
                    src="{{$product->secondImage()->image}}" alt="img">
            @else
                <img class="img-fluid image-secondary" 
                    src="{{$product->firstImage()->image}}" alt="img">
            @endif
        </a>
        @if ($product->discount)
            <div class="product-flags discount">-{{$product->discount}}%</div>
        @endif
    </div>
    <div class="product-description">
        <div class="product-groups">
            <div class="product-title">
                <a href="{{route('product', $product)}}">{{$product->name}}</a>
            </div>
            <div class="product-group-price">
                <div class="product-price-and-shipping">
                    <span class="price">{{convertPrice($product->price)}}</span>
                    @if ($product->discount)
                        <del class="regular-price">{{convertPrice(initialPrice($product->price, $product->discount))}}</del>
                    @endif
                </div>
            </div>
        </div>
        <div class="product-buttons d-flex justify-content-center">
            <div class="formAddToCart">
                <a class="add-to-cart" href="{{route('cart.add', $product)}}" data-button-action="add-to-cart">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
            </div>
            <a class="addToWishlist" href="{{route('favorite.add', $product)}}" data-rel="1" onclick="">
                <i class="fa fa-heart" aria-hidden="true"></i>
            </a>
            <a href="{{route('product', $product)}}" class="quick-view hidden-sm-down" data-link-action="quickview">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>