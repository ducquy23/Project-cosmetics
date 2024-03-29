@extends('frontend.layout.master')
@section('content')
@section('page-id', 'product-detail')

@push('css')
    <style>
        [class~=tab-content] [class~=item] [class~=product-miniature] {
            padding-bottom: 20px;
        }
        .tab-content .item .product-miniature .product-description .product-buttons{
            bottom: -15px !important;
        }
        .top-product .product-title a {
            display: block;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endpush
    <!-- main content -->
    <div class="main-content">
        <div id="wrapper-site">
            <div id="content-wrapper">
                <div id="main">
                    <div class="page-home">
                        <!-- breadcrumb -->
                        <nav class="breadcrumb-bg">
                            <div class="container no-index">
                                <div class="breadcrumb">
                                    <ol>
                                        <li>
                                            <a href="/">
                                                <span>Trang chủ</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('shop')}}">
                                                <span>{{$product->category->parent->name}}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('shop')}}">
                                                <span>{{$product->category->name}}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <span>
                                                <span>{{$product->name}}</span>
                                            </span>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </nav>
                        <div class="container">
                            <div class="content">
                                <div class="row">
                                    <div class="sidebar-3 sidebar-collection col-lg-3 col-md-3 col-sm-4">
                                        <!-- category -->
                                       @include('frontend.layout.categories-sidebar')

                                        <!-- best seller -->
                                        <div class="sidebar-block top-product">
                                            <div class="title-block">
                                                Bán chạy trong tuần
                                            </div>
                                            <div class="product-content tab-content">
                                                <div class="row">
                                                    @foreach($topProducts as $topProduct)
                                                    <div class="item col-md-12">
                                                        <div class="product-miniature item-one first-item d-flex">
                                                            <div class="thumbnail-container border">
                                                                <a href="{{route('product', $topProduct)}}">
                                                                    <img class="img-fluid image-cover"
                                                                        src="{{$topProduct->firstImage()->image}}" alt="img">
                                                                    @if ($topProduct->secondImage())
                                                                        <img class="img-fluid image-secondary"
                                                                            src="{{$topProduct->secondImage()->image}}" alt="img">
                                                                    @else
                                                                        <img class="img-fluid image-secondary"
                                                                            src="{{$topProduct->firstImage()->image}}" alt="img">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="product-description">
                                                                <div class="product-groups">
                                                                    <div class="product-title">
                                                                        <a href="{{route('product', $topProduct)}}">{{$topProduct->name}}</a>
                                                                    </div>
                                                                    <div class="product-group-price">
                                                                        <div class="product-price-and-shipping">
                                                                            <span class="price">{{convertPrice($topProduct->price)}}</span>
                                                                            @if ($topProduct->discount)
                                                                                <del class="regular-price">{{convertPrice(initialPrice($topProduct->price, $topProduct->discount))}}</del>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-sm-8 col-lg-9 col-md-9">
                                        <div class="main-product-detail">
                                            <h2>{{$product->name}}</h2>
                                            <div class="product-single row">
                                                <div class="product-detail col-xs-12 col-md-5 col-sm-5">
                                                    <div class="page-content" id="content">
                                                        <div class="images-container">
                                                            <div class="js-qv-mask mask tab-content border">
                                                                @foreach ($product->images as $key=>$item)
                                                                    <div id="item{{$key}}" class="tab-pane fade
                                                                            {{$key == 0 ? 'active in show' : ''}} ">
                                                                        <img src="{{$item->image}}" alt="img">
                                                                    </div>
                                                                @endforeach

                                                                <div class="layer hidden-sm-down" data-toggle="modal"
                                                                    data-target="#product-modal">
                                                                    <i class="fa fa-expand"></i>
                                                                </div>
                                                            </div>
                                                            <ul class="product-tab nav nav-tabs d-flex">
                                                                @if ($product->images->count() > 1)
                                                                    @foreach ($product->images as $key=>$item)
                                                                        <li class="active col">
                                                                            <a href="#item{{$key}}" data-toggle="tab"
                                                                                aria-expanded="true" class="{{$key == 0 ? 'active show' : ''}}">
                                                                                <img src="{{$item->image}}" alt="img">
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                @endif

                                                            </ul>
                                                            <div class="modal fade" id="product-modal" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <div class="modal-body">
                                                                                <div class="product-detail">
                                                                                    <div>
                                                                                        <div class="images-container">
                                                                                            <div
                                                                                                class="js-qv-mask mask tab-content">
                                                                                                @foreach ($product->images as $key=>$item)
                                                                                                    <div id="modal-item{{$key}}"
                                                                                                        class="tab-pane fade {{$key == 0 ? 'active in show' : ''}}">
                                                                                                        <img src="{{$item->image}}"
                                                                                                            alt="img">
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                            <ul class="product-tab nav nav-tabs">
                                                                                                @foreach ($product->images as $key=>$item)
                                                                                                    <li class="active">
                                                                                                        <a href="#modal-item{{$key}}"
                                                                                                            data-toggle="tab"
                                                                                                            class=" {{$key == 0 ? 'active show' : ''}} ">
                                                                                                            <img src="{{$item->image}}"
                                                                                                                alt="img">
                                                                                                        </a>
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            </ul>
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
                                                <div class="product-info col-xs-12 col-md-7 col-sm-7">
                                                    <div class="detail-description">
                                                        <div class="price-del">
                                                            <span class="price">{{convertPrice($product->price)}}</span>
                                                            <span class="float-right">
                                                                <span class="availb">Tình trạng: </span>
                                                                @if ($product->quantity > 0)
                                                                    <span class="check">
                                                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>Còn hàng
                                                                    </span>
                                                                @else
                                                                    <span class="check text-danger">
                                                                        <i class="fa fa-times-circle-o" aria-hidden="true"></i>Hết hàng
                                                                    </span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="option has-border mt-2">
                                                            <div class="size">
                                                                <span class="size">Mã sản phẩm :</span>
                                                                <span>{{$product->product_code}}</span>
                                                            </div>
                                                        </div>
                                                        <form action="{{route('cart.add', $product)}}" class="has-border cart-area" >
                                                            <div class="product-quantity">
                                                                <div class="qty">
                                                                    <div class="input-group">
                                                                        <div class="quantity">
                                                                            <span class="control-label">QTY : </span>
                                                                            <input type="text" name="quantity"
                                                                                id="quantity_wanted" value="1"
                                                                                class="input-group form-control">

                                                                            <span class="input-group-btn-vertical">
                                                                                <button
                                                                                    class="btn btn-touchspin js-touchspin bootstrap-touchspin-up"
                                                                                    type="button">
                                                                                    +
                                                                                </button>
                                                                                <button
                                                                                    class="btn btn-touchspin js-touchspin bootstrap-touchspin-down"
                                                                                    type="button">
                                                                                    -
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                        <span class="add">
                                                                            <button class="btn btn-primary add-to-cart add-item"
                                                                                data-button-action="add-to-cart" type="submit">
                                                                                <i class="fa fa-shopping-cart"
                                                                                    aria-hidden="true"></i>
                                                                                <span>Thêm vào giỏ hàng</span>
                                                                            </button>
                                                                            <a class="addToWishlist" href="{{route('favorite.add', $product)}}">
                                                                                <i class="fa fa-heart"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <p class="product-minimal-quantity">
                                                            </p>
                                                        </form>
                                                        <div class="d-flex2 has-border">
                                                            <div class="btn-group">
                                                                <a href="#">
                                                                    <i class="zmdi zmdi-share"></i>
                                                                    <span>Share</span>
                                                                </a>
                                                                <a href="#" class="email">
                                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                                    <span>SEN TO A FRIEND</span>
                                                                </a>
                                                                <a href="#" class="print">
                                                                    <i class="zmdi zmdi-print"></i>
                                                                    <span>Print</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="rating-comment has-border d-flex">
                                                            <div class="review-description d-flex">
                                                                <span>REVIEW :</span>
                                                                <div class="rating">
                                                                    <div class="star-content">
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="read after-has-border">
                                                                <a href="#review">
                                                                    <i class="fa fa-commenting-o color"
                                                                        aria-hidden="true"></i>
                                                                    <span>READ REVIEWS (3)</span>
                                                                </a>
                                                            </div>
                                                            <div class="apen after-has-border">
                                                                <a href="#review">
                                                                    <i class="fa fa-pencil color"
                                                                        aria-hidden="true"></i>
                                                                    <span>WRITE A REVIEW</span>
                                                                </a>
                                                            </div>
                                                        </div> --}}
                                                        <div class="content">
                                                            <p>Danh mục :
                                                                <span class="content2">
                                                                    <a href="#">{{$product->category->name}}</a>
                                                                </span>
                                                            </p>
                                                            <p>Nơi sản xuất :
                                                                <span class="content2">
                                                                    <a href="#">{{$product->origin->name}}</a>
                                                                </span>
                                                            </p>
                                                            <p>Thương hiệu :
                                                                <span class="content2">
                                                                    <a href="#">{{$product->brand->name}}</a>,
                                                                </span>
                                                            </p>
                                                            @if ($product->texture)
                                                                <p>Kết cấu :
                                                                    <span class="content2">
                                                                        <a href="#">{{$product->texture}}</a>,
                                                                    </span>
                                                                </p>
                                                            @endif

                                                            @if ($product->skin_type)
                                                                <p>Loại da :
                                                                    <span class="content2">
                                                                        <a href="#">{{$product->skin_type}}</a>,
                                                                    </span>
                                                                </p>
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="review">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a data-toggle="tab" href="#description"
                                                            class="active show">Mô tả sản phẩm</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#tag">Cách dùng</a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="tab" href="#review">Đánh giá (2)</a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div id="description" class="tab-pane fade in active show">
                                                        {!! $product->description !!}
                                                    </div>

                                                    <div id="review" class="tab-pane fade">
                                                        <div class="spr-form">
                                                            <div class="user-comment">
                                                                <div class="spr-review">
                                                                    <div class="spr-review-header">
                                                                        <span class="spr-review-header-byline">
                                                                            <strong>Peter Capidal</strong> -
                                                                            <span>Apr 14, 2018</span>
                                                                        </span>
                                                                        <div class="rating">
                                                                            <div class="star-content">
                                                                                <div class="star"></div>
                                                                                <div class="star"></div>
                                                                                <div class="star"></div>
                                                                                <div class="star"></div>
                                                                                <div class="star"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="spr-review-content">
                                                                        <p class="spr-review-content-body">In feugiat
                                                                            venenatis enim, non finibus metus bibendum
                                                                            eu. Proin massa justo, eleifend fermentum
                                                                            varius
                                                                            quis, semper gravida quam. Cras nec enim sed
                                                                            lacus viverra luctus. Nunc quis accumsan
                                                                            mauris.
                                                                            Aliquam fermentum sit amet est id
                                                                            scelerisque.
                                                                            Nam porta risus metus.</p>
                                                                    </div>
                                                                </div>
                                                                <div class="spr-review preview2">
                                                                    <div class="spr-review-header">
                                                                        <span class="spr-review-header-byline">
                                                                            <strong>David James</strong> -
                                                                            <span>Apr 13, 2018</span>
                                                                        </span>
                                                                        <div class="rating">
                                                                            <div class="star-content">
                                                                                <div class="star"></div>
                                                                                <div class="star"></div>
                                                                                <div class="star"></div>
                                                                                <div class="star"></div>
                                                                                <div class="star"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="spr-review-content">
                                                                        <p class="spr-review-content-body">In feugiat
                                                                            venenatis enim, non finibus metus bibendum
                                                                            eu. Proin massa justo, eleifend fermentum
                                                                            varius
                                                                            quis, semper gravida quam. Cras nec enim sed
                                                                            lacus viverra luctus. Nunc quis accumsan
                                                                            mauris.
                                                                            Aliquam fermentum sit amet est id
                                                                            scelerisque.
                                                                            Nam porta risus metus.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form method="post" action="#" class="new-review-form">
                                                            <input type="hidden" name="review[rating]" value="3">
                                                            <input type="hidden" name="product_id">
                                                            <h3 class="spr-form-title">Write a review</h3>
                                                            <fieldset>
                                                                <div class="spr-form-review-rating">
                                                                    <label class="spr-form-label">Your Rating</label>
                                                                    <fieldset class="ratings">
                                                                        <input type="radio" id="star5" name="rating"
                                                                            value="5" />
                                                                        <label class="full" for="star5"
                                                                            title="Awesome - 5 stars"></label>
                                                                        <input type="radio" id="star4half" name="rating"
                                                                            value="4 and a half" />
                                                                        <input type="radio" id="star4" name="rating"
                                                                            value="4" />
                                                                        <label class="full" for="star4"
                                                                            title="Pretty good - 4 stars"></label>
                                                                        <input type="radio" id="star3half" name="rating"
                                                                            value="3 and a half" />
                                                                        <input type="radio" id="star3" name="rating"
                                                                            value="3" />
                                                                        <label class="full" for="star3"
                                                                            title="Meh - 3 stars"></label>
                                                                        <input type="radio" id="star2half" name="rating"
                                                                            value="2 and a half" />
                                                                        <input type="radio" id="star2" name="rating"
                                                                            value="2" />
                                                                        <label class="full" for="star2"
                                                                            title="Kinda bad - 2 stars"></label>
                                                                        <input type="radio" id="star1half" name="rating"
                                                                            value="1 and a half" />
                                                                        <input type="radio" id="star1" name="rating"
                                                                            value="1" />
                                                                        <label class="full" for="star1"
                                                                            title="Sucks big time - 1 star"></label>
                                                                        <input type="radio" id="starhalf" name="rating"
                                                                            value="half" />
                                                                    </fieldset>
                                                                </div>
                                                            </fieldset>
                                                            <fieldset class="spr-form-contact">
                                                                <div class="spr-form-contact-name">
                                                                    <input
                                                                        class="spr-form-input spr-form-input-text form-control"
                                                                        value="" placeholder="Enter your name">
                                                                </div>
                                                                <div class="spr-form-contact-email">
                                                                    <input
                                                                        class="spr-form-input spr-form-input-email form-control"
                                                                        value="" placeholder="Enter your email">
                                                                </div>
                                                            </fieldset>
                                                            <fieldset>
                                                                <div class="spr-form-review-body">
                                                                    <div class="spr-form-input">
                                                                        <textarea class="spr-form-input-textarea"
                                                                            rows="10"
                                                                            placeholder="Write your comments here"></textarea>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <div class="submit">
                                                                <input disabled type="submit" name="addComment"
                                                                    id="submitComment" class="btn btn-default"
                                                                    value="Submit Review">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div id="tag" class="tab-pane fade in">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                            do
                                                            eiusmod tempor incididunt ut labore et dolore magna
                                                            aliqua.Lorem
                                                            ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                            eiusmod
                                                            tempor incididunt ut labore et dolore magna aliqua.
                                                        </p>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                            do
                                                            eiusmod tempor incididunt ut labore et dolore magna
                                                            aliqua.Lorem
                                                            ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                            eiusmod
                                                            tempor incididunt ut labore et dolore magna aliqua.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="related">
                                                <div class="title-tab-content  text-center">
                                                    <div class="title-product justify-content-start">
                                                        <h2>Sản phẩm liên quan</h2>
                                                    </div>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="row">
                                                        @foreach ($relatedProducts as $product)
                                                            <div class="item text-center col-md-4">
                                                                @include('frontend.layout.product-info')
                                                            </div>
                                                        @endforeach
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
        </div>
    </div>
@endsection
