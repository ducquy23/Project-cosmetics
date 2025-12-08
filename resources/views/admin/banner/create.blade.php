@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner / Slide</h5>
                <form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}">
                        @error('title')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" id="image" accept="image/*" onchange="previewImage(this)">
                        @error('image')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        <img id="imagePreview" class="mt-3 rounded-1" style="max-width: 300px; display: none;">
                    </div>
                    
                    <div class="mb-3">
                        <label for="link" class="form-label">Liên kết (URL)</label>
                        <input type="url" class="form-control" name="link" id="link" value="{{old('link')}}" placeholder="https://example.com">
                        @error('link')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                        <select class="form-select" name="status" id="status">
                            <option value="active" {{old('status', 'active') == 'active' ? 'selected' : ''}}>Hoạt động</option>
                            <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}}>Tạm dừng</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="order" class="form-label">Thứ tự sắp xếp</label>
                        <input type="number" class="form-control" name="order" id="order" value="{{old('order', 0)}}" min="0">
                        @error('order')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{old('description')}}</textarea>
                        @error('description')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{route('banner.index')}}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

