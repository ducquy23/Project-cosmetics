@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="card-title fw-semibold">
                            @if($type === 'policy')
                                Quản lý Policy (Miễn phí vận chuyển, Cam kết, Đảm bảo)
                            @elseif($type === 'best_selling')
                                Quản lý Sản phẩm Bán chạy
                            @elseif($type === 'discounted')
                                Quản lý Sản phẩm Giảm giá
                            @elseif($type === 'banner')
                                Quản lý Banner
                            @elseif($type === 'logo')
                                Quản lý Logo đối tác
                            @elseif($type === 'payment')
                                Quản lý Thanh toán
                            @else
                                Quản lý Section
                            @endif
                        </h5>
                        <a href="{{ route('admin.homepage.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
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

                    <form action="{{ route('admin.homepage.update', $type) }}" method="POST" id="homepageForm">
                        @csrf
                        <div id="sections-container">
                            @if($sections->count() > 0)
                                @foreach($sections as $index => $section)
                                    @include('admin.homepage.partials.section-item', ['section' => $section, 'index' => $index, 'type' => $type])
                                @endforeach
                            @else
                                @include('admin.homepage.partials.section-item', ['section' => null, 'index' => 0, 'type' => $type])
                            @endif
                        </div>

                        <div class="mt-3">
                            <button type="button" class="btn btn-info" id="addSection">Thêm mới</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let sectionIndex = {{ $sections->count() }};
        document.getElementById('addSection').addEventListener('click', function() {
            const container = document.getElementById('sections-container');
            const newSection = document.createElement('div');
            newSection.className = 'section-item mb-4 p-3 border rounded';
            newSection.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6>Section mới</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-section">Xóa</button>
                </div>
                <input type="hidden" name="sections[${sectionIndex}][id]" value="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="sections[${sectionIndex}][title]" class="form-control" value="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mô tả</label>
                        <input type="text" name="sections[${sectionIndex}][description]" class="form-control" value="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Icon (class name)</label>
                        <input type="text" name="sections[${sectionIndex}][icon]" class="form-control" value="" placeholder="VD: fa fa-truck">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Link</label>
                        <input type="text" name="sections[${sectionIndex}][link]" class="form-control" value="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ảnh</label>
                        <input type="file" name="sections[${sectionIndex}][image_file]" class="form-control image-upload" accept="image/*">
                        <input type="hidden" name="sections[${sectionIndex}][image]" value="">
                        <div class="image-preview mt-2"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="sections[${sectionIndex}][is_active]" id="active_${sectionIndex}" checked>
                            <label class="form-check-label" for="active_${sectionIndex}">Kích hoạt</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sections[${sectionIndex}][is_visible]" id="visible_${sectionIndex}" checked>
                            <label class="form-check-label" for="visible_${sectionIndex}">Hiển thị</label>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(newSection);
            sectionIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-section')) {
                if (confirm('Bạn có chắc chắn muốn xóa section này?')) {
                    e.target.closest('.section-item').remove();
                }
            }
        });
    </script>
@endsection

