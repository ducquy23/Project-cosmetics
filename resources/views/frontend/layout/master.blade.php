<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @php
        $seoSettings = \App\Models\SeoSettings::getSettings();
        $menuItems = \App\Models\MenuItem::where('is_active', 1)->where('is_visible', 1)->orderBy('order')->get();
        $pageTitle = $seoSettings->meta_title ?? 'MH Cosmetics - Mỹ phẩm chính hãng';
        $pageDescription = $seoSettings->meta_description ?? 'MH Cosmetics - Mỹ phẩm chính hãng';
        $pageKeywords = $seoSettings->meta_keywords ?? 'MH Cosmetics, Cosmetics, Mỹ phẩm chính hãng';
        $ogImage = $seoSettings->og_image ? asset('storage/' . $seoSettings->og_image) : asset('assets/frontend/img/home/logo-black.png');
        $logo = $seoSettings->logo ? asset('storage/' . $seoSettings->logo) : asset('assets/frontend/img/home/logo-black.png');
        $logoMobile = $seoSettings->logo_mobile ? asset('storage/' . $seoSettings->logo_mobile) : asset('assets/frontend/img/home/logo-mobie.png');
    @endphp
    <title>@yield('title', $pageTitle)</title>

    <meta name="keywords" content="@yield('keywords', $pageKeywords)">
    <meta name="description" content="@yield('description', $pageDescription)">
    <meta name="author" content="{{$seoSettings->site_name ?? 'MH Cosmetics'}}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:title" content="@yield('title', $pageTitle)">
    <meta property="og:description" content="@yield('description', $pageDescription)">
    <meta property="og:image" content="@yield('og_image', $ogImage)">
    <meta property="og:site_name" content="{{$seoSettings->site_name ?? 'MH Cosmetics'}}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{url()->current()}}">
    <meta property="twitter:title" content="@yield('title', $pageTitle)">
    <meta property="twitter:description" content="@yield('description', $pageDescription)">
    <meta property="twitter:image" content="@yield('og_image', $ogImage)">

    @if($seoSettings->google_analytics_id)
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$seoSettings->google_analytics_id}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{$seoSettings->google_analytics_id}}');
    </script>
    @endif

    @if($seoSettings->google_search_console)
    <meta name="google-site-verification" content="{{$seoSettings->google_search_console}}" />
    @endif

    @if($seoSettings->custom_head_code)
    {!! $seoSettings->custom_head_code !!}
    @endif

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/assets/frontend/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/frontend/libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/frontend/libs/font-material/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="/assets/frontend/libs/nivo-slider/css/nivo-slider.css">
    <link rel="stylesheet" href="/assets/frontend/libs/nivo-slider/css/animate.css">
    <link rel="stylesheet" href="/assets/frontend/libs/nivo-slider/css/style.css">
    <link rel="stylesheet" href="/assets/frontend/libs/owl-carousel/assets/owl.carousel.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/frontend/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/frontend/css/reponsive.css">
    <style>
        .tab-content .item .product-miniature .product-description .product-buttons{
            bottom: 10px;
        }
        .product-title a{
            display: block;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        [class~=main-menu] [class~=menu] [class~=menu-top] li{
            padding: 0 15px !important;
        }
        /* Sticky header khi scroll */
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #fff;
            transition: all 0.3s ease;
        }
        header .header-top {
            background: #fff;
            transition: all 0.3s ease;
        }
        /* Thêm shadow khi scroll */
        body.scrolled header {
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        body.scrolled header .header-top {
            padding-top: 5px;
            padding-bottom: 5px;
        }
        /* Fix banner hiển thị cùng kích thước và đủ full hình ảnh */
        .nivoSlider {
            position: relative;
            width: 100%;
            height: 700px !important;
            overflow: hidden;
            background: #f5f5f5;
        }
        .nivoSlider img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: auto !important;
            height: 100% !important;
            max-width: 100% !important;
            object-fit: contain !important;
            object-position: center !important;
        }
        .nivoSlider a.nivo-imageLink {
            width: 100% !important;
            height: 100% !important;
            display: block;
        }
        .tiva-slideshow-wrapper {
            width: 100%;
            height: 700px !important;
            overflow: hidden;
            background: #f5f5f5;
        }
        .wrap-banner {
            width: 100%;
            height: 700px !important;
            overflow: hidden;
            background: #f5f5f5;
        }
        .section.banner {
            width: 100%;
            height: 700px !important;
            overflow: hidden;
            background: #f5f5f5;
        }
        /* Responsive cho banner */
        @media (max-width: 768px) {
            .nivoSlider,
            .tiva-slideshow-wrapper,
            .wrap-banner,
            .section.banner {
                height: 400px !important;
            }
        }
        @media (max-width: 480px) {
            .nivoSlider,
            .tiva-slideshow-wrapper,
            .wrap-banner,
            .section.banner {
                height: 300px !important;
            }
        }
        /* Fix menu active - chỉ hiển thị underline khi hover hoặc active */
        [class~=main-menu] [class~=menu] [class~=menu-top] > li > a:before,
        [class~=main-menu] [class~=menu] [class~=menu-top] > [class~=nav-link] > a:before {
            width: 0 !important;
            transition: width .3s ease;
        }
        [class~=main-menu] [class~=menu] [class~=menu-top] > li:hover > a:before,
        [class~=main-menu] [class~=menu] [class~=menu-top] > [class~=nav-link]:hover > a:before,
        [class~=main-menu] [class~=menu] [class~=menu-top] > li.active > a:before,
        [class~=main-menu] [class~=menu] [class~=menu-top] > [class~=nav-link].active > a:before {
            width: 50% !important;
        }
        .pagination{
            justify-content: center;
        }
        .page-item {
            padding: 3px;
            text-align: center;
        }
        .page-item .page-link{
            height: 35px !important;
            width: 35px !important;
            background: #c4c4c4;
            color:#fff;
            border-radius: 5px !important;
            padding: 0.5rem 0.75rem !important;
            position: relative;
            display: block;
            margin-left: -1px !important;
            line-height: 1.25 !important;
            margin-top: 0 !important;
        }
        .page-item.active .page-link {
            background-color: #343434;
            border-color: #343434;
            color: #fff;
        }
        .page-item.disabled .page-link{
            background: #c4c4c4;
            border-color: #c4c4c4;
            color: #fff;
        }
        .page-link:hover {
            z-index: 2;
            color: #fff;
            text-decoration: none;
            background-color: #343434;
            border-color: #343434;
        }
        [class~=main-menu] [class~=menu] [class~=menu-top] li:last-child {
            padding-right: 30px !important;
        }
        #search_widget {
            padding-left: 20px !important;
        }
        /* Mobile header styles */
        @media (max-width: 767px) {
            .header-mobile {
                padding: 0;
            }
            /* Logo row - riêng một hàng */
            .mobile-logo-row {
                padding: 10px 15px;
                text-align: center;
            }
            .mobile-logo {
                display: inline-block;
            }
            .mobile-logo img.logo-mobile {
                max-height: 30px !important;
                height: 50px !important;
                width: auto !important;
                object-fit: contain;
            }
            /* Menu, Search, Cart row - nằm ngang */
            .header-mobile .mobile {
                flex-wrap: nowrap !important;
                padding: 10px 15px;
                align-items: center;
                justify-content: space-between;
            }
            .mobile-menutop {
                flex-shrink: 0;
                font-size: 20px;
                cursor: pointer;
                width: 30px;
                text-align: center;
            }
            #mobile_search_content {
                flex: 1;
                max-width: 200px;
                margin: 0 10px;
            }
            #mobile_search_content form {
                display: flex;
                margin: 0;
                width: 100%;
            }
            #mobile_search_content input {
                flex: 1;
                padding: 6px 8px;
                font-size: 13px;
                border: 1px solid #ddd;
                border-radius: 4px 0 0 4px;
                min-width: 0;
            }
            #mobile_search_content button {
                padding: 6px 10px;
                flex-shrink: 0;
                border: 1px solid #ddd;
                border-left: none;
                border-radius: 0 4px 4px 0;
                background: #f5f5f5;
                cursor: pointer;
            }
            .header-mobile .desktop_cart {
                flex-shrink: 0;
            }
        }
    </style>
    @stack('css')
