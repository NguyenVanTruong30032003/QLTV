@extends('admin.master_layout')

@section('page_content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Danh Sách Người Dùng</title>
    <style>
        .img_data {
            width: 60px;
            height: 60px;
            object-fit: cover;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="bg-light rounded p-4">
          
            <h6 class="mb-4">DANH SÁCH NGƯỜI QUẢN TRỊ</h6>
           
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ&Tên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Avatar</th>
                        <th>Địa Chỉ</th>
                        <th>Vai Trò</th>
                        <th class="text-center">Trạng Thái</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr id="row_{{$user->Id}}">
                            <td>{{ $user->Id }}</td>
                            <td>{{ $user->Full_name }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>{{ $user->Phone }}</td>
                            <td><img src="{{ asset('storage/' . $user->Avatar) }}" alt="" class="img_data"></td>
                            <td>{{ $user->Address }}</td>
                            <td>{{ $user->Role_id }}</td>
                            <td class="text-center">{{ $user->IsActive ? 'Hiển thị' : 'Ẩn' }}</td>
                            
                            @if ($user->Role_id == 2)
                                <td>
                                    <a href="{{ route('users.edit', $user->Id) }}" class="btn btn-outline-warning">Sửa</a>
                                    <a class="btn btn-outline-danger btn-set" data-id="{{ $user->Id }}">Khoá</a>
                                    <a class="btn btn-outline-danger btn-pq" data-id="{{ $user->Id }}">pq</a>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('users.xemchitiet', $user->Id) }}" class="btn btn-outline-primary">Xem</a>
                                </td>
                            @endif

                        </tr>
                          
                    @endforeach
                </tbody>
                
                
            </table>
        </div>
    </div>

</body>
</html>



<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" >


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
            $('body').on('click', '.btn-pq', function () {
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
</script>
@endsection
