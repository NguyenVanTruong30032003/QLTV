@extends('admin.master_layout')


@section('page_content')
<div class="bg-light rounded p-4">
    <h6 class="mb-4">SỬA THỂ LOẠI SÁCH</h6>
    <form  method="POST" action="{{route('categories.update',['Id' => $category->Id]) }}">
        @csrf <!-- Thêm token CSRF -->
        @method('PUT') <!-- Sử dụng PUT cho cập nhật dữ liệu -->

        <input type="hidden" name="Id" value="{{ $category->Id }}">

        <div class="mb-3">
            <label for="Name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="Name" name="Name" placeholder="Nhập tên thể loại" value="{{ $category->Name }}" required>
        </div>
        <div class="mb-3">
            <label for="About" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="About" name="About" rows="3" placeholder="Mô tả về thể loại sách.">{{ $category->About }}</textarea>
        </div>
        <div class="mb-3">
            <label for="CreateDate" class="form-label">Ngày Tạo</label>
            <input type="text" class="form-control" id="CreateDate" name="CreateDate" value="{{ $category->Create_date }}" readonly>
        </div>
        <div class="mb-3">
            <label for="CreatedBy" class="form-label">Người Tạo</label>
            <input type="text" class="form-control" id="CreatedBy" name="CreatedBy" value="{{ $category->Create_by }}">
        </div>
        <div class="mb-3">
            <label for="UpdateDate" class="form-label">Ngày Cập Nhật</label>
            <input type="text" class="form-control" id="UpdateDate" name="UpdateDate" value="{{ now() }}" readonly>
        </div>
        <div class="mb-3">
            <label for="UpdatedBy" class="form-label">Người Cập Nhật</label>
            <input type="text" class="form-control" id="UpdatedBy" name="UpdatedBy" placeholder="Người Dùng 2">
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a class="btn btn-secondary" href="{{route("show.categories")}}" >Quay lại</a>
    </form>
</div>
@endsection
