@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <form action="{{ route('banner.index') }}" method="get" enctype="multipart/form-data" class="d-flex">
            <div class="col-lg-3">
                <div class="input-group mb-3">
                    <input type="text" value="{{ request('search') }}" name="search" class="form-control" placeholder="Tìm kiếm theo tiêu đề..." aria-label="Search"
                           aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="input-search-customer"
                                style="border-top-left-radius: 0;border-bottom-left-radius: 0;padding: 8px"
                                type="submit">Tìm kiếm
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title fw-semibold mb-4">Banner / Slide</h5>
                    <a href="{{route('banner.create')}}" class="btn btn-primary m-1">Tạo mới</a>
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
                                    <h6 class="fw-semibold mb-0">ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Hình ảnh</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tiêu đề</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Thứ tự</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Thao tác</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $banner)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$banner->id}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        @if($banner->image)
                                            <img src="{{asset('storage/' . $banner->image)}}" alt="{{$banner->title}}" style="width: 100px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Không có hình</span>
                                        @endif
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-semibold">{{$banner->title ?? 'N/A'}}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-{{$banner->status == 'active' ? 'success' : 'secondary'}}">
                                            {{$banner->status == 'active' ? 'Hoạt động' : 'Tạm dừng'}}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$banner->order}}</h6>
                                    </td>
                                    <td class="border-bottom-0 text-center d-flex justify-content-center">
                                        <a href="{{route('banner.edit', $banner)}}" class="btn btn-outline-secondary m-1">Sửa</a>
                                        <form action="{{route('banner.destroy', $banner)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có chắc chắn muốn xóa banner/slide này không?')"
                                            type="submit" class="btn btn-outline-danger m-1">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <p class="text-muted">Không có dữ liệu</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $banners->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

