@extends('admin.master_layout')
@section('page_content')

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Phiếu đang chờ</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Phiếu đã Duyệt</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Phiếu đã xoá</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Revenue</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded p-4">
                <h5 class="mb-4">Danh sách đơn mượn sách</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Người dùng</th>
                            <th>Tên người dùng</th>
                            <th>Tên sách</th>
                            <th>Ảnh sách</th>
                            <th>Ngày mượn</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td>{{ $borrow->user->Id }}</td> <!-- Hiển thị ID người dùng -->
                                <td>{{ $borrow->user->Name }}</td> <!-- Hiển thị tên người dùng -->
                                <td>{{ $borrow->book->name }}</td> <!-- Hiển thị tên sách -->
                                <td>
                                    <img src="{{ asset('storage/' . $borrow->book->image) }}" alt="{{ $borrow->book->name }}" style="width: 100px; height: auto;">
                                </td>
                                <td>{{ $borrow->created_at->format('d/m/Y') }}</td> <!-- Hiển thị ngày mượn -->
                                <td>{{ $borrow->status }}</td> <!-- Trạng thái mượn sách -->
                                <td>
                                    <!-- Các hành động, ví dụ xóa hoặc duyệt đơn -->
                                    <a href="#" class="btn btn-success btn-sm">Duyệt</a>
                                    <form action="{{ route('admin.borrow.delete', $borrow->id) }}" method="POST" class="d-inline">
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




@endsection