<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .img_data {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.25rem;
            margin-right: 1rem; /* Khoảng cách bên phải ảnh */
        }
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <main id="main" class="main">
        <div class="container shadow p-5">
            <div class="row pb-2">
                <h2>Thông tin cá nhân của {{ $user->Full_name }}</h2>
            </div>

            <!-- Laravel form -->
            <form method="POST" action="{{ route('users.update', ['id' => $user->Id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                
                

                <!-- Field Full_name -->
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Họ và tên</label>
                    <div class="col-sm-10">
                        <input name="Full_name" type="text" class="form-control" value="{{ old('Full_name', $user->Full_name) }}" placeholder="Mời nhập họ và tên" required>
                    </div>
                </div>

                <!-- Field Avatar -->
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Ảnh đại diện</label>
                    <div class="col-sm-10 d-flex align-items-center">
                        @if($user->Avatar) <!-- Hiện ảnh nếu có -->
                            <img src="{{ asset('storage/' . $user->Avatar) }}" alt="Ảnh đại diện" class="img_data">
                            <button type="button" class="btn btn-primary mt-2" onclick="toggleFileInput()">Sửa ảnh</button>
                        @else
                            <img src="{{ asset('img/default.jpg') }}" alt="Ảnh mặc định" class="img_data">
                            <button type="button" class="btn btn-primary mt-2" onclick="toggleFileInput()">Thêm ảnh</button>
                        @endif 

                        <!-- Trường tải lên ảnh (ẩn mặc định) -->
                        <div id="fileInputContainer" style="display: none; margin-top: 10px;">
                            <input type="file" class="form-control" name="Avatar">
                            <small class="form-text text-muted">Chọn ảnh mới để thay thế ảnh hiện tại.</small>
                        </div>
                    </div>
                </div>

                <script>
                    function toggleFileInput() {
                        var fileInputContainer = document.getElementById('fileInputContainer');
                        fileInputContainer.style.display = (fileInputContainer.style.display === "none") ? "block" : "none";
                    }
                </script>

                <!-- Field Address -->
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Địa chỉ</label>
                    <div class="col-sm-10">
                        <input name="Address" type="text" class="form-control" value="{{ old('Address', $user->Address) }}" placeholder="Mời nhập địa chỉ" required>
                    </div>
                </div>

                <!-- Field Phone -->
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Số điện thoại</label>
                    <div class="col-sm-10">
                        <input name="Phone" type="text" class="form-control" value="{{ old('Phone', $user->Phone) }}" placeholder="Mời nhập số điện thoại" required>
                    </div>
                </div>

                <!-- Field Email -->
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input name="Email" type="email" class="form-control" value="{{ old('Email', $user->Email) }}" placeholder="Mời nhập email" required>
                    </div>
                </div>

                <!-- Field Update_date (ngày sửa) -->
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Ngày sửa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="Update_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}" readonly>
                    </div>
                </div>

                <!-- Checkbox IsActive -->
                <div class="form-group row mb-5">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="IsAction" {{ old('IsAction', $user->IsAction) ? 'checked' : '' }}> Kích hoạt
                    </div>
                </div>

                <!-- Buttons -->
                <button type="submit" class="btn btn-lg btn-success p-2">Lưu thông tin</button>
                <a href="{{ route('show_user') }}" class="btn btn-lg btn-warning p-2">Quay lại</a>
            </form>
        </div>
    </main>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
