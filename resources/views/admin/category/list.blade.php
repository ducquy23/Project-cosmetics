@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title fw-semibold mb-4">Danh mục</h5>
                        <a href="{{route('category.create')}}" class="btn btn-primary m-1">Tạo mới</a>
                    </div>
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
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Danh mục cha</h6>
                                </th>
                                <th class="border-bottom-0 text-center">
                                    <h6 class="fw-semibold mb-0">Hành động</h6>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key=>$category)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{$key+1}}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-semibold">{{$category->name}}</p>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <p class="mb-0 fw-semibold">{!! $category->parent_id == 0 ? 'Danh mục gốc' : $category->parent->name !!}</p>
                                    </td>
                                    <td class="border-bottom-0 text-center d-flex justify-content-center">
                                        <a href="{{route('category.edit', $category)}}"
                                           class="btn btn-outline-secondary m-1">Sửa</a>
                                        <form action="{{route('category.destroy', $category)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')"
                                                type="submit" class="btn btn-outline-danger m-1">Xóa
                                            </button>
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
