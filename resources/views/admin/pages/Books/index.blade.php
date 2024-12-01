@extends('admin.master_layout')
@section('page_content')
<style>
    .img_data{
        width: 60px;
        height: 60px;
        object-fit: cover;
        padding: 5px;
    }
</style>
<body>
    @if (session('success'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif

    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">QUẢN LÝ SÁCH</h6>
        <a class="btn btn-success mb-3 " href="{{ route('books.create') }}">Thêm Sách</a>
        <div class="mb-3 d-flex">
            <form action="{{ route('show.books') }}" method="GET" class="d-flex w-50 me-auto">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped"> 
                <thead>
                    <tr>
                        <th scope="col">Mã Sách</th>
                        <th scope="col">Tên Sách</th>
                        <th scope="col">Giới Thiệu</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Thể Loại</th>
                        <th scope="col">Nhà Xuất Bản</th>
                        <th scope="col">Số Lượng</th>
                        <th scope="col">Tác Giả</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @if($books->isEmpty())
                        <tr>
                            <td colspan="9" class="text-center">Không tìm thấy kết quả</td>
                        </tr>
                    @else
                        @foreach ($books as $book)
                        <tr id="row_{{$book->Id}}">
                            <th>{{ $book->Id }}</th>
                            <td>{{ $book->Name }}</td>
                            <td>{{ $book->About }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $book->Images) }}" alt="Ảnh sách" class="img_data" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $book->Category ? $book->Category->Name : 'Không có thể loại' }}</td>
                            <td>{{ $book->Publisher ? $book->Publisher->Name : 'Không có NXB' }}</td>
                            <td>{{ $book->Quantity }}</td>
                            <td>{{ $book->author }}</td>
                            <td>
                                <a class="btn btn-outline-warning" href="{{ route('books.edit', ['id' => $book->Id]) }}">Sửa</a>
                                <button class="btn btn-outline-danger btn-delete" data-id="{{ $book->Id }}">Xóa</button>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
</body>  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
<script>
    $(document).ready(function () {
        $('body').on('click', '.btn-delete', function () {
            let _id = $(this).data("id");
            let row = $(this).closest('tr');

            Swal.fire({
                title: "Xác nhận xóa sách?",
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
                        url: `/admin/delete_book/${_id}`,
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
