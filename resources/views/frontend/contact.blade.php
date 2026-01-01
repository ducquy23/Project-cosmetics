@extends('frontend.layout.master')
@section('content')
@section('page-id', 'contact')
@section('page-class', 'blog')

@php
    $contactSettings = \App\Models\ContactSettings::getSettings();
    
    // Parse emails
    $emails = [];
    if ($contactSettings->emails) {
        $emailLines = explode("\n", $contactSettings->emails);
        foreach ($emailLines as $line) {
            $line = trim($line);
            if (!empty($line)) {
                $emails[] = $line;
            }
        }
    }
    
    // Parse hotlines
    $hotlines = [];
    if ($contactSettings->hotlines) {
        $hotlineLines = explode("\n", $contactSettings->hotlines);
        foreach ($hotlineLines as $line) {
            $line = trim($line);
            if (!empty($line)) {
                $hotlines[] = $line;
            }
        }
    }
@endphp

<div class="main-content">
    <div id="wrapper-site">
        <div id="content-wrapper">
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
                                    <span>Liên hệ</span>
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </nav>
            <div id="main">
                <div class="page-home">
                    <div class="container">
                        <h1 class="text-center title-page">Liên hệ chúng tôi</h1>
                        <div class="row-inhert">
                            <div class="header-contact">
                                <div class="row">
                                    @if(count($emails) > 0)
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="item d-flex">
                                            <div class="item-left">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-email"></i>
                                                </div>
                                            </div>
                                            <div class="item-right d-flex">
                                                <div class="title">Email:</div>
                                                <div class="contact-content">
                                                    @foreach($emails as $email)
                                                        <a href="mailto:{{$email}}">{{$email}}</a>
                                                        @if(!$loop->last)<br>@endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($contactSettings->address)
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="item d-flex">
                                            <div class="item-left">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-home"></i>
                                                </div>
                                            </div>
                                            <div class="item-right d-flex">
                                                <div class="title">Địa chỉ:</div>
                                                <div class="contact-content">
                                                    {!! nl2br(e($contactSettings->address)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(count($hotlines) > 0)
                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <div class="item d-flex justify-content-end  last">
                                            <div class="item-left">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-phone"></i>
                                                </div>
                                            </div>
                                            <div class="item-right d-flex">
                                                <div class="title">Hotline:</div>
                                                <div class="contact-content">
                                                    @foreach($hotlines as $hotline)
                                                        {{$hotline}}
                                                        @if(!$loop->last)<br>@endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @if($contactSettings->map_iframe)
                            <div class="contact-map">
                                <div id="map">
                                    {!! $contactSettings->map_iframe !!}
                                </div>
                            </div>
                            @endif
                            <div class="input-contact">
                                @if($contactSettings->intro_text)
                                <p class="text-intro text-center">{{$contactSettings->intro_text}}</p>
                                @else
                                <p class="text-intro text-center">"Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum
                                    auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit
                                    amet nibh vultate cursus a sit amet mauris. Proin gravida nibh vel velit auctor aliquet."
                                </p>
                                @endif
                                
                                <p class="icon text-center">
                                    <a href="#">
                                        <img src="/assets/frontend/img/other/contact_mess.png" alt="img">
                                    </a>
                                </p>

                                <div class="d-flex justify-content-center">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        @if(session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if(session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <ul class="mb-0">
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="contact-form">
                                            <form action="{{route('contact.submit')}}" method="post">
                                                @csrf
                                                <div class="form-fields">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <input class="form-control" name="name" placeholder="Họ tên" value="{{old('name')}}" required>
                                                            @error('name')
                                                                <small class="text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 margin-bottom-mobie">
                                                            <input class="form-control" name="from" type="email" value="{{old('from')}}" placeholder="Email" required>
                                                            @error('from')
                                                                <small class="text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <input class="form-control" name="phone" type="tel" placeholder="Số điện thoại" value="{{old('phone')}}" required>
                                                            @error('phone')
                                                                <small class="text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="message" placeholder="Nội dung" rows="8" required>{{old('message')}}</textarea>
                                                            @error('message')
                                                                <small class="text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button class="btn" type="submit" name="submitMessage">
                                                        <img class="img-fl" src="/assets/frontend/img/other/contact_email.png" alt="img">Gửi yêu cầu
                                                    </button>
                                                </div>
                                            </form>
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