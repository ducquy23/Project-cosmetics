<div class="section-item mb-4 p-3 border rounded">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6>Section #{{ $index + 1 }}</h6>
        <button type="button" class="btn btn-danger btn-sm remove-section">Xóa</button>
    </div>
    <input type="hidden" name="sections[{{ $index }}][id]" value="{{ $section->id ?? '' }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="sections[{{ $index }}][title]" class="form-control" value="{{ $section->title ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Mô tả</label>
            <input type="text" name="sections[{{ $index }}][description]" class="form-control" value="{{ $section->description ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Icon (class name)</label>
            <input type="text" name="sections[{{ $index }}][icon]" class="form-control" value="{{ $section->icon ?? '' }}" placeholder="VD: fa fa-truck">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Link</label>
            <input type="text" name="sections[{{ $index }}][link]" class="form-control" value="{{ $section->link ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" name="sections[{{ $index }}][image_file]" class="form-control image-upload" accept="image/*">
            <input type="hidden" name="sections[{{ $index }}][image]" value="{{ $section->image ?? '' }}">
            @if($section && $section->image)
                <div class="image-preview mt-2">
                    <img src="{{ asset('storage/' . $section->image) }}" alt="Preview" style="max-width: 200px; height: auto;">
                </div>
            @else
                <div class="image-preview mt-2"></div>
            @endif
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" name="sections[{{ $index }}][is_active]" id="active_{{ $index }}" {{ ($section && $section->is_active) || !$section ? 'checked' : '' }}>
                <label class="form-check-label" for="active_{{ $index }}">Kích hoạt</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sections[{{ $index }}][is_visible]" id="visible_{{ $index }}" {{ ($section && $section->is_visible) || !$section ? 'checked' : '' }}>
                <label class="form-check-label" for="visible_{{ $index }}">Hiển thị</label>
            </div>
        </div>
    </div>
</div>

