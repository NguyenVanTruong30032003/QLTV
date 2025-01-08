@extends('admin.master_layout')

@section('page_content')
<style>
    div.dataTables_filter {
        float: right;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Danh sách phiếu đang mượn</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">

        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr class="text-center">
                        <th>Mã phiếu</th>
                        <th>Ngày tạo</th>
                        <th>Xử lý</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>Mã phiếu</th>
                        <th>Ngày tạo</th>
                        <th>Xử lý</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if($br->isEmpty()) <!-- Nếu $br là một collection -->
                        <tr>
                            <td colspan="3" class="text-center">Không có phiếu mượn nào.</td>
                        </tr>
                    @else
                        @foreach($br as $brr)
                            <tr id="row_{{ $brr->Id }}">
                                <td>QLTV{{$brr->Id}}</td>
                                <td>{{ \Carbon\Carbon::parse($brr->Create_date)->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <a class="btn btn-default btn-xs m-r-5" href="{{ route('detail_return', ['Id' => $brr->Id]) }}" data-toggle="tooltip" title="Xem chi tiết">
                                        <i class="fa fa-eye font-14"></i>
                                    </a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 10,
            order: [[1, 'desc']], // Sắp xếp cột ngày tạo giảm dần
            language: {
                lengthMenu: "Hiển thị _MENU_ mục",
                search: "Tìm kiếm:",
                zeroRecords: "Không tìm thấy dữ liệu",
                info: "Hiển thị từ _START_ đến _END_ của _TOTAL_ mục",
                infoEmpty: "Không có mục nào để hiển thị",
                infoFiltered: "(được lọc từ _MAX_ mục)",
                paginate: {
                    first: "Đầu",
                    last: "Cuối",
                    next: "Tiếp",
                    previous: "Trước"
                }
            }
        });
    });

    // Cảnh báo khi nhấn nút trả phiếu
    $('.btn-success').on('click', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: 'Xác nhận trả phiếu',
            text: "Bạn có chắc chắn muốn trả phiếu này không?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có, trả ngay!',
            cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>

@endsection
