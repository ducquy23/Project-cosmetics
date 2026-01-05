@extends('frontend.layout.master')
@section('content')
    @push('css')
        <style>
            .thumbnail-container a .img-fluid{
                background: #fff;
            }
            #home [class~=main-menu]{
                padding-left: 0;
            }
        </style>
    @endpush
    <!-- main content -->
    <div class="main-content">
        <div class="wrap-banner">
            <!-- slide show -->
            <div class="section banner">
                <div class="tiva-slideshow-wrapper">
                    <div id="tiva-slideshow" class="nivoSlider">
                        @forelse($slides as $index => $slide)
                            <a href="{{$slide->link ?? '#'}}">
                                <img class="img-responsive"
                                     src="{{asset('storage/' . $slide->image)}}"
                                     title="#caption{{$index + 1}}"
                                     alt="{{$slide->title ?? 'Slideshow image'}}">
                            </a>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- main -->
        <div id="wrapper-site">
            <div id="content-wrapper" class="full-width">
                <div id="main">
                    <section class="page-home">
                        <div class="container">
                            <!-- delivery form -->
                            <div class="section policy-home col-lg-12 col-xs-12">
                                <div class="row">
                                    @forelse($policyBlocks as $index => $block)
                                        <div class="col-lg-4 col-md-4">
                                            <div class="block">
                                                <div class="block-content">
                                                    <div class="policy-item">
                                                        @if($block->link)
                                                            <a href="{{$block->link}}" style="text-decoration: none; color: inherit;">
                                                                @endif
                                                                <div class="policy-content iconpolicy{{$index + 1}}">
                                                                    @if($block->image)
                                                                        @if(str_starts_with($block->image, '/assets/'))
                                                                            <img src="{{$block->image}}" alt="{{$block->title}}">
                                                                        @else
                                                                            <img src="{{asset('storage/' . $block->image)}}" alt="{{$block->title}}">
                                                                        @endif
                                                                    @endif
                                                                    <div class="policy-name mb-5">{{$block->title}}</div>
                                                                    <div class="policy-des">{{$block->description}}</div>
                                                                </div>
                                                                @if($block->link)
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-4 col-md-4">
                                            <div class="block">
                                                <div class="block-content">
                                                    <div class="policy-item">
                                                        <div class="policy-content iconpolicy1">
                                                            <img src="/assets/frontend/img/home/home1-policy.png" alt="img">
                                                            <div class="policy-name mb-5">Miễn phí vận chuyển từ 499,000đ</div>
                                                            <div class="policy-des">Lorem ipsum dolor amet consectetur</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tiva-html col-lg-4 col-md-4">
                                            <div class="block">
                                                <div class="block-content">
                                                    <div class="policy-item">
                                                        <div class="policy-content iconpolicy2">
                                                            <img src="/assets/frontend/img/home/home1-policy2.png" alt="img">
                                                            <div class="policy-name mb-5">Cam kết hàng chính hãng</div>
                                                            <div class="policy-des">Lorem ipsum dolor amet consectetur</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tiva-html col-lg-4 col-md-4">
                                            <div class="block">
                                                <div class="block-content">
                                                    <div class="policy-item">
                                                        <div class="policy-content iconpolicy3">
                                                            <img src="/assets/frontend/img/home/home1-policy3.png" alt="img">
                                                            <div class="policy-name mb-5">Đảm bảo hoàn tiền</div>
                                                            <div class="policy-des">Lorem ipsum dolor amet consectetur</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>


                        <!-- product living room -->
                        <div class="section living-room">
                            <div class="container">
                                <div class="tiva-row-wrap row">
                                    <div class="groupcategoriestab-vertical col-md-12 col-xs-12">
                                        <div class="grouptab row">
                                            <div class="categoriestab-left product-tab col-md-12 flex-9">
                                                <div class="title-tab-content d-flex justify-content-start">
                                                    <h2 class="title-block">Sản phẩm giảm giá</h2>
                                                </div>
                                                <div class="tab-content">
                                                    <div id="new" class="tab-pane fade in active show">
                                                        <div class="saleoff-product-index owl-carousel owl-theme owl-loaded owl-drag">
                                                            @foreach($discountProducts as $product)
                                                                @if($product && $product->id)
                                                                    <div class="item text-center">
                                                                        @include('frontend.layout.product-info')
                                                                    </div>
                                                                @endif
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

                        <div class="container">
                            <!-- banner -->
                            <div class="section spacing-10 group-image-special col-lg-12 col-xs-12">
                                <div class="row">
                                    @forelse($bannerSections as $banner)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="effect">
                                                <a href="{{$banner->link ?? '#'}}">
                                                    @if($banner->image)
                                                        @if(str_starts_with($banner->image, '/assets/'))
                                                            <img class="img-fluid" src="{{$banner->image}}" alt="{{$banner->title}}" title="{{$banner->title}}">
                                                        @else
                                                            <img class="img-fluid" src="{{asset('storage/' . $banner->image)}}" alt="{{$banner->title}}" title="{{$banner->title}}">
                                                        @endif
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-6 col-md-6">
                                            <div class="effect">
                                                <a href="#">
                                                    <img class="img-fluid" src="/assets/frontend/img/home/effect1.jpg" alt="banner-1" title="banner-1">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="effect">
                                                <a href="#">
                                                    <img class="img-fluid" src="/assets/frontend/img/home/effect2.jpg" alt="banner-2" title="banner-2">
                                                </a>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- best seller -->
                            <div class="section best-sellers col-lg-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="groupproductlist">
                                            <div class="row d-flex align-items-center">
                                                <!-- column 4 -->
                                                <div class="flex-4 col-lg-4 flex-4">
                                                    <h2 class="title-block">
                                                        <span class="sub-title">{{ $bestSellingContent->title ?? 'Sản phẩm bán chạy' }}</span>{{ $bestSellingContent->description ?? 'Bán chạy' }}
                                                    </h2>
                                                    <div class="content-text">
                                                        <p>{{ $bestSellingContent->settings['content'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.' }}</p>
                                                        <div>
                                                            <a href="{{ $bestSellingContent->link ?? route('shop') }}">{{ $bestSellingContent->settings['link_text'] ?? 'Tất cả sản phẩm' }}</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- column 8 -->
                                                <div class="block-content col-lg-8 flex-8">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade in active show">
                                                            <div class="category-product-index owl-carousel owl-theme owl-loaded owl-drag">
                                                                @foreach ($topSellingProducts as $index=>$product)
                                                                    @if($product && $product->id)
                                                                        @if ($index % 2 == 0)
                                                                            <div class="item text-center">
                                                                                @endif
                                                                                @include('frontend.layout.product-info')
                                                                                @if ($index % 2 != 0 || $index == count($topSellingProducts) - 1)
                                                                            </div>
                                                                        @endif
                                                                    @endif
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

                        <!-- product kitchen -->
                        @if($categories->isNotEmpty() && $categories->first())
                            <div class="section kitchen">
                                <div class="living-room">
                                    <div class="container">
                                        <div class="tiva-row-wrap row">
                                            <div class="groupcategoriestab-vertical col-md-12 col-xs-12">
                                                <div class="grouptab row">
                                                    <div class="categoriestab-left product-tab col-md-12 flex-9">
                                                        <h2 class="title-block">{{$categories->first()->name}}</h2>
                                                        <div class="title-tab-content d-flex justify-content-start">
                                                            <ul class="nav nav-tabs">
                                                                @foreach ($categories->first()->children->take(5) as $key=>$child_cate)
                                                                    <li>
                                                                        <a href="#cate-{{$child_cate->id}}" data-toggle="tab"
                                                                           class="{{$key==0 ? 'active' : ''}}">{{$child_cate->name}}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content">
                                                            @foreach ($categories->first()->children->take(5) as $key=>$child_cate)
                                                                <div id="cate-{{$child_cate->id}}" class="tab-pane fade {{$key==0 ? 'in active show' : ''}}">
                                                                    <div class="category-product-index owl-carousel owl-theme owl-loaded owl-drag">
                                                                        @foreach($child_cate->products as $product)
                                                                            @if($product && $product->id)
                                                                                <div class="item text-center">
                                                                                    @include('frontend.layout.product-info')
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
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
                        @endif

                        <!-- banner -->
                        <div class="container">
                            <div class="section spacing-10 group-image-special col-lg-12 col-xs-12">
                                <div class="row">
                                    @forelse($bannerBottomSections as $banner)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="effect">
                                                <a href="{{$banner->link ?? '#'}}">
                                                    @if($banner->image)
                                                        @if(str_starts_with($banner->image, '/assets/'))
                                                            <img class="img-fluid" src="{{$banner->image}}" alt="{{$banner->title}}" title="{{$banner->title}}">
                                                        @else
                                                            <img class="img-fluid" src="{{asset('storage/' . $banner->image)}}" alt="{{$banner->title}}" title="{{$banner->title}}">
                                                        @endif
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-6 col-md-6">
                                            <div class="effect">
                                                <a href="#">
                                                    <img class="img-fluid" src="/assets/frontend/img/home/effect3.jpg" alt="banner-1" title="banner-1">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="effect">
                                                <a href="#">
                                                    <img class="img-fluid" src="/assets/frontend/img/home/effect4.jpg" alt="banner-2" title="banner-2">
                                                </a>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- testimonial -->
                            <div class="section testimonial-block col-lg-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="block">
                                            <!-- Testimonials Carousel -->
                                            <div class="owl-carousel owl-theme testimonial-type-one">
                                                @forelse($testimonials as $testimonial)
                                                    <div class="item">
                                                        <div class="testimonial-card" style="background: #f8f9fa; border-radius: 10px; padding: 30px; position: relative; margin-top: 50px;">
                                                            <!-- Quote Icons -->
                                                            <i class="fa fa-quote-left" style="position: absolute; top: 20px; left: 20px; font-size: 40px; color: #28a745; opacity: 0.3;"></i>
                                                            <i class="fa fa-quote-right" style="position: absolute; bottom: 20px; right: 20px; font-size: 40px; color: #28a745; opacity: 0.3;"></i>

                                                            <!-- Profile Image -->
                                                            <div class="testimonial-profile-img" style="text-align: center; margin: 20px auto; position: relative; z-index: 1;">
                                                                @if($testimonial->image)
                                                                    @if(str_starts_with($testimonial->image, '/assets/'))
                                                                        <img src="{{ $testimonial->image }}" alt="{{ $testimonial->title }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: block; margin: 0 auto;">
                                                                    @else
                                                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->title }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: block; margin: 0 auto;">
                                                                    @endif
                                                                @else
                                                                    <div style="width: 100px; height: 100px; border-radius: 50%; background: #ddd; margin: 0 auto; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);"></div>
                                                                @endif
                                                            </div>

                                                            <!-- Review Content -->
                                                            <div class="testimonial-content" style="text-align: center; margin-bottom: 15px;">
                                                                <p style="color: #333; font-size: 14px; line-height: 1.6; margin: 0;">
                                                                    {{ $testimonial->settings['content'] ?? '' }}
                                                                </p>
                                                            </div>

                                                            <!-- Rating Stars -->
                                                            <div class="testimonial-rating" style="text-align: center; margin-bottom: 15px;">
                                                                @php
                                                                    $rating = $testimonial->settings['rating'] ?? 5;
                                                                @endphp
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i class="fa fa-star" style="color: #28a745; font-size: 16px; {{ $i <= $rating ? '' : 'opacity: 0.3;' }}"></i>
                                                                @endfor
                                                            </div>

                                                            <!-- Reviewer Info -->
                                                            <div class="testimonial-info" style="text-align: center;">
                                                                <h5 style="font-weight: bold; color: #000; margin: 0 0 5px 0; font-size: 16px;">{{ $testimonial->title ?? '' }}</h5>
                                                                <p style="color: #666; font-size: 14px; margin: 0;">{{ $testimonial->settings['position'] ?? '' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="item">
                                                        <div class="testimonial-card" style="background: #f8f9fa; border-radius: 10px; padding: 30px; position: relative;">
                                                            <i class="fa fa-quote-left" style="position: absolute; top: 20px; left: 20px; font-size: 40px; color: #28a745; opacity: 0.3;"></i>
                                                            <i class="fa fa-quote-right" style="position: absolute; bottom: 20px; right: 20px; font-size: 40px; color: #28a745; opacity: 0.3;"></i>
                                                            <div class="testimonial-profile-img" style="text-align: center; margin: 20px auto; position: relative; z-index: 1;">
                                                                <div style="width: 100px; height: 100px; border-radius: 50%; background: #ddd; margin: 0 auto; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);"></div>
                                                            </div>
                                                            <div class="testimonial-content" style="text-align: center; margin-bottom: 15px;">
                                                                <p style="color: #333; font-size: 14px; line-height: 1.6; margin: 0;">
                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis blanditiis excepturi quisquam temporibus voluptatum reprehenderit culpa, quasi corrupti laborum accusamus.
                                                                </p>
                                                            </div>
                                                            <div class="testimonial-rating" style="text-align: center; margin-bottom: 15px;">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i class="fa fa-star" style="color: #28a745; font-size: 16px;"></i>
                                                                @endfor
                                                            </div>
                                                            <div class="testimonial-info" style="text-align: center;">
                                                                <h5 style="font-weight: bold; color: #000; margin: 0 0 5px 0; font-size: 16px;">Person Name</h5>
                                                                <p style="color: #666; font-size: 14px; margin: 0;">Profession</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- product kitchen -->
                        @if($categories->count() > 1 && $categories->skip(1)->first())
                            <div class="section kitchen">
                                <div class="living-room">
                                    <div class="container">
                                        <div class="tiva-row-wrap row">
                                            <div class="groupcategoriestab-vertical col-md-12 col-xs-12">
                                                <div class="grouptab row">
                                                    <div class="categoriestab-left product-tab col-md-12 flex-9">
                                                        <h2 class="title-block">{{$categories->skip(1)->first()->name}}</h2>
                                                        <div class="title-tab-content d-flex justify-content-start">
                                                            <ul class="nav nav-tabs">
                                                                @foreach ($categories->skip(1)->first()->children->take(5) as $key=>$child_cate)
                                                                    <li>
                                                                        <a href="#cate-{{$child_cate->id}}" data-toggle="tab"
                                                                           class="{{$key==0 ? 'active' : ''}}">{{$child_cate->name}}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content">
                                                            @foreach ($categories->skip(1)->first()->children->take(5) as $key=>$child_cate)
                                                                <div id="cate-{{$child_cate->id}}" class="tab-pane fade {{$key==0 ? 'in active show' : ''}}">
                                                                    <div class="category-product-index owl-carousel owl-theme owl-loaded owl-drag">
                                                                        @foreach($child_cate->products as $product)
                                                                            @if($product && $product->id)
                                                                                <div class="item text-center">
                                                                                    @include('frontend.layout.product-info')
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
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
                        @endif

                        <!-- recent posts -->
                        <div class="container">
                            <div class="section recent-post">
                                <div class="title-block">Tin tức và sự kiện</div>
                                <div class="row">
                                    @foreach ($newPosts as $post)
                                        <div class="col-md-4">
                                            <div class="item-post">
                                                <div class="thumbnail-img">
                                                    <a href="{{route_blog_detail($post)}}">
                                                        <img src="{{$post->thumbnail}}" alt="img" width="100%">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="post-info">
                                                    <span class="comment">
                                                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                                                        <span>{{$post->view}} lượt xem</span>
                                                    </span>
                                                        <span class="datetime">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        <span>{{date_format($post->created_at, 'd/m/Y')}}</span>
                                                    </span>
                                                    </div>
                                                    <div class="post-title">
                                                        <a href="{{route_blog_detail($post)}}">{{$post->title}}</a>
                                                    </div>
                                                    <div class="post-desc">
                                                        {{$post->shortContent($post->content)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- partner -->
                            <div class="section introduct-logo">
                                <div class="row">
                                    <div class="tiva-manufacture  col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="block">
                                            <div id="manufacture" class="owl-carousel owl-theme owl-loaded owl-drag">
                                                @forelse($partnerLogos as $logo)
                                                    <div class="item">
                                                        <div class="logo-manu">
                                                            <a href="{{ $logo->link ?? '#' }}" title="{{ $logo->title ?? 'view products' }}">
                                                                @if($logo->image)
                                                                    @if(str_starts_with($logo->image, '/assets/'))
                                                                        <img class="img-fluid" src="{{ $logo->image }}" alt="{{ $logo->title ?? 'logo' }}" />
                                                                    @else
                                                                        <img class="img-fluid" src="{{ asset('storage/' . $logo->image) }}" alt="{{ $logo->title ?? 'logo' }}" />
                                                                    @endif
                                                                @else
                                                                    <img class="img-fluid" src="/assets/frontend/img/home/icon-logo1.jpg" alt="logo" />
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="item">
                                                        <div class="logo-manu">
                                                            <a href="#" title="view products">
                                                                <img class="img-fluid" src="/assets/frontend/img/home/icon-logo1.jpg" alt="img" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('.saleoff-product-index',).owlCarousel({
            loop:true,
            margin:20,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            },
            navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
        })

        $('.category-product-index',).owlCarousel({
            loop:true,
            margin:20,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            },
            navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
        })
    </script>
@endpush