</head>



<body id="@yield('page-id', 'home')" class="@yield('page-class', '')">
    <header>
        <!-- header left mobie -->
        <div class="header-mobile d-md-none">
            <!-- Logo row -->
            <div class="mobile-logo-row text-center">
                <div class="mobile-logo">
                    <a href="/">
                        <img class="logo-mobile img-fluid" src="/assets/frontend/img/home/logo-mobie.png" alt="Logo">
                    </a>
                </div>
            </div>

            <!-- Menu, Search, Cart row -->
            <div class="mobile hidden-md-up text-xs-center d-flex align-items-center justify-content-around">
                <!-- menu -->
                <div class="mobile-menutop" data-target="#mobile-pagemenu">
                    <i class="fa fa-bars"></i>
                </div>

                <!-- search -->
                <div id="mobile_search_content">
                    <form method="get" action="{{route('shop')}}">
                        <input type="text" name="keyword" value="{{request('keyword')}}" placeholder="Tìm kiếm...">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- cart -->
                <div class="desktop_cart">
                    <div class="blockcart block-cart cart-preview tiva-toggle">
                        <div class="header-cart tiva-toggle-btn">
                            <span class="cart-products-count">{{session('cart') ? count(session('cart')) : 0}}</span>
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </div>
                        <div class="dropdown-content">
                            <div class="cart-content">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="product-image">
                                                <a href="product-detail.html">
                                                    <img src="/assets/frontend/img/product/5.jpg" alt="Product">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="product-name">
                                                    <a href="product-detail.html">Organic Strawberry Fruits</a>
                                                </div>
                                                <div>
                                                    2 x
                                                    <span class="product-price">£28.98</span>
                                                </div>
                                            </td>
                                            <td class="action">
                                                <a class="remove" href="#">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="total">
                                            <td colspan="2">Total:</td>
                                            <td>£92.96</td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" class="d-flex justify-content-center">
                                                <div class="cart-button">
                                                    <a href="{{route('cart')}}" title="View Cart">Giỏ hàng</a>
                                                    <a href="{{route('checkout')}}" title="Checkout">Thanh toán</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- header desktop -->
        <div class="header-top d-xs-none ">
            <div class="container">
                <div class="row">
                    <!-- logo -->
                    <div class="col-sm-2 col-md-2 d-flex align-items-center">
                        <div id="logo">
                            <a href="/">
                                <img class="img-fluid" src="{{$logo}}" alt="logo">
                            </a>
                        </div>
                    </div>

                    <!-- menu -->
                    <div class="main-menu col-sm-4 col-md-5 align-items-center justify-content-center navbar-expand-md">
                        <div class="menu navbar collapse navbar-collapse">
                            <ul class="menu-top navbar-nav">
                                @foreach($menuItems as $menu)
                                    @if($menu->is_active && $menu->is_visible)
                                        @php
                                            $isActive = false;
                                            if($menu->route) {
                                                $isActive = request()->routeIs($menu->route . '*') || request()->routeIs($menu->route);
                                            } elseif($menu->url) {
                                                $isActive = request()->is(trim($menu->url, '/')) || request()->fullUrl() === $menu->url;
                                            }
                                        @endphp
                                        <li class="{{$menu->route === 'category' || strtolower($menu->name) === 'danh mục' ? '' : 'nav-link'}} {{$isActive ? 'active' : ''}}">
                                            @if($menu->route === 'category' || strtolower($menu->name) === 'danh mục' || strtolower($menu->name) === 'danh mục sản phẩm')
                                                <a href="#" class="parent">{{$menu->name}}</a>
                                                <div class="dropdown-menu drop-tab">
                                                    <ul>
                                                        <li class="item container group">
                                                            <div class="dropdown-menu dropdown-tab">
                                                                <ul>
                                                                    @foreach ($categories as $category)
                                                                        <li class="item col-md-4 float-left">
                                                                            <span class="menu-title">{{$category->name}}</span>
                                                                            <div class="menu-content">
                                                                                <ul class="col">
                                                                                    @foreach ($category->children as $child_cate)
                                                                                        <li>
                                                                                            <a href="{{route('category', $child_cate)}}">{{$child_cate->name}}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @else
                                                <a href="{{$menu->route ? route($menu->route) : ($menu->url ?? '#')}}" class="parent">{{$menu->name}}</a>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- search-->
                    <div id="search_widget" class="col-sm-6 col-md-5 align-items-center justify-content-end d-flex">
                        <form method="get" action="{{route('search')}}">
                            <input type="text" name="keyword" value="{{request('keyword')}}" placeholder="Tìm kiếm sản phẩm, tin tức..." class="ui-autocomplete-input" autocomplete="off">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>

                        <!-- acount  -->
                        <div id="block_myaccount_infos" class="hidden-sm-down dropdown">
                            <div class="myaccount-title">
                                <a href="#acount" data-toggle="collapse" class="acount">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    @if (Auth::guard('web')->check())
                                        <span>{{Auth::guard('web')->user()->name}}</span>
                                    @else
                                        <span>Tài khoản</span>
                                    @endif

                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div id="acount" class="collapse">
                                <div class="account-list-content">
                                    @if (Auth::guard('web')->check())
                                        <div>
                                            <a href="{{route('account')}}" title="Tài khoản">
                                                <i class="fa fa-cog"></i>
                                                <span>Tài khoản</span>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{route('favorite')}}" title="My Wishlists">
                                                <i class="fa fa-heart"></i>
                                                <span>Yêu thích</span>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{route('account.change-password')}}" title="Dổi mật khẩu">
                                                <i class="fa fa-cog"></i>
                                                <span>Đổi mật khẩu</span>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{route('logout')}}" title="logout">
                                                <i class="fa fa-sign-out"></i>
                                                <span>Đăng xuất</span>
                                            </a>
                                        </div>
                                    @else
                                        <div>
                                            <a class="login" href="{{route('login')}}" rel="nofollow" title="Log in to your customer account">
                                                <i class="fa fa-sign-in"></i>
                                                <span>Đăng nhập</span>
                                            </a>
                                        </div>
                                        <div>
                                            <a class="register" href="{{route('register')}}" rel="nofollow" title="Register Account">
                                                <i class="fa fa-user"></i>
                                                <span>Đăng ký</span>
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="desktop_cart">
                            <div class="blockcart block-cart cart-preview tiva-toggle">
                                <div class="header-cart tiva-toggle-btn">
                                    <span class="cart-products-count">{{session('cart') ? count(session('cart')) : 0}}</span>
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </div>
                                <div class="dropdown-content">
                                    <div class="cart-content">
                                        @if (session('cart'))
                                            <table>
                                                <tbody>
                                                    @foreach (session('cart') as $cart)
                                                        <tr>
                                                            <td class="product-image">
                                                                <a href="{{route_product($cart['slug'] ?? $cart['product_id'])}}">
                                                                    <img src="{{$cart['image']}}" alt="Product">
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="product-name">
                                                                    <a href="{{route_product($cart['slug'] ?? $cart['product_id'])}}">{{$cart['name']}}</a>
                                                                </div>
                                                                <div>
                                                                    {{$cart['quantity']}} x
                                                                    <span class="product-price">{{convertPrice($cart['price'])}}</span>
                                                                </div>
                                                            </td>
                                                            <td class="action">
                                                                <a class="remove" href="{{route('cart.decrease', $cart['product_id'])}}">
                                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="total">
                                                        <td colspan="2">Tổng tiền:</td>
                                                        <td>{{convertPrice(session('total_price')) ?? 0}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3" class="d-flex justify-content-center">
                                                            <div class="cart-button">
                                                                <a href="{{route('cart')}}" title="View Cart">Giỏ hàng</a>
                                                                <a href="{{route('checkout')}}" title="Checkout">Thanh toán</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="text-center p-3">
                                                <span>Không có sản phẩm nào!</span>
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
    </header>

    @yield('content')

    <!-- footer -->
    @php
        $footerSettings = \App\Models\FooterSettings::getSettings();
        // Parse navigation links
        $navLinks = [];
        if ($footerSettings->navigation_links) {
            $lines = explode("\n", $footerSettings->navigation_links);
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $parts = explode('|', $line, 2);
                    if (count($parts) == 2) {
                        $navLinks[] = [
                            'name' => trim($parts[0]),
                            'url' => trim($parts[1])
                        ];
                    }
                }
            }
        }
    @endphp
    <footer class="footer-one">
        <div class="inner-footer">
            <div class="container">
                <div class="footer-top col-lg-12 col-xs-12">
                    <div class="row">
                        <div class="tiva-html col-lg-4 col-md-12 col-xs-12">
                            <div class="block">
                                <div class="block-content">
                                    <p class="logo-footer" style="margin-bottom: 20px;">
                                        <img src="{{$footerSettings->company_logo ? asset('storage/' . $footerSettings->company_logo) : '/assets/frontend/img/home/logo-black.png'}}" alt="{{$footerSettings->company_name ?? 'Logo'}}" style="max-width: 100%; height: auto; width: auto; max-height: 80px;">
                                    </p>
                                    @if($footerSettings->company_description)
                                    <p class="content-logo">{{$footerSettings->company_description}}</p>
                                    @else
                                    <p class="content-logo">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt
                                        ut labore et dolore magna aliqua. Ut enim ad minim
                                    </p>
                                    @endif
                                </div>
                            </div>
                            @if(count($navLinks) > 0)
                            <div class="block">
                                <div class="block-content">
                                    <ul>
                                        @foreach($navLinks as $link)
                                        <li>
                                            <a href="{{$link['url']}}">{{$link['name']}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="tiva-html col-lg-4 col-md-6">
                            <div class="block m-top">
                                <div class="title-block">
                                    {{ $footerSettings->contact_title ?? 'Contact Us' }}
                                </div>
                                <div class="block-content">
                                    @if($footerSettings->address)
                                    <div class="contact-us">
                                        <div class="title-content">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>{{ $footerSettings->address_label ?? 'Address' }} :</span>
                                        </div>
                                        <div class="content-contact address-contact">
                                            <p>{{$footerSettings->address}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($footerSettings->email)
                                    <div class="contact-us">
                                        <div class="title-content">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <span>{{ $footerSettings->email_label ?? 'Email' }} :</span>
                                        </div>
                                        <div class="content-contact mail-contact">
                                            <p>{{$footerSettings->email}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($footerSettings->hotline)
                                    <div class="contact-us">
                                        <div class="title-content">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <span>{{ $footerSettings->hotline_label ?? 'Hotline' }} :</span>
                                        </div>
                                        <div class="content-contact phone-contact">
                                            <p>{{$footerSettings->hotline}}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($footerSettings->opening_hours)
                                    <div class="contact-us">
                                        <div class="title-content">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            <span>{{ $footerSettings->opening_hours_label ?? 'Opening Hours' }} :</span>
                                        </div>
                                        <div class="content-contact hours-contact">
                                            <p>{{$footerSettings->opening_hours}}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tiva-modules col-lg-4 col-md-6">
                            @if($footerSettings->map_embed_code)
                            <div class="block m-top">
                                <div class="block-content">
                                    <div class="map-embed" style="width: 100%; height: 300px; overflow: hidden; border-radius: 5px;">
                                        {!! $footerSettings->map_embed_code !!}
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="block m-top">
                                <div class="block-content">
                                    <div class="title-block">Newsletter</div>
                                    @if($footerSettings->newsletter_description)
                                    <div class="sub-title">{{$footerSettings->newsletter_description}}</div>
                                    @else
                                    <div class="sub-title">Sign up to our newsletter to get the latest articles, lookbooks voucher codes direct
                                        to your inbox
                                    </div>
                                    @endif
                                    <div class="block-newsletter">
                                        <form action="#" method="post">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="email" value="" placeholder="Enter Your Email">
                                                <span class="input-group-btn">
                                                    <button class="effect-btn btn btn-secondary " name="submitNewsletter" type="submit">
                                                        <span>subscribe</span>
                                                    </button>
                                                </span>
                                            </div>
                                            <input type="hidden" name="action" value="0">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($footerSettings->facebook_url || $footerSettings->twitter_url || $footerSettings->google_url || $footerSettings->instagram_url)
                            <div class="block m-top1">
                                <div class="block-content">
                                    <div class="social-content">
                                        <div class="title-block">
                                            Follow us on
                                        </div>
                                        <div id="social-block">
                                            <div class="social">
                                                <ul class="list-inline mb-0 justify-content-end">
                                                    @if($footerSettings->facebook_url)
                                                    <li class="list-inline-item mb-0">
                                                        <a href="{{$footerSettings->facebook_url}}" target="_blank">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if($footerSettings->twitter_url)
                                                    <li class="list-inline-item mb-0">
                                                        <a href="{{$footerSettings->twitter_url}}" target="_blank">
                                                            <i class="fa fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if($footerSettings->google_url)
                                                    <li class="list-inline-item mb-0">
                                                        <a href="{{$footerSettings->google_url}}" target="_blank">
                                                            <i class="fa fa-google"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if($footerSettings->instagram_url)
                                                    <li class="list-inline-item mb-0">
                                                        <a href="{{$footerSettings->instagram_url}}" target="_blank">
                                                            <i class="fa fa-instagram"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @php
                                $paymentImages = json_decode($footerSettings->payment_images ?? '[]', true);
                            @endphp
                            @if(!empty($paymentImages))
                            <div class="block m-top1">
                                <div class="block-content">
                                    <div class="payment-content">
                                        <div class="title-block">
                                            Payment accept
                                        </div>
                                        <div class="payment-images d-flex flex-wrap gap-2 align-items-center">
                                            @foreach($paymentImages as $img)
                                                <img class="img-fluid" src="{{asset('storage/' . $img)}}" alt="Payment Method" style="max-height: 40px; width: auto;">
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- Popup newsletter -->
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tiva-copyright">
            <div class="container">
                <div class="row">
                    <div class="text-center col-lg-12 ">
                        <span>
                            @if($footerSettings->copyright_text)
                                {!! $footerSettings->copyright_text !!}
                            @else
                                <a target="_blank" href="https://www.templateshub.net">Templates Hub</a>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- back top top -->
    <div class="back-to-top">
        <a href="#">
            <i class="fa fa-long-arrow-up"></i>
        </a>
    </div>

    <!-- menu mobie right -->
    <div id="mobile-pagemenu" class="mobile-boxpage d-flex hidden-md-up active d-md-none">
        <div class="content-boxpage col">
            <div class="box-header d-flex justify-content-between align-items-center">
                <div class="title-box">Menu</div>
                <div class="close-box">Close</div>
            </div>
            <div class="box-content">
                <nav>
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div id="megamenu" class="clearfix">
                        <ul class="menu level1">
                            <li class="item home-page">
                                <a href="/" title="Trang chủ">
                                    <i class="fa fa-home" aria-hidden="true"></i>Trang chủ</a>
                            </li>
                            <li class="item">
                                <a href="{{route('shop')}}" title="Cửa hàng">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>Cửa hàng</a>
                            </li>
                            @if(count($categories) > 0)
                            <li class="item group has-sub">
                                <span class="arrow collapsed" data-toggle="collapse" data-target="#categories-mobile" aria-expanded="false" role="status">
                                    <i class="zmdi zmdi-minus"></i>
                                    <i class="zmdi zmdi-plus"></i>
                                </span>
                                <a href="#" title="Danh mục">
                                    <i class="fa fa-list" aria-hidden="true"></i>Danh mục</a>
                                <div class="subCategory collapse" id="categories-mobile" aria-expanded="false" role="status">
                                    <ul class="group-page">
                                        <li class="item container group">
                                            <div>
                                                <ul>
                                                    @foreach($categories as $category)
                                                    <li class="item col-md-12">
                                                        <span class="menu-title">{{$category->name}}</span>
                                                        @if($category->children->count() > 0)
                                                        <div class="menu-content">
                                                            <ul class="col">
                                                                @foreach($category->children as $child_cate)
                                                                <li>
                                                                    <a href="{{route('category', $child_cate)}}">{{$child_cate->name}}</a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif
                            <li class="item">
                                <a href="{{route('blog')}}" title="Tin tức">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>Tin tức</a>
                            </li>
                            <li class="item">
                                <a href="{{route('about')}}" title="Giới thiệu">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>Giới thiệu</a>
                            </li>
                            <li class="item">
                                <a href="{{route('contact')}}" title="Liên hệ">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- Page Loader -->
    <div id="page-preloader">
        <div class="page-loading">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat"></div>

    <script>
        try {
            var chatbox = document.getElementById('fb-customer-chat');
            if (chatbox) {
                chatbox.setAttribute("page_id", "184655318071837");
                chatbox.setAttribute("attribution", "biz_inbox");
            }
        } catch (e) {
            console.warn('Facebook chatbox initialization error:', e);
        }
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            try {
                if (typeof FB !== 'undefined') {
                    FB.init({
                        xfbml: true,
                        version: 'v18.0'
                    });
                }
            } catch (e) {
                console.warn('Facebook SDK initialization error:', e);
            }
        };

        (function(d, s, id) {
            try {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                js.onerror = function() {
                    console.warn('Failed to load Facebook SDK');
                };
                if (fjs && fjs.parentNode) {
                    fjs.parentNode.insertBefore(js, fjs);
                }
            } catch (e) {
                console.warn('Facebook SDK script loading error:', e);
            }
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vendor JS -->
    <script src="/assets/frontend/libs/jquery/jquery.min.js"></script>
    <script src="/assets/frontend/libs/popper/popper.min.js"></script>
    <script src="/assets/frontend/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/frontend/libs/nivo-slider/js/jquery.nivo.slider.js"></script>
    <script src="/assets/frontend/libs/owl-carousel/owl.carousel.min.js"></script>

    <!-- Template JS -->
    <script src="/assets/frontend/js/theme.js"></script>
    <script src="/assets/frontend/js/my_script.js"></script>
    @stack('script')

    <script>
        try {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.body.classList.add('scrolled');
                } else {
                    document.body.classList.remove('scrolled');
                }
            });
        } catch (e) {
            console.warn('Scroll event handler error:', e);
        }
    </script>

    <!-- Global error handler for JSON parse errors -->
    <script>
        // Prevent uncaught JSON parse errors from breaking the page
        window.addEventListener('error', function(e) {
            if (e.message && e.message.includes('JSON')) {
                console.warn('JSON parsing error caught:', e.message);
                e.preventDefault();
                return true;
            }
        }, true);

        // Handle unhandled promise rejections
        window.addEventListener('unhandledrejection', function(e) {
            if (e.reason && (e.reason.message && e.reason.message.includes('JSON') ||
                e.reason.message && e.reason.message.includes('undefined'))) {
                console.warn('Unhandled promise rejection caught:', e.reason);
                e.preventDefault();
            }
        });
    </script>

    @php
        $seoSettings = \App\Models\SeoSettings::getSettings();
    @endphp

    @if($seoSettings->facebook_pixel)
    <!-- Facebook Pixel Code -->
    {!! $seoSettings->facebook_pixel !!}
    @endif

    @if($seoSettings->custom_body_code)
    <!-- Custom Body Code -->
    {!! $seoSettings->custom_body_code !!}
    @endif
</body>
</html>
