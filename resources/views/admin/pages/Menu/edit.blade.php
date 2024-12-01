@extends('admin.master_layout')

@section('page_content')
<main id="main" class="main">
    <div class="container shadow p-5">
        <div class="row pb-2">
            <h2>Sửa thông tin menu</h2>
        </div>

        <!-- Laravel form -->
        <form method="POST" action="{{ route('update.menus', ['id' => $menu->Id]) }}">
            @csrf
            @method('PUT') <!-- Sử dụng PUT nếu bạn muốn -->

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tên Menu</label>
                <div class="col-sm-10">
                    <input name="Name" type="text" class="form-control" value="{{ old('Name', $menu->Name) }}" placeholder="Nhập tên menu" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Mức độ mục</label>
                <div class="col-sm-10">
                    <input name="Item_level" type="number" class="form-control" value="{{ old('Item_level', $menu->Item_level) }}" placeholder="Nhập mức độ mục" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Cấp cha</label>
                <div class="col-sm-10">
                    <input name="Parent_level" type="number" class="form-control" value="{{ old('Parent_level', $menu->Parent_level) }}" placeholder="Nhập cấp cha" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Thứ tự mục</label>
                <div class="col-sm-10">
                    <input name="Item_oder" type="number" class="form-control" value="{{ old('Item_oder', $menu->Item_oder) }}" placeholder="Nhập thứ tự mục" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Biểu tượng</label>
                <div class="col-sm-10">
                    <input name="Icon" type="text" class="form-control" value="{{ old('Icon', $menu->Icon) }}" placeholder="Nhập biểu tượng">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Route</label>
                <div class="col-sm-10">
                    <input name="Route" type="text" class="form-control" value="{{ old('Route', $menu->Route) }}" placeholder="Nhập route">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Người tạo</label>
                <div class="col-sm-10">
                    <input name="Create_by" type="text" class="form-control" value="{{ old('Create_by', $menu->Create_by) }}" placeholder="Người tạo" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Ngày tạo</label>
                <div class="col-sm-10">
                    <input name="Create_date" type="text" class="form-control" value="{{ old('Create_date', $menu->Create_date) }}" placeholder="Ngày tạo" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Ngày sửa</label>
                <div class="col-sm-10">
                    <input name="Update_date" type="text" class="form-control" value="{{ old('Update_date', \Carbon\Carbon::now()) }}" placeholder="Ngày sửa" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Người sửa</label>
                <div class="col-sm-10">
                    <input name="Update_by" type="text" class="form-control" value="{{ old('Update_by') }}" placeholder="Nhập người sửa" required>
                </div>
            </div>

            <div class="form-group at-3 mb-5">
                <label>
                    <input type="checkbox" name="IsActive" {{ old('IsActive', $menu->IsActive) ? 'checked' : '' }}>
                    Hiển thị
                </label>
            </div>

            <button type="submit" class="btn btn-lg btn-success p-2">Lưu thông tin</button>
            <a href="{{ route('show.menus') }}" class="btn btn-lg btn-warning p-2">Quay lại</a>
        </form>
        
    </div>
</main>
@endsection
