@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Chỉnh sửa nhân viên</h5>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{route('staff.update', $staff)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name', $staff->name)}}">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email', $staff->email)}}">
                        @error('email')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Chức vụ <span class="text-danger">*</span></label>
                        <select name="role" id="role" class="form-select">
                            <option value="" disabled>--- Chọn chức vụ ---</option>
                            <option value="Quản trị viên" {{old('role', $staff->role) == 'Quản trị viên' ? 'selected' : ''}}>Quản trị viên</option>
                            <option value="Nhân viên" {{old('role', $staff->role) == 'Nhân viên' ? 'selected' : ''}}>Nhân viên</option>
                        </select>
                        @error('role')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Để trống nếu không đổi mật khẩu">
                        <small class="form-text text-muted">Chỉ nhập khi muốn đổi mật khẩu. Để trống nếu không muốn thay đổi.</small>
                        @error('password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu mới</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu mới">
                        @error('password_confirmation')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{route('staff.index')}}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
@endsection
