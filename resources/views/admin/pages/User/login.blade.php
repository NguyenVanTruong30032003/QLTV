<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập vào Admin</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center">Đăng nhập</h2>
                @if (session('message'))
                @if(is_array(session('message')))
                    <div class="alert alert-info">{{ implode(', ', session('message')) }}</div>
                @else
                    <div class="alert alert-info">{{ session('message') }}</div>
                @endif
                {{ session()->forget('message') }} <!-- Xóa thông báo sau khi hiển thị -->
            @endif
                <form action="{{ route('check_login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="ma_av">Mã sinh viên:</label>
                        <input type="text" name="ma_sv" class="form-control" required autofocus>
                        @error('ma_sv')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('register_user') }}">Chưa có tài khoản? Đăng ký ngay!</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
