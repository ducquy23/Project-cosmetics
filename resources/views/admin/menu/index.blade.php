@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title fw-semibold mb-4">Quản lý Menu</h5>
                        <a href="{{route('menu.create')}}" class="btn btn-primary m-1">Tạo mới</a>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tên</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">URL/Route</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Thứ tự</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Hành động</h6>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menuItems as $menu)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$menu->id}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$menu->name}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="mb-0">{{$menu->url ?? ($menu->route ? 'route: ' . $menu->route : '-')}}</span>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <span class="mb-0">{{$menu->order}}</span>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        @if($menu->is_active)
                                            <span class="badge bg-success">Kích hoạt</span>
                                        @else
                                            <span class="badge bg-danger">Tắt</span>
                                        @endif
                                        <br>
                                        @if($menu->is_visible)
                                            <span class="badge bg-info mt-1">Hiển thị</span>
                                        @else
                                            <span class="badge bg-secondary mt-1">Ẩn</span>
                                        @endif
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <a href="{{route('menu.edit', $menu)}}" class="btn btn-warning btn-sm">Sửa</a>
                                        <form action="{{route('menu.destroy', $menu)}}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

