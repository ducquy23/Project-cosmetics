@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="card-title fw-semibold">Tin nhắn liên hệ</h5>
                <a href="{{route('contact.index')}}" class="btn btn-outline-primary">Cài đặt liên hệ</a>
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
                                <h6 class="fw-semibold mb-0">Họ tên</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Số điện thoại</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nội dung</h6>
                            </th>
                            <th class="border-bottom-0 text-center">
                                <h6 class="fw-semibold mb-0">Trạng thái</h6>
                            </th>
                            <th class="border-bottom-0 text-center">
                                <h6 class="fw-semibold mb-0">Ngày gửi</h6>
                            </th>
                            <th class="border-bottom-0 text-center">
                                <h6 class="fw-semibold mb-0">Hành động</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">#{{$message->id}}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="fw-semibold mb-0">{{$message->name}}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0">{{$message->email}}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0">{{$message->phone}}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0" style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{Str::limit($message->message, 100)}}
                                    </p>
                                </td>
                                <td class="border-bottom-0 text-center">
                                    @if($message->status === 'new')
                                        <span class="badge bg-warning rounded-3 fw-semibold">Mới</span>
                                    @elseif($message->status === 'read')
                                        <span class="badge bg-info rounded-3 fw-semibold">Đã đọc</span>
                                    @elseif($message->status === 'replied')
                                        <span class="badge bg-success rounded-3 fw-semibold">Đã phản hồi</span>
                                    @endif
                                </td>
                                <td class="border-bottom-0 text-center">
                                    <p class="mb-0">{{$message->created_at->format('d/m/Y H:i')}}</p>
                                </td>
                                <td class="border-bottom-0 text-end">
                                    <a href="{{route('contact.show', $message)}}" class="btn btn-outline-info btn-sm m-1">Chi tiết</a>
                                    <form action="{{route('contact.destroy', $message)}}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin nhắn này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm m-1">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <p class="text-muted">Chưa có tin nhắn nào</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{$messages->links()}}
            </div>
        </div>
    </div>
</div>
@endsection

