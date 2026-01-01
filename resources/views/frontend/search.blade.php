@extends('frontend.layout.master')

@section('title', 'Tìm kiếm')
@section('description', 'Kết quả tìm kiếm')
@section('keywords', 'Tìm kiếm')

@section('content')
@section('page-id', 'product-sidebar-left')
@section('page-class', 'product-grid-sidebar-left')
    <!-- main content -->
    <div class="main-content">
        <div id="wrapper-site">
            <div id="content-wrapper" class="full-width">
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
                                            <span>
                                                <span>Tìm kiếm</span>
                                            </span>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </nav>

                        <div class="container">
                            <div class="content" style="padding-top: 30px;">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="page-title mb-4">Kết quả tìm kiếm</h2>
                                        
                                        @if($keyword)
                                            <p class="mb-4 search-keyword">Từ khóa: <strong>"{{ $keyword }}"</strong></p>
                                        @endif

                                <!-- Kết quả sản phẩm -->
                                @if($products->count() > 0)
                                    <div class="mb-5">
                                        <h3 class="mb-3">
                                            <i class="fa fa-shopping-bag"></i> Sản phẩm ({{ $products->count() }})
                                        </h3>
                                        <div class="row">
                                            @foreach($products as $product)
                                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                    <div class="product-miniature">
                                                        <div class="thumbnail-container">
                                                            <a href="{{ route_product($product) }}">
                                                                @if($product->firstImage())
                                                                    <img src="{{ $product->firstImage()->image }}" alt="{{ $product->name }}" class="img-fluid">
                                                                @else
                                                                    <img src="{{ asset('assets/frontend/img/product/default.jpg') }}" alt="{{ $product->name }}" class="img-fluid">
                                                                @endif
                                                            </a>
                                                            @if($product->discount > 0)
                                                                <span class="discount-badge">-{{ $product->discount }}%</span>
                                                            @endif
                                                        </div>
                                                        <div class="product-description">
                                                            <h3 class="product-title">
                                                                <a href="{{ route_product($product) }}">{{ $product->name }}</a>
                                                            </h3>
                                                            <div class="product-price">
                                                                @if($product->discount > 0)
                                                                    <span class="price-old">{{ number_format($product->price) }}đ</span>
                                                                    <span class="price">{{ number_format($product->price * (1 - $product->discount/100)) }}đ</span>
                                                                @else
                                                                    <span class="price">{{ number_format($product->price) }}đ</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Kết quả bài viết -->
                                @if($posts->count() > 0)
                                    <div class="mb-5">
                                        <h3 class="mb-3">
                                            <i class="fa fa-newspaper-o"></i> Tin tức ({{ $posts->count() }})
                                        </h3>
                                        <div class="row">
                                            @foreach($posts as $post)
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <div class="blog-item">
                                                        <div class="blog-thumbnail">
                                                            <a href="{{ route('blog.detail', $post) }}">
                                                                @if($post->thumbnail && $post->thumbnail != '/storage/')
                                                                    <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="img-fluid">
                                                                @elseif($post->image)
                                                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                                                @else
                                                                    <img src="{{ asset('assets/frontend/img/blog/default.jpg') }}" alt="{{ $post->title }}" class="img-fluid">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="blog-content">
                                                            <h4 class="blog-title">
                                                                <a href="{{ route('blog.detail', $post) }}">{{ $post->title }}</a>
                                                            </h4>
                                                            <div class="blog-meta">
                                                                <span><i class="fa fa-calendar"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                                                                @if($post->postType)
                                                                    <span><i class="fa fa-tag"></i> {{ $post->postType->name }}</span>
                                                                @endif
                                                            </div>
                                                            <p class="blog-excerpt">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                                                            <a href="{{ route('blog.detail', $post) }}" class="btn btn-primary btn-sm">Đọc thêm</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Không tìm thấy kết quả -->
                                @if($products->count() == 0 && $posts->count() == 0)
                                    <div class="text-center py-5">
                                        <i class="fa fa-search" style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
                                        <h4>Không tìm thấy kết quả</h4>
                                        <p>Không có sản phẩm hoặc bài viết nào phù hợp với từ khóa "<strong>{{ $keyword }}</strong>"</p>
                                        <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Xem tất cả sản phẩm</a>
                                        <a href="{{ route('blog') }}" class="btn btn-secondary mt-3">Xem tất cả tin tức</a>
                                    </div>
                                @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Fix spacing để không bị chèn sát menu */
        .main-content {
            padding-top: 0;
        }
        .content {
            padding-top: 30px !important;
            padding-bottom: 30px;
        }
        .page-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            padding-top: 20px;
        }
        .search-keyword {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }
        .search-keyword strong {
            color: #0d6efd;
        }
        /* Section titles */
        .mb-5 h3 {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0d6efd;
        }
        .mb-5 h3 i {
            margin-right: 10px;
            color: #0d6efd;
        }
        /* Product cards */
        .product-miniature {
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #fff;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .product-miniature:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }
        .product-miniature .thumbnail-container {
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
        }
        .product-miniature .thumbnail-container img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .product-miniature:hover .thumbnail-container img {
            transform: scale(1.05);
        }
        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff4444;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            z-index: 1;
        }
        .product-description {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .product-title {
            margin: 0 0 10px 0;
            min-height: 40px;
        }
        .product-title a {
            color: #333;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-title a:hover {
            color: #0d6efd;
        }
        .product-price {
            margin-top: auto;
            padding-top: 10px;
        }
        .price-old {
            text-decoration: line-through;
            color: #999;
            margin-right: 10px;
            font-size: 14px;
        }
        .price {
            color: #ff4444;
            font-weight: bold;
            font-size: 18px;
        }
        
        /* Blog cards */
        .blog-item {
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #fff;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .blog-item:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }
        .blog-thumbnail {
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
        }
        .blog-thumbnail img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .blog-item:hover .blog-thumbnail img {
            transform: scale(1.05);
        }
        .blog-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .blog-title {
            margin: 0 0 15px 0;
            min-height: 50px;
        }
        .blog-title a {
            color: #333;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .blog-title a:hover {
            color: #0d6efd;
        }
        .blog-meta {
            margin: 0 0 15px 0;
            font-size: 13px;
            color: #999;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .blog-meta span {
            display: flex;
            align-items: center;
        }
        .blog-meta i {
            margin-right: 5px;
        }
        .blog-excerpt {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin: 0 0 15px 0;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* No results */
        .text-center.py-5 {
            padding: 60px 20px !important;
        }
        .text-center.py-5 i {
            display: block;
            margin-bottom: 20px;
        }
        .text-center.py-5 h4 {
            margin-bottom: 15px;
            color: #333;
        }
        .text-center.py-5 p {
            color: #666;
            margin-bottom: 25px;
        }
        .text-center.py-5 .btn {
            margin: 0 10px 10px 10px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 24px;
            }
            .mb-5 h3 {
                font-size: 20px;
            }
            .product-miniature .thumbnail-container img {
                height: 200px;
            }
            .blog-thumbnail img {
                height: 180px;
            }
        }
    </style>
@endsection

