@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title fw-semibold mb-4">Quản lý Trang chủ</h5>
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
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Loại Section</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Mô tả</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Số lượng</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Hành động</h6>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Policy (Miễn phí vận chuyển, Cam kết, Đảm bảo)</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="mb-0">Quản lý 3 phần: Miễn phí vận chuyển, Cam kết hàng chính hãng, Đảm bảo hoàn tiền</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <span class="mb-0">{{ $sections->get('policy', collect())->count() }}</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <a href="{{ route('admin.homepage.edit', 'policy') }}" class="btn btn-primary btn-sm">Sửa</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Sản phẩm Bán chạy</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="mb-0">Quản lý danh sách sản phẩm bán chạy hiển thị trên trang chủ</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <span class="mb-0">{{ $sections->get('best_selling', collect())->count() }}</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <a href="{{ route('admin.homepage.edit', 'best_selling') }}" class="btn btn-primary btn-sm">Sửa</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Sản phẩm Giảm giá</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="mb-0">Quản lý danh sách sản phẩm giảm giá hiển thị trên trang chủ</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <span class="mb-0">{{ $sections->get('discounted', collect())->count() }}</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <a href="{{ route('admin.homepage.edit', 'discounted') }}" class="btn btn-primary btn-sm">Sửa</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Banner</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="mb-0">Quản lý các banner hiển thị trên trang chủ (2 banner)</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <span class="mb-0">{{ $sections->get('banner', collect())->count() }}</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <a href="{{ route('admin.homepage.edit', 'banner') }}" class="btn btn-primary btn-sm">Sửa</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Logo đối tác</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="mb-0">Quản lý logo đối tác (nếu nhiều hơn 6 logo sẽ tự động scroll)</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <span class="mb-0">{{ $sections->get('logo', collect())->count() }}</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <a href="{{ route('admin.homepage.edit', 'logo') }}" class="btn btn-primary btn-sm">Sửa</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Thanh toán</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="mb-0">Quản lý phần thanh toán hiển thị trên trang chủ</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <span class="mb-0">{{ $sections->get('payment', collect())->count() }}</span>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <a href="{{ route('admin.homepage.edit', 'payment') }}" class="btn btn-primary btn-sm">Sửa</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

