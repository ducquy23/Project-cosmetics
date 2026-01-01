@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Quản lý Footer</h5>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{route('footer.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <hr>
                <h6 class="fw-semibold mb-3">Thông tin công ty</h6>

                <div class="mb-3">
                    <label for="company_name" class="form-label">Tên công ty</label>
                    <input type="text" class="form-control" name="company_name" id="company_name" value="{{old('company_name', $footerSettings->company_name)}}">
                    @error('company_name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="company_logo" class="form-label">Logo công ty (Sẽ được phóng to để vừa khung)</label>
                    <input type="file" class="form-control" name="company_logo" id="company_logo" accept="image/*">
                    @if($footerSettings->company_logo)
                        <div class="mt-2">
                            <p class="text-muted">Logo hiện tại:</p>
                            <img src="{{asset('storage/' . $footerSettings->company_logo)}}" alt="Company Logo" class="rounded-1" style="max-width: 300px;">
                        </div>
                    @endif
                    @error('company_logo')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="company_description" class="form-label">Mô tả công ty</label>
                    <textarea class="form-control" name="company_description" id="company_description" rows="3">{{old('company_description', $footerSettings->company_description)}}</textarea>
                    @error('company_description')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="navigation_links" class="form-label">Links điều hướng (mỗi dòng một link, format: Tên Link|URL)</label>
                    <textarea class="form-control" name="navigation_links" id="navigation_links" rows="5" placeholder="About Us|#&#10;Reasons to shop|#&#10;What our customers say|#">{{old('navigation_links', $footerSettings->navigation_links)}}</textarea>
                    <small class="form-text text-muted">Ví dụ: About Us|/about-us</small>
                    @error('navigation_links')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Thông tin liên hệ</h6>

                <div class="mb-3">
                    <label for="contact_title" class="form-label">Tiêu đề phần liên hệ</label>
                    <input type="text" class="form-control" name="contact_title" id="contact_title" value="{{old('contact_title', $footerSettings->contact_title ?? 'Contact Us')}}" placeholder="Contact Us">
                    @error('contact_title')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address_label" class="form-label">Nhãn Địa chỉ</label>
                    <input type="text" class="form-control" name="address_label" id="address_label" value="{{old('address_label', $footerSettings->address_label ?? 'Address')}}" placeholder="Address">
                    @error('address_label')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <textarea class="form-control" name="address" id="address" rows="2">{{old('address', $footerSettings->address)}}</textarea>
                    @error('address')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email_label" class="form-label">Nhãn Email</label>
                    <input type="text" class="form-control" name="email_label" id="email_label" value="{{old('email_label', $footerSettings->email_label ?? 'Email')}}" placeholder="Email">
                    @error('email_label')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email', $footerSettings->email)}}">
                    @error('email')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hotline_label" class="form-label">Nhãn Hotline</label>
                    <input type="text" class="form-control" name="hotline_label" id="hotline_label" value="{{old('hotline_label', $footerSettings->hotline_label ?? 'Hotline')}}" placeholder="Hotline">
                    @error('hotline_label')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="hotline" class="form-label">Hotline</label>
                    <input type="text" class="form-control" name="hotline" id="hotline" value="{{old('hotline', $footerSettings->hotline)}}">
                    @error('hotline')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="opening_hours_label" class="form-label">Nhãn Giờ làm việc</label>
                    <input type="text" class="form-control" name="opening_hours_label" id="opening_hours_label" value="{{old('opening_hours_label', $footerSettings->opening_hours_label ?? 'Opening Hours')}}" placeholder="Opening Hours">
                    @error('opening_hours_label')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="opening_hours" class="form-label">Giờ làm việc</label>
                    <textarea class="form-control" name="opening_hours" id="opening_hours" rows="2">{{old('opening_hours', $footerSettings->opening_hours)}}</textarea>
                    @error('opening_hours')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Bản đồ (Thay thế Newsletter)</h6>

                <div class="mb-3">
                    <label for="map_embed_code" class="form-label">Mã embed bản đồ (Google Maps iframe)</label>
                    <textarea class="form-control" name="map_embed_code" id="map_embed_code" rows="6" placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'>{{old('map_embed_code', $footerSettings->map_embed_code)}}</textarea>
                    <small class="form-text text-muted">Dán mã iframe từ Google Maps vào đây</small>
                    @error('map_embed_code')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Mạng xã hội</h6>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="facebook_url" class="form-label">Facebook URL</label>
                        <input type="url" class="form-control" name="facebook_url" id="facebook_url" value="{{old('facebook_url', $footerSettings->facebook_url)}}" placeholder="https://facebook.com/...">
                        @error('facebook_url')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="twitter_url" class="form-label">Twitter URL</label>
                        <input type="url" class="form-control" name="twitter_url" id="twitter_url" value="{{old('twitter_url', $footerSettings->twitter_url)}}" placeholder="https://twitter.com/...">
                        @error('twitter_url')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="google_url" class="form-label">Google+ URL</label>
                        <input type="url" class="form-control" name="google_url" id="google_url" value="{{old('google_url', $footerSettings->google_url)}}" placeholder="https://plus.google.com/...">
                        @error('google_url')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="instagram_url" class="form-label">Instagram URL</label>
                        <input type="url" class="form-control" name="instagram_url" id="instagram_url" value="{{old('instagram_url', $footerSettings->instagram_url)}}" placeholder="https://instagram.com/...">
                        @error('instagram_url')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Phương thức thanh toán</h6>

                <div class="mb-3">
                    <label for="payment_images" class="form-label">Hình ảnh phương thức thanh toán</label>
                    <input type="file" class="form-control" name="payment_images[]" id="payment_images" accept="image/*" multiple>
                    <small class="form-text text-muted">Có thể chọn nhiều ảnh cùng lúc</small>
                    @php
                        $paymentImages = json_decode($footerSettings->payment_images ?? '[]', true);
                    @endphp
                    @if(!empty($paymentImages))
                        <div class="mt-2">
                            <p class="text-muted">Hình ảnh hiện tại:</p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($paymentImages as $img)
                                    <div class="position-relative" style="display: inline-block;">
                                        <img src="{{asset('storage/' . $img)}}" alt="Payment" class="rounded-1" style="max-width: 100px; height: auto;">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="removePaymentImage('{{$img}}')" style="transform: translate(50%, -50%);">×</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @error('payment_images')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Bản quyền</h6>

                <div class="mb-3">
                    <label for="copyright_text" class="form-label">Text bản quyền</label>
                    <input type="text" class="form-control" name="copyright_text" id="copyright_text" value="{{old('copyright_text', $footerSettings->copyright_text)}}">
                    @error('copyright_text')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
            </form>
        </div>
    </div>
</div>

<script>
function removePaymentImage(imagePath) {
    if (confirm('Bạn có chắc chắn muốn xóa ảnh này?')) {
        // Gửi request xóa ảnh
        fetch('{{ route("footer.remove-payment-image") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ image: imagePath })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Có lỗi xảy ra khi xóa ảnh');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi xóa ảnh');
        });
    }
}
</script>
@endsection



