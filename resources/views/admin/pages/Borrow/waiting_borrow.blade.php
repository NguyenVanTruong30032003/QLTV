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
<!-- END SIDEBAR-->
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Danh sách phiếu chờ </h1>
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
                    <tr>
                        <th>Mã phiếu</th>
                        <th>Ngày tạo</th>
                        <th>Xử lý</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Mã phiếu</th>
                        <th>Ngày tạo</th>
                        <th>Xử lý</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($br as $brr)
                    <tr id="row_{{ $brr->Id }}">
                        <td>QLTV_{{$brr->Id}}</td>
                        <td>{{$brr->Create_date}}</td>

                        <td>
                            <!-- Xem chi tiết -->
                            <a class="btn btn-default btn-xs m-r-5" href="{{ route('book_in_wait', ['Id' => $brr->Id]) }}" data-toggle="tooltip" title="Xem chi tiết">
                                <i class="fa fa-eye font-14"></i>
                            </a>
                        
                          
                            <a class="btn btn-danger btn-sm btn-delete-borrow" data-id="{{ $brr->Id }}" title="Xóa phiếu">
                                  <i class="fa fa-trash"></i> <!-- FontAwesome icon xóa -->
                            </a>

                        </td>
                    </tr>
                    @endforeach


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
<script>
    $(document).ready(function() {
        $('body').on('click', '.btn-delete-borrow', function() {
            let _id = $(this).data("id");
            Swal.fire({
                title: "Xóa phiếu mượn?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xóa",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/delete_borrow/" + _id,  // Cập nhật URL với route xóa
                        type: "DELETE",  // Thay vì POST, sử dụng DELETE để xóa
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Xóa thành công",
                                    toast: true,
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                $('#row_' + _id).remove();  // Xóa dòng dữ liệu tương ứng
                            } else {
                                toastr.error('Xóa không thành công');
                            }
                        },
                        error: function() {
                            toastr.error('Có lỗi xảy ra. Vui lòng thử lại!');
                        }
                    });
                }
            });
        });
    });
</script>


@endsection