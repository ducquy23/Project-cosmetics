@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="card-title fw-semibold mb-0">Cài đặt Liên hệ</h5>
                <a href="{{route('contact.messages')}}" class="btn btn-outline-primary">Xem tin nhắn liên hệ</a>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{route('contact.update')}}" method="POST">
                @csrf
                
                <hr>
                <h6 class="fw-semibold mb-3">Thông tin liên hệ</h6>

                <div class="mb-3">
                    <label for="emails" class="form-label">Email (mỗi dòng một email)</label>
                    <textarea class="form-control" name="emails" id="emails" rows="3" placeholder="support@domain.com&#10;contact@domain.com">{{old('emails', $contactSettings->emails)}}</textarea>
                    <small class="form-text text-muted">Nhập mỗi email trên một dòng riêng</small>
                    @error('emails')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <textarea class="form-control" name="address" id="address" rows="3">{{old('address', $contactSettings->address)}}</textarea>
                    @error('address')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hotlines" class="form-label">Hotline (mỗi dòng một số)</label>
                    <textarea class="form-control" name="hotlines" id="hotlines" rows="3" placeholder="0123-456-78910&#10;0987-654-32100">{{old('hotlines', $contactSettings->hotlines)}}</textarea>
                    <small class="form-text text-muted">Nhập mỗi số điện thoại trên một dòng riêng</small>
                    @error('hotlines')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Bản đồ</h6>

                <div class="mb-3">
                    <label for="map_iframe" class="form-label">Code iframe Google Maps</label>
                    <textarea class="form-control" name="map_iframe" id="map_iframe" rows="8" placeholder="&lt;iframe src=&quot;https://www.google.com/maps/embed?pb=...&quot; allowfullscreen&gt;&lt;/iframe&gt;">{{old('map_iframe', $contactSettings->map_iframe)}}</textarea>
                    <small class="form-text text-muted">
                        Dán toàn bộ code iframe từ Google Maps vào đây. 
                        <br>Hướng dẫn: Vào Google Maps → Chọn địa điểm → Chia sẻ → Nhúng bản đồ → Copy code iframe
                    </small>
                    @error('map_iframe')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Form liên hệ</h6>

                <div class="mb-3">
                    <label for="intro_text" class="form-label">Text giới thiệu trên form</label>
                    <textarea class="form-control" name="intro_text" id="intro_text" rows="3">{{old('intro_text', $contactSettings->intro_text)}}</textarea>
                    <small class="form-text text-muted">Text hiển thị phía trên form liên hệ</small>
                    @error('intro_text')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
            </form>
        </div>
    </div>
</div>
@endsection

