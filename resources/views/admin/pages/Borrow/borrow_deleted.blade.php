@extends('admin.master_layout')

@section('page_content')

<div class="page-heading">
    <h1 class="page-title">DANH SÁCH PHIẾU ĐÃ XOÁ
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('borrow.delete') }}">Phiếu đã xóa</a></li>
        <li class="breadcrumb-item active">Chi tiết</li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <h4 class="mt-4 mb-4">Danh sách phiếu mượn đã xóa</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã phiếu</th>
                        <th>Ngày tạo</th>
                        <th>Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deletedBorrows as $borrow)
                    <tr>
                        <td>QLTV_{{ $borrow->Id }}</td>
                        <td>{{ $borrow->Create_date }}</td>
                        <td>
                            <a href="{{ route('borrow.deleted.detail', ['id' => $borrow->Id]) }}" class="btn btn-info btn-sm">Xem chi tiết</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection
