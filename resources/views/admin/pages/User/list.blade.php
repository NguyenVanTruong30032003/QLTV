

@extends('admin.master_layout')
<style>
    #success-message, #error-message {
        position: fixed;
        right: 20px; 
        top: 20px; 
        z-index: 9999;
        display: none; 
    }

    .alert {
        margin: 0;
        padding: 10px;
        border-radius: 5px; 
    }
    div.dataTables_filter {
        float: right;
    }
</style>
@section('page_content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- START PAGE CONTENT -->
    <div class="page-heading">
        <h1 class="page-title">Danh sách</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
        </ol>
    </div>
    @if(session('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif
    <div class="page-content fade-in-up">
        <div class="ibox">
        <form action="{{route("import")}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required>
            <button type="submit" class="btn btn-success">Thêm mới</button>
        </form>
        
        
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Tên người dùng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Hỗ trợ</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên người dùng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Hỗ trợ</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($user as $user)
                        <tr id="row_{{ $user->Id  }}">
                            <td>{{ $user->Full_name }}</td>
                            <td>{{ $user->Phone }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>{{ $user->Address }}</td>
                            <td>
                                <a class="btn btn-default btn-sm btn-role" data-id="{{ $user->Id }}" >
                                    <i class="ti ti-user"></i></a>
                                <a class="btn btn-danger btn-sm btn-set" data-id="{{ $user->Id }}">
                                    <i class="ti ti-lock"></i></a>
                            </td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#example-table').DataTable({
                pageLength: 10,
                language: {
                    lengthMenu: "Hiển thị _MENU_ ",
                    search: "Tìm kiếm:",
                    zeroRecords: "Không tìm thấy dữ liệu",
                    info: "Hiển thị từ _START_ đến _END_ của _TOTAL_ mục",
                    infoEmpty: "Hiển thị từ 0 đến 0 của 0 mục",
                    infoFiltered: "(được lọc từ _MAX_ tổng số mục)",
                    paginate: {
                        first: "Đầu",
                        last: "Cuối",
                        next: "Tiếp",
                        previous: "Trước"
                    }
                }
            });
        });
        $(document).ready(function () {
            $('body').on('click', '.btn-set', function () {
                let _id = $(this).data("id");
                Swal.fire({
                    
                    title: "Xác nhận khóa người dùng?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Khóa",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/user_lock/" + _id,
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        title: "Khóa thành công",
                                        toast: true,
                                        showConfirmButton: false,
                                        timer: 1000
                                    });
                                    // $('#row_' + _id).remove();
                                } else {
                                    toastr.error('Khóa không thành công');
                                }
                            },
                            error: function () {
                                toastr.error('Có lỗi xảy ra. Vui lòng thử lại!');
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function () {
            $('body').on('click', '.btn-role', function () {
                let _id = $(this).data("id");
                Swal.fire({
                    
                    title: "Phân quyền admin?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Đồng ý",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/user_role/" + _id,
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        title: "Phân quyền thành công",
                                        toast: true,
                                        showConfirmButton: false,
                                        timer: 1000
                                    });
                                    // $('#row_' + _id).remove();
                                } else {
                                    toastr.error('Phân quyền không thành công');
                                }
                            },
                            error: function () {
                                toastr.error('Có lỗi xảy ra. Vui lòng thử lại!');
                            }
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
        if ($('#success-message').length) {
            $('#success-message').fadeIn().delay(5000).fadeOut();
        }
            if ($('#error-message').length) {
            $('#error-message').fadeIn().delay(5000).fadeOut();
        }
        });
    
    </script>
@endsection
