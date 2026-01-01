@extends('frontend.layout.master')
@section('content')
@section('page-id', 'about')
@section('page-class', 'blog')

@php
    $page = \App\Models\Page::getPage('about');
@endphp

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
                                        <span>
                                            <span>Giới thiệu</span>
                                        </span>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </nav>
                    <div class="container">
                        <div class="content">
                            <div class="row">
                                <div class="col-sm-12 col-lg-12 col-md-12">
                                    <h1 class="title-page">{{$page->title}}</h1>
                                    @if($page->thumbnail)
                                    <div class="hover-after mb-4">
                                        <img src="{{asset('storage/' . $page->thumbnail)}}" alt="{{$page->title}}" class="img-fluid">
                                    </div>
                                    @endif
                                    <div class="late-item">
                                        {!! $page->content !!}
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



