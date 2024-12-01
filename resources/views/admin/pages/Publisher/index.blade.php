@extends('admin.master_layout')
@section('page_content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publishers</title>
    
</head>
<body>
    <h6 class="mb-4">QUẢN LÝ NHÀ XUẤT BẢN</h6>
    <a class="btn btn-success" href="{{route("publisher.create")}}" >Thêm Thể Loại Sách</a>
    <div class="mb-3 d-flex justify-content-end">
        <form action="{{ route('show.publisher') }}" method="GET" class="d-flex">
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
                <th>ID</th>
                <th>Tên NXB</th>
                <th>Địa chỉ</th>
                 <th>Điện Thoại</th>
                 <th>Email</th>
                <th>Bài viết</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if($publisher->isEmpty())
            <tr>
                <td colspan="7" class="text-center">Không tìm thấy kết quả</td>
            </tr>
        @else
            @foreach($publisher as $pub)
                <tr>
                    <td>{{ $pub->Id }}</td>
                    <td>{{ $pub->Name }}</td>
                    <td>{{ $pub->Address }}</td>
                    <td>{{ $pub->Phone }}</td>
                    <td>{{ $pub->Email }}</td>
                    <td>{{ $pub->Status }}</td>
                    <td>
                        <a class="btn btn-outline-warning" href="{{ route('publisher.edit', $pub->Id) }}">Sửa</a>
                        <form action="{{ route('publisher.destroy', $pub->Id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhà xuất bản này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        
        </tbody>
    </table>
    </div>
    
</body>
</html>


@endsection 