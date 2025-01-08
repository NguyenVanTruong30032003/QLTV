@extends('admin.master_layout')
@section('page_content')

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="marquee-container">
        <div class="marquee">
            <span>Thống kê các đơn mượn của hệ thống</span>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-hourglass-half fa-3x text-warning"></i>
                <div class="ms-3">
                   <a href="{{route("list_borrowing")}}">Phiếu đang chờ</a>
                    <h6 class="mb-0">{{ $pendingBorrowCount_1 }}</h6>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-check-double fa-3x text-info"></i>
                <div class="ms-3">
                    <a href="{{route("borrowing")}}">Phiếu đã Duyệt</a>
                    <h6 class="mb-0">{{ $pendingBorrowCount_2 }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-check-circle fa-3x text-success"></i>
                <div class="ms-3">
                    <a href="{{ route('borrows.returned') }}">Phiếu đã trả</a>
                    <h6 class="mb-0">{{ $pendingBorrowCount_3 }}</</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-trash fa-3x text-danger"></i>
                <div class="ms-3">
                    <a href="{{ route('borrow.delete') }}">Đã xoá</a>
                    <h6 class="mb-0">{{ $pendingBorrowCount_4 }}</</h6>
                </div>
            </div>
        </div>

       
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





@endsection
<style>
.marquee-container {
    width: 100%;
    overflow: hidden;
    position: relative;
    background-color: #f8f9fa; /* Nền nhạt */
    padding: 10px 0;
    border-top: 1px solid #dee2e6; /* Viền trên */
    border-bottom: 1px solid #dee2e6; /* Viền dưới */
}

.marquee {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 10s linear infinite;
}

.marquee span {
    font-size: 24px;
    font-weight: bold;
    color: #007bff; /* Màu xanh nổi bật */
    text-transform: uppercase;
    letter-spacing: 2px;
}

@keyframes marquee {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(-100%);
    }
}


</style>



