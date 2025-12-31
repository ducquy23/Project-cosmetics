@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Quản lý SEO</h5>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{route('seo.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="site_name" class="form-label">Tên website</label>
                    <input type="text" class="form-control" name="site_name" id="site_name" value="{{old('site_name', $seoSettings->site_name)}}">
                    @error('site_name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_title" class="form-label">Meta Title (Mặc định)</label>
                    <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{old('meta_title', $seoSettings->meta_title)}}" maxlength="60">
                    <small class="form-text text-muted">Tối đa 60 ký tự. Hiển thị trên tab trình duyệt và kết quả tìm kiếm.</small>
                    @error('meta_title')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Description (Mặc định)</label>
                    <textarea class="form-control" name="meta_description" id="meta_description" rows="3" maxlength="160">{{old('meta_description', $seoSettings->meta_description)}}</textarea>
                    <small class="form-text text-muted">Tối đa 160 ký tự. Mô tả ngắn gọn về website, hiển thị trong kết quả tìm kiếm.</small>
                    @error('meta_description')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{old('meta_keywords', $seoSettings->meta_keywords)}}" placeholder="keyword1, keyword2, keyword3">
                    <small class="form-text text-muted">Các từ khóa chính, phân cách bằng dấu phẩy.</small>
                    @error('meta_keywords')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="og_image" class="form-label">Hình ảnh Open Graph</label>
                    <input type="file" class="form-control" name="og_image" id="og_image" accept="image/*">
                    @if($seoSettings->og_image)
                        <div class="mt-2">
                            <p class="text-muted">Hình ảnh hiện tại:</p>
                            <img src="{{asset('storage/' . $seoSettings->og_image)}}" alt="OG Image" class="rounded-1" style="max-width: 300px;">
                        </div>
                    @endif
                    <small class="form-text text-muted">Hình ảnh hiển thị khi chia sẻ link trên mạng xã hội (1200x630px khuyến nghị).</small>
                    @error('og_image')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Google Services</h6>

                <div class="mb-3">
                    <label for="google_analytics_id" class="form-label">Google Analytics ID</label>
                    <input type="text" class="form-control" name="google_analytics_id" id="google_analytics_id" value="{{old('google_analytics_id', $seoSettings->google_analytics_id)}}" placeholder="G-XXXXXXXXXX">
                    <small class="form-text text-muted">ID theo dạng G-XXXXXXXXXX hoặc UA-XXXXXXXXX-X</small>
                    @error('google_analytics_id')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="google_search_console" class="form-label">Google Search Console Verification</label>
                    <input type="text" class="form-control" name="google_search_console" id="google_search_console" value="{{old('google_search_console', $seoSettings->google_search_console)}}" placeholder="Mã xác minh">
                    @error('google_search_console')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Facebook Pixel</h6>

                <div class="mb-3">
                    <label for="facebook_pixel" class="form-label">Facebook Pixel Code</label>
                    <textarea class="form-control" name="facebook_pixel" id="facebook_pixel" rows="5">{{old('facebook_pixel', $seoSettings->facebook_pixel)}}</textarea>
                    <small class="form-text text-muted">Dán toàn bộ code Facebook Pixel vào đây.</small>
                    @error('facebook_pixel')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Code tùy chỉnh</h6>

                <div class="mb-3">
                    <label for="custom_head_code" class="form-label">Code trong &lt;head&gt;</label>
                    <textarea class="form-control" name="custom_head_code" id="custom_head_code" rows="5">{{old('custom_head_code', $seoSettings->custom_head_code)}}</textarea>
                    <small class="form-text text-muted">Code sẽ được chèn vào thẻ &lt;head&gt; của tất cả trang.</small>
                    @error('custom_head_code')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="custom_body_code" class="form-label">Code trước &lt;/body&gt;</label>
                    <textarea class="form-control" name="custom_body_code" id="custom_body_code" rows="5">{{old('custom_body_code', $seoSettings->custom_body_code)}}</textarea>
                    <small class="form-text text-muted">Code sẽ được chèn trước thẻ đóng &lt;/body&gt; của tất cả trang.</small>
                    @error('custom_body_code')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <hr>
                <h6 class="fw-semibold mb-3">Robots.txt & Sitemap</h6>

                <div class="mb-3">
                    <label for="robots_txt" class="form-label">Nội dung robots.txt</label>
                    <textarea class="form-control" name="robots_txt" id="robots_txt" rows="5">{{old('robots_txt', $seoSettings->robots_txt)}}</textarea>
                    <small class="form-text text-muted">Nội dung file robots.txt. Để trống sẽ dùng mặc định.</small>
                    @error('robots_txt')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="enable_sitemap" id="enable_sitemap" value="1" {{old('enable_sitemap', $seoSettings->enable_sitemap) ? 'checked' : ''}}>
                        <label class="form-check-label" for="enable_sitemap">
                            Bật Sitemap
                        </label>
                    </div>
                    <small class="form-text text-muted">Khi bật, sitemap sẽ có sẵn tại: <a href="{{url('/sitemap.xml')}}" target="_blank">{{url('/sitemap.xml')}}</a></small>
                </div>

                <button type="submit" class="btn btn-primary">Lưu cài đặt</button>
            </form>
        </div>
    </div>
</div>
@endsection

