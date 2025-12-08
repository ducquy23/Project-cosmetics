@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Danh mục</h5>
                <form method="POST" action="{{route('category.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" name="name" class="form-control" id="name" onkeyup="generateSlug(this.value)">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug (URL)</label>
                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Tự động tạo từ tên">
                        <small class="form-text text-muted">Để trống sẽ tự động tạo từ tên danh mục</small>
                        @error('slug')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="parent" class="form-label">Danh mục cha
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="parent_id" id="parent">
                            <option value="" disabled selected>--- Chọn danh mục cha ---</option>
                            <option value="0">Danh mục gốc</option>
                            @foreach ($parent_cates as $parent_cate)
                                <option value="{{$parent_cate->id}}">{{$parent_cate->name}}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function generateSlug(name) {
            if (document.getElementById('slug').value === '') {
                // Chuyển đổi tiếng Việt có dấu thành không dấu
                const slug = name
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/đ/g, 'd')
                    .replace(/Đ/g, 'D')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
                document.getElementById('slug').value = slug;
            }
        }
    </script>
@endsection