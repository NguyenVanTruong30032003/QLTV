@extends('admin.master_layout')
@section('page_content')

<div class="page-heading">
    <h1 class="page-title">Chi tiết phiếu mượn</h1>
    <ol class="breadcrumb">
       
        <li class="breadcrumb-item"><a href="{{ route('borrows.returned') }}">Phiếu đã trả</a></li>
        <li class="breadcrumb-item active">Chi tiết</li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <h4 class="mb-4">Thông tin phiếu</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Mã phiếu:</strong> QLTV_{{ $borrow->Id }}</p>
                    <p><strong>Mã SV:</strong> QLTV_{{ $borrow->SV_id}}</p>
                    <p><strong>Người mượn:</strong> {{ $borrow->user->Full_name }}</p>
                    <p><strong>Ngày mượn:</strong> {{ $borrow->Create_date }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ngày trả:</strong> {{ $borrow->Return_date }}</p>
                    <p><strong>Người xử lý:</strong> {{ $borrow->Borrow_admin_id}}</p>
                    <p><strong>Trạng thái:</strong> 
                        <span class="badge badge-light text-dark">Đã trả</span>
                    </p>
                </div>
            </div>

            <h4 class="mt-4 mb-4">Danh sách sách mượn</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hình ảnh</th>
                        <th>Tên sách</th>
                        <th>Tác giả</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrow->details as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($detail->book->Images)
                                <img src="{{ asset('storage/' . $detail->book->Images) }}" alt="{{ $detail->book->Name }}" style="width: 50px; height: 75px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image" style="width: 50px; height: 75px; object-fit: cover;">
                            @endif
                        </td>
                        <td>{{ $detail->book->Name }}</td>
                        <td>{{ $detail->book->author }}</td>
                        <td>{{ $detail->Quantity }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
