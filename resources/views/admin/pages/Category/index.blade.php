@extends('admin.master_layout')
@section('page_content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<body>
    @if (session('success'))
    <div class="alert alert-success">
        <strong>Success!</strong> {{ session('success') }}
    </div>
@endif


    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">QUẢN LÝ THỂ LOẠI SÁCH</h6>
        <a class="btn btn-success" href="{{route("categories.create")}}" >Thêm Thể Loại Sách</a>
        <div class="mb-3 d-flex justify-content-end">
            <form action="{{ route('show.categories') }}" method="GET" class="d-flex">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table"> 
                <thead>
                    <tr>
                        <th scope="col">Mã Thể Loại</th>
                        <th scope="col">Tên Thể Loại</th>
                        <th scope="col">Giới Thiệu</th>
                        <th scope="col">Hành Động</th>
                        
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie)
                         <tr id="row_{{$categorie->Id}}" >
                        <th > {{$categorie->Id}}</th>
                        <td>{{ $categorie->Name}}</td>
                        <td>{{$categorie->About}}</td>
                        
                        <td>
                            <a  class="btn btn-outline-warning" href="{{route("categories.edit",["Id"=>$categorie['Id']])}}" >Sửa</a>
                            <a  class="btn btn-outline-danger btn-delete" data-id="{{$categorie->Id}}" >Xoá</a>
                        </td>
                    </tr>
                    @endforeach
                   
                    
                  
                </tbody>
            </table>
        </div>
    </div>
    
</body>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>    
<script type="text/javascript">
$(document).ready(function () {
        $('body').on('click', '.btn-delete', function () {
            let _id = $(this).data("id");
            
            Swal.fire({
                title: "Xác nhận xóa Thể loại?",
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
                        url: "/admin/destroy_categories/" + _id,
                        type: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
								position : "top-end",
								icon : "success",
								title : "Xóa thành công",
								toast : true,
								showConfirmButton : false,
								timer : 1000
							});
                            $('#row_' + _id).remove();
                            } else {
                                toastr.error('Xóa không thành công');
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

