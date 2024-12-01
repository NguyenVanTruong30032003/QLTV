@extends('admin.master_layout')
@section('page_content')


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Thêm Thể Loại Sách</title>
</head>
<body>
    <div class="container mt-4">
        <div class="bg-light rounded p-4">
            <h6 class="mb-4">THÊM THỂ LOẠI SÁCH</h6>
            <form action="{{ route('categories.store') }}" method="post">
                @csrf <!-- Thêm token CSRF để bảo vệ form -->
                <div class="mb-3">
                    <label for="Name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Nhập tên" required>
                </div>
                <div class="mb-3">
                    <label for="About" class="form-label">Mô Tả</label>
                    <textarea class="form-control" id="About" name="About" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Thêm Thể Loại</button>
                <a class="btn btn-secondary" href="{{route("show.categories")}}" >Quay lại</a>
            </form>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


@endsection 