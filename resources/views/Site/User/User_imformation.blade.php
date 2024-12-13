@extends('master.site')

@section('title', 'Thông Tin Người Dùng')

@section('pages_contend_user')
<div class="container mt-5">
    <h2>Thông Tin Người Dùng</h2>

    <p><strong>Tên:</strong> {{ $user->Full_name }}</p>
    <p><strong>Email:</strong> {{ $user->Email }}</p>
    <p><strong>Số điện thoại:</strong> {{ $user->Phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $user->Address }}</p>
</div>

@endsection
