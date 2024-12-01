@extends('admin.master_layout')

@section('page_content')
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Thêm Menu</h1>
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
                        <form class="form-horizontal" action="{{ route('store.menu') }}" method="POST" id="form-sample-1" novalidate="novalidate">

                        @csrf <!-- Thêm token CSRF để bảo vệ form -->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tên Menu</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="Name" value="{{ old('Name') }}">
                                @if($errors->has('Name'))
                                    <div class="text-danger">{{ $errors->first('Name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cấp mục</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" name="Item_level" value="{{ old('Item_level') }}" required>
                                @if($errors->has('Item_level'))
                                    <div class="text-danger">{{ $errors->first('Item_level') }}</div>
                                @endif
                            </div>
                        </div>
                        

                        

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Menu cha</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" name="Parent_level" value="{{ old('Parent_level') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Thứ Tự</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" name="Item_oder" value="{{ old('Item_order') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Biểu tượng</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="Icon" value="{{ old('Icon') }}">
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
                                <button class="btn btn-info" type="submit">Thêm Menu</button>
                                <a class="btn btn-secondary" href="{{ route('show.menus') }}">Quay lại</a>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
                
            </div>
            <!-- END PAGE CONTENT-->
            
@endsection
