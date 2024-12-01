@extends('admin.master_layout')

@section('page_content')
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Thêm sách</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-tools">
                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>
        <div class="ibox-body">
            <!-- Thêm enctype vào form để xử lý file upload -->
            <form class="form-horizontal" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" id="form-sample-1" novalidate="novalidate">
                @csrf 

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tên sách</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                        @if($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Thông tin</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="About" value="{{ old('About') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Thể loại</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="Categories_id" required>
                            <option value="">Chọn thể loại</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->Id }}" {{ old('Categories_id') == $category->Id ? 'selected' : '' }}>
                                    {{ $category->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nhà xuất bản</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="Publisher_id" required>
                            <option value="">Chọn nhà xuất bản</option>
                            @foreach($publis as $publis)
                                <option value="{{ $publis->Id }}" {{ old('Publisher_id') == $publis->Id ? 'selected' : '' }}>
                                    {{ $publis->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Số lượng nhập</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="Quantity" value="{{ old('Quantity') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Giá trị</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="Price" value="{{ old('Price') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hình ảnh</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="Images" value="{{ old('Images') }}" multiple>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tác giả</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="author" value="{{ old('author') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Năm xuất bản</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="Publised_year" value="{{ old('Publised_year') }}">
                    </div>
                </div> 

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Người thêm</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="Create_by" value="{{ old('Create_by') }}">
                    </div>
                </div>

                <div class="form-group at-3 mb-5">
                    <label>
                        <input type="checkbox" name="IsActive" value="1" {{ old('IsActive') ? 'checked' : '' }}>
                        Hiển thị
                    </label>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                        <button class="btn btn-info" type="submit">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
@endsection
