<div class="section-item mb-4 p-3 border rounded">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6>
            Section #{{ $index + 1 }}
            @if(isset($type) && ($type === 'discounted' || $type === 'best_selling') && $section && $section->product)
                - {{ $section->product->name }}
            @endif
        </h6>
        <button type="button" class="btn btn-danger btn-sm remove-section">Xóa</button>
    </div>
    <input type="hidden" name="sections[{{ $index }}][id]" value="{{ $section->id ?? '' }}">
    <div class="row">
        @if(isset($type) && ($type === 'discounted' || $type === 'best_selling'))
        <div class="col-md-12 mb-3">
            <label class="form-label">Chọn sản phẩm</label>
            <select name="sections[{{ $index }}][product_id]" class="form-control">
                <option value="">-- Chọn sản phẩm --</option>
                @if(isset($products))
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ ($section && $section->product_id == $product->id) ? 'selected' : '' }}>
                            {{ $product->name }}
                            @if($type === 'discounted' && $product->discount > 0)
                                ({{ $product->discount }}% giảm)
                            @endif
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        @elseif(isset($type) && $type === 'best_selling_content')
        <div class="col-md-6 mb-3">
            <label class="form-label">Sub-title (Tiêu đề phụ)</label>
            <input type="text" name="sections[{{ $index }}][title]" class="form-control" value="{{ $section->title ?? 'Sản phẩm bán chạy' }}" placeholder="Sản phẩm bán chạy">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Title (Tiêu đề chính)</label>
            <input type="text" name="sections[{{ $index }}][description]" class="form-control" value="{{ $section->description ?? 'Bán chạy' }}" placeholder="Bán chạy">
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="sections[{{ $index }}][settings][content]" class="form-control" rows="3">{{ $section->settings['content'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.' }}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Text Link</label>
            <input type="text" name="sections[{{ $index }}][settings][link_text]" class="form-control" value="{{ $section->settings['link_text'] ?? 'Tất cả sản phẩm' }}" placeholder="Tất cả sản phẩm">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">URL Link</label>
            <input type="text" name="sections[{{ $index }}][link]" class="form-control" value="{{ $section->link ?? route('shop') }}" placeholder="{{ route('shop') }}">
        </div>
        @elseif(isset($type) && $type === 'testimonial')
        <div class="col-md-12 mb-3">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" name="sections[{{ $index }}][title]" class="form-control" value="{{ $section->title ?? '' }}" placeholder="John Do">
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Chức vụ / Vị trí</label>
            <input type="text" name="sections[{{ $index }}][settings][position]" class="form-control" value="{{ $section->settings['position'] ?? '' }}" placeholder="CSS - HTML">
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Nội dung đánh giá</label>
            <textarea name="sections[{{ $index }}][settings][content]" class="form-control" rows="4" placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit...">{{ $section->settings['content'] ?? '' }}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Ảnh Profile (Tròn)</label>
            <input type="file" name="sections[{{ $index }}][image_file]" class="form-control image-upload" accept="image/*">
            <input type="hidden" name="sections[{{ $index }}][image]" value="{{ $section->image ?? '' }}">
            <div class="image-preview mt-2">
                @if($section && $section->image)
                    @if(str_starts_with($section->image, '/assets/'))
                        <img src="{{ $section->image }}" alt="Preview" style="max-width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/' . $section->image) }}" alt="Preview" style="max-width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    @endif
                @endif
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Đánh giá (Số sao)</label>
            <select name="sections[{{ $index }}][settings][rating]" class="form-control">
                <option value="5" {{ ($section && ($section->settings['rating'] ?? 5) == 5) ? 'selected' : '' }}>5 sao</option>
                <option value="4" {{ ($section && ($section->settings['rating'] ?? 5) == 4) ? 'selected' : '' }}>4 sao</option>
                <option value="3" {{ ($section && ($section->settings['rating'] ?? 5) == 3) ? 'selected' : '' }}>3 sao</option>
                <option value="2" {{ ($section && ($section->settings['rating'] ?? 5) == 2) ? 'selected' : '' }}>2 sao</option>
                <option value="1" {{ ($section && ($section->settings['rating'] ?? 5) == 1) ? 'selected' : '' }}>1 sao</option>
            </select>
        </div>
        @else
        <div class="col-md-6 mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="sections[{{ $index }}][title]" class="form-control" value="{{ $section->title ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Mô tả</label>
            <input type="text" name="sections[{{ $index }}][description]" class="form-control" value="{{ $section->description ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Link</label>
            <input type="text" name="sections[{{ $index }}][link]" class="form-control" value="{{ $section->link ?? '' }}">
        </div>
        @endif
        @if(!isset($type) || ($type !== 'best_selling_content' && $type !== 'testimonial'))
        <div class="col-md-6 mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" name="sections[{{ $index }}][image_file]" class="form-control image-upload" accept="image/*">
            <input type="hidden" name="sections[{{ $index }}][image]" value="{{ $section->image ?? '' }}">
            <div class="image-preview mt-2">
                @if($section && $section->image)
                    @if(str_starts_with($section->image, '/assets/'))
                        <img src="{{ $section->image }}" alt="Preview" style="max-width: 200px; height: auto;">
                    @else
                        <img src="{{ asset('storage/' . $section->image) }}" alt="Preview" style="max-width: 200px; height: auto;">
                    @endif
                @endif
            </div>
        </div>
        @endif
        <div class="col-md-6 mb-3">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" name="sections[{{ $index }}][is_active]" id="active_{{ $index }}" {{ ($section && $section->is_active) || !$section ? 'checked' : '' }}>
                <label class="form-check-label" for="active_{{ $index }}">Kích hoạt</label>
            </div>
        </div>
    </div>
</div>

