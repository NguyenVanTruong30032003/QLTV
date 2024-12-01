@extends('admin.master_layout')

@section('page_content')
<div class="container mt-4">
    <div class="bg-light rounded p-4">
        <h4>Chi Tiết Người Dùng</h4>
        <div class="d-flex align-items-center">
            <!-- Ảnh bên trái -->
            <div class="me-4">
                @if($user->Avatar) <!-- Hiện ảnh nếu có -->
                    <img src="{{ asset('storage/' . $user->Avatar) }}" alt="Ảnh đại diện" class="rounded-circle img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                @else
                    <p class="text-muted">Chưa cập nhật ảnh</p>
                @endif
            </div>
            
            <!-- Thông tin người dùng bên phải -->
            <div>
                
                <p><strong>Họ & Tên:</strong> {{ $user->Full_name }}</p>
                <p><strong>Email:</strong> {{ $user->Email }}</p>
                <p><strong>Số Điện Thoại:</strong> {{ $user->Phone }}</p>
                <p><strong>Địa Chỉ:</strong> {{ $user->Address }}</p>
                <p><strong>Vai Trò:</strong> {{ $user->Role_id == 2 ? 'Quản Trị' : 'Người Dùng' }}</p>
            </div>
        </div>
    </div>
</div>

             
@endsection
