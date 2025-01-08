@extends('admin.master_layout')
@section('page_content')

<div class="page-heading">
    <h1 class="page-title">Danh sách phiếu đã trả</h1>
    <ol class="breadcrumb">
        
        <li class="breadcrumb-item">Phiếu đã trả</li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Mã phiếu</th>
                        <th>Mã SV</th>
                        <th>Người mượn</th>
                        <th>Ngày trả</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($returnedBorrows as $borrow)
                    <tr>
                        <td>QLTV_{{ $borrow->Id }}</td>
                        <td>{{ $borrow->user->SV_id }}</td>
                        <td>{{ $borrow->user->Full_name }}</td>
                        <td>{{ $borrow->Return_date }}</td>
                        <td>
                            <a href="{{ route('borrow.details', ['id' => $borrow->Id]) }}" class="btn btn-info btn-sm">
                                Xem chi tiết
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
