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
                            @elseif($type === 'best_selling_content')
                                Quản lý Nội dung Sản phẩm Bán chạy
                            @elseif($type === 'discounted')
                                Quản lý Sản phẩm Giảm giá
                            @elseif($type === 'testimonial')
                                Quản lý Testimonial (Đánh giá khách hàng)
                            @elseif($type === 'banner')
                                Quản lý Banner (Top)
                            @elseif($type === 'banner_bottom')
                                Quản lý Banner (Bottom)
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

                    <form action="{{ route('admin.homepage.update', $type) }}" method="POST" id="homepageForm" enctype="multipart/form-data">
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
        const type = '{{ $type }}';
        const products = @json($products ?? []);
        
        document.getElementById('addSection').addEventListener('click', function() {
            const container = document.getElementById('sections-container');
            const newSection = document.createElement('div');
            newSection.className = 'section-item mb-4 p-3 border rounded';
            
            let productSelect = '';
            if ((type === 'discounted' || type === 'best_selling') && products.length > 0) {
                productSelect = `
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Chọn sản phẩm</label>
                        <select name="sections[${sectionIndex}][product_id]" class="form-control">
                            <option value="">-- Chọn sản phẩm --</option>
                            ${products.map(p => {
                                let label = p.name;
                                if (type === 'discounted' && p.discount > 0) {
                                    label += ` (${p.discount}% giảm)`;
                                }
                                return `<option value="${p.id}">${label}</option>`;
                            }).join('')}
                        </select>
                    </div>
                `;
            } else if (type === 'best_selling_content') {
                productSelect = `
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub-title (Tiêu đề phụ)</label>
                        <input type="text" name="sections[${sectionIndex}][title]" class="form-control" value="" placeholder="Sản phẩm bán chạy">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title (Tiêu đề chính)</label>
                        <input type="text" name="sections[${sectionIndex}][description]" class="form-control" value="" placeholder="Bán chạy">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="sections[${sectionIndex}][settings][content]" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Text Link</label>
                        <input type="text" name="sections[${sectionIndex}][settings][link_text]" class="form-control" value="" placeholder="Tất cả sản phẩm">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">URL Link</label>
                        <input type="text" name="sections[${sectionIndex}][link]" class="form-control" value="" placeholder="/cua-hang">
                    </div>
                `;
            } else if (type === 'testimonial') {
                productSelect = `
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tên khách hàng</label>
                        <input type="text" name="sections[${sectionIndex}][title]" class="form-control" value="" placeholder="John Do">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Chức vụ / Vị trí</label>
                        <input type="text" name="sections[${sectionIndex}][settings][position]" class="form-control" value="" placeholder="CSS - HTML">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Nội dung đánh giá</label>
                        <textarea name="sections[${sectionIndex}][settings][content]" class="form-control" rows="4" placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit..."></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ảnh Profile (Tròn)</label>
                        <input type="file" name="sections[${sectionIndex}][image_file]" class="form-control image-upload" accept="image/*">
                        <input type="hidden" name="sections[${sectionIndex}][image]" value="">
                        <div class="image-preview mt-2"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Đánh giá (Số sao)</label>
                        <select name="sections[${sectionIndex}][settings][rating]" class="form-control">
                            <option value="5" selected>5 sao</option>
                            <option value="4">4 sao</option>
                            <option value="3">3 sao</option>
                            <option value="2">2 sao</option>
                            <option value="1">1 sao</option>
                        </select>
                    </div>
                `;
            } else {
                productSelect = `
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="sections[${sectionIndex}][title]" class="form-control" value="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mô tả</label>
                        <input type="text" name="sections[${sectionIndex}][description]" class="form-control" value="">
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
                `;
            }
            
            newSection.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6>Section mới</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-section">Xóa</button>
                </div>
                <input type="hidden" name="sections[${sectionIndex}][id]" value="">
                <div class="row">
                    ${productSelect}
                    <div class="col-md-6 mb-3">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="sections[${sectionIndex}][is_active]" id="active_${sectionIndex}" checked>
                            <label class="form-check-label" for="active_${sectionIndex}">Kích hoạt</label>
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

        // Preview ảnh khi chọn file
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('image-upload')) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    const previewDiv = e.target.closest('.col-md-6').querySelector('.image-preview');
                    
                    reader.onload = function(e) {
                        previewDiv.innerHTML = '<img src="' + e.target.result + '" alt="Preview" style="max-width: 200px; height: auto; margin-top: 10px;">';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>
@endsection

