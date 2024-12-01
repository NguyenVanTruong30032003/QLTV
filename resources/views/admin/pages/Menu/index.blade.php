@extends('admin.master_layout')

@section('page_content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Danh Sách Menu</title>
</head>
<body>
    <div class="container mt-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">DANH SÁCH MENU</h6>
            <a href="{{ route('create.menu') }}" class="btn btn-primary mb-3">Thêm Menu</a>
            <div class="mb-3 d-flex justify-content-end">
                <form action="{{ route('show.menus') }}" method="GET" class="d-flex">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Menu</th>
                        <th>Cấp Mục</th>
                        <th>Cấp Cha</th>
                        <th>Thứ Tự</th>
                        
                        
                       
                        <th class="text-center">Trạng Thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $menu->Id }}</td>
                            <td>{{ $menu->Name }}</td>
                            <td>{{ $menu->Item_level }}</td>
                            <td>{{ $menu->Parent_level }}</td>
                            <td>{{ $menu->Item_oder }}</td>
                            
                            
                           
                            <td class="text-center">{{ $menu->IsActive ? 'Hiển Thị' : 'Ẩn' }}</td>
                            <td>
                                <a class="btn btn-outline-warning" href="{{ route('edit_memus', ['id' => $menu->Id]) }}">Sửa</a>
                                <button class="btn btn-outline-danger btn-delete" data-id="{{ $menu->Id }}">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
<script>
    $(document).ready(function () {
        $('body').on('click', '.btn-delete', function () {
            let _id = $(this).data("id");
            let row = $(this).closest('tr');

            Swal.fire({
                title: "Xác nhận xóa menu?",
                text: "Bạn sẽ không thể khôi phục lại dữ liệu này!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xóa",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/menus/delete/${_id}`,
                        type: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Xóa thành công",
                                    toast: true,
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                row.remove();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Xóa không thành công!',
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Có lỗi xảy ra',
                                text: 'Vui lòng thử lại!',
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
