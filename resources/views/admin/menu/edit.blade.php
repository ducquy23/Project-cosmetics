@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Sửa Menu</h5>
                <form method="POST" action="{{route('menu.update', $menu)}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên menu <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name', $menu->name)}}" required>
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" name="url" class="form-control" id="url" value="{{old('url', $menu->url)}}" placeholder="VD: /gioi-thieu hoặc https://example.com">
                        <small class="form-text text-muted">Để trống nếu dùng route</small>
                        @error('url')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="route" class="form-label">Route</label>
                        <input type="text" name="route" class="form-control" id="route" value="{{old('route', $menu->route)}}" placeholder="VD: home, shop, about, category">
                        <small class="form-text text-muted">Để trống nếu dùng URL. <strong>Lưu ý:</strong> Để hiển thị menu "Danh mục" với dropdown sản phẩm, đặt route = "category" và URL = "#"</small>
                        @error('route')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="order" class="form-label">Thứ tự</label>
                        <input type="number" name="order" class="form-control" id="order" value="{{old('order', $menu->order)}}" min="0">
                        @error('order')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{old('is_active', $menu->is_active) ? 'checked' : ''}}>
                            <label class="form-check-label" for="is_active">
                                Kích hoạt
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible" value="1" {{old('is_visible', $menu->is_visible) ? 'checked' : ''}}>
                            <label class="form-check-label" for="is_visible">
                                Hiển thị
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{route('menu.index')}}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
@endsection

