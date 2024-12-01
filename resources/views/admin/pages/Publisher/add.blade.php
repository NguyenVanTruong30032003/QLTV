@extends('admin.master_layout')
@section('page_content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhà Xuất Bản</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h6 class="text-center">Thêm Nhà Xuất Bản Mới</h6>

        <form action="{{ route('publisher.store') }}" method="post">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Tên Nhà Xuất Bản</label>
                <input type="text" class="form-control" id="name" name="Name" placeholder="Nhập tên nhà xuất bản" required>
            </div>
        
            <div class="mb-3">
                <label for="address" class="form-label">Địa Chỉ</label>
                <input type="text" class="form-control" id="address" name="Address" placeholder="Nhập địa chỉ nhà xuất bản" required>
            </div>
        
            <div class="mb-3">
                <label for="phone" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="phone" name="Phone" placeholder="Nhập số điện thoại" required>
            </div>
        
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="Email" placeholder="Nhập email" required>
            </div>
        
            <div class="mb-3">
                <label for="status" class="form-label">Mô Tả Nhà Xuất Bản</label>
                <textarea class="form-control" id="status" name="Status" rows="3" placeholder="Nhập mô tả về nhà xuất bản" required></textarea>
            </div>
        
            <div class="mb-3">
                <label for="is_active" class="form-label">Trạng Thái Kích Hoạt</label>
                <input type="checkbox" id="is_active" name="IsActive" value="1" checked>
                <label for="is_active">Kích hoạt</label>
            </div>
        
            <button type="submit" class="btn btn-primary">Thêm Nhà Xuất Bản</button>
            <a class="btn btn-secondary" href="{{route("show.publisher")}}" >Quay lại</a>
        </form>
        
        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection