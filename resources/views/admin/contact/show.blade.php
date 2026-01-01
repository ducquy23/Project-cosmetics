@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="card-title fw-semibold">Chi tiết tin nhắn liên hệ</h5>
                <div>
                    <a href="{{route('contact.messages')}}" class="btn btn-outline-secondary">Quay lại</a>
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Nội dung tin nhắn</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-0" style="white-space: pre-wrap;">{{$message->message}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Thông tin người gửi</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Họ tên:</label>
                                <p class="mb-0">{{$message->name}}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email:</label>
                                <p class="mb-0">
                                    <a href="mailto:{{$message->email}}">{{$message->email}}</a>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Số điện thoại:</label>
                                <p class="mb-0">
                                    <a href="tel:{{$message->phone}}">{{$message->phone}}</a>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ngày gửi:</label>
                                <p class="mb-0">{{$message->created_at->format('d/m/Y H:i:s')}}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Trạng thái:</label>
                                <div>
                                    @if($message->status === 'new')
                                        <span class="badge bg-warning rounded-3 fw-semibold">Mới</span>
                                    @elseif($message->status === 'read')
                                        <span class="badge bg-info rounded-3 fw-semibold">Đã đọc</span>
                                    @elseif($message->status === 'replied')
                                        <span class="badge bg-success rounded-3 fw-semibold">Đã phản hồi</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Thay đổi trạng thái</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{route('contact.updateStatus', $message)}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="new" {{$message->status === 'new' ? 'selected' : ''}}>Mới</option>
                                        <option value="read" {{$message->status === 'read' ? 'selected' : ''}}>Đã đọc</option>
                                        <option value="replied" {{$message->status === 'replied' ? 'selected' : ''}}>Đã phản hồi</option>
                                    </select>
                                </div>
                            </form>
                            <form action="{{route('contact.destroy', $message)}}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin nhắn này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">Xóa tin nhắn</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

