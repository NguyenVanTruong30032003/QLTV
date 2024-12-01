@extends('admin.master_layout')
@section('page_content')
<div class="container mt-4">
    <h4>
        <i class="fas fa-edit"></i> Chỉnh Sửa Nhà Xuất Bản
    </h4>

    <!-- Form chỉnh sửa nhà xuất bản -->
    <form action="{{ route('publisher.update', $publisher->Id) }}" method="post">
        @csrf
        <!-- Tên Nhà Xuất Bản -->
        <div class="mb-3">
            <label for="name" class="form-label">Tên Nhà Xuất Bản</label>
            <input type="text" class="form-control" id="name" name="Name" value="{{ $publisher->Name }}" required>
        </div>

        <!-- Địa Chỉ -->
        <div class="mb-3">
            <label for="address" class="form-label">Địa Chỉ</label>
            <input type="text" class="form-control" id="address" name="Address" value="{{ $publisher->Address }}" required>
        </div>

        <!-- Số Điện Thoại -->
        <div class="mb-3">
            <label for="phone" class="form-label">Số Điện Thoại</label>
            <input type="text" class="form-control" id="phone" name="Phone" value="{{ $publisher->Phone }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="Email" value="{{ $publisher->Email }}" required>
        </div>
       

       
        <div class="mb-3">
            <label for="status" class="form-label">Bài Viết</label>
            <input type="text" class="form-control" id="status" name="Status" value="{{ $publisher->Status }}" required>
        </div>

        <!-- Nút Submit -->
        <button type="submit" class="btn btn-primary">Cập Nhật </button>
        <a class="btn btn-secondary" href="{{route("show.publisher")}}" >Quay lại</a>
    </form>
</div>
@endsection
