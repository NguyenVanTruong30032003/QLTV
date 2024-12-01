@extends('master_site')

@section('pages_contend_user')    

<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Liên Hệ Với Chúng Tôi</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="contact-info">
                <h4 class="mb-3">Thông Tin Liên Hệ</h4>
                <ul class="list-unstyled">
                    <li><i class="bi bi-geo-alt-fill"></i> <strong>Địa chỉ:</strong> 123 Đường Lê Hồng Sơn, Thành phố Vinh</li>
                    <li><i class="bi bi-telephone-fill"></i> <strong>Điện thoại:</strong> (+84) 123 456 789</li>
                    <li><i class="bi bi-envelope-fill"></i> <strong>Email:</strong> Admin@website.com</li>
                    <li><i class="bi bi-clock-fill"></i> <strong>Giờ làm việc:</strong> 9:00 AM - 6:00 PM (Thứ Hai - Thứ Sáu)</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="about-me">
                <h4 class="mb-3">Giới Thiệu Bản Thân</h4>
                <div class="d-flex align-items-center mb-3">
                    <!-- Thêm ảnh vào phần giới thiệu bản thân -->
                    <img src="{{ asset('img/1731144618.jpg') }}" alt="Ảnh mô tả" class="img-fluid rounded-circle shadow-lg me-4" style="width: 120px; height: 120px; object-fit: cover;"/>

                    <div>
                        <p>Xin chào! Tôi là Nguyễn Văn Trường, hiện tại tôi đang là sinh viên năm 4 ngành CNTT, Trường ĐH Vinh. Tôi đam mê công nghệ và luôn muốn cải thiện bản thân mỗi ngày. Nếu bạn có bất kỳ câu hỏi nào, đừng ngần ngại liên hệ với tôi qua thông tin ở trên.</p>
                        <p>Rất mong được làm việc và trao đổi với bạn!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Thêm form liên hệ -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h4 class="text-center text-primary mb-4">Gửi Liên Hệ</h4>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và Tên</label>
                    <input type="text" class="form-control" id="name" placeholder="Nhập tên của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Nhập email của bạn" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Tin nhắn</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Nhập tin nhắn của bạn" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection  <!-- Kết thúc phần nội dung -->

@section('css')
<!-- Icon Bootstrap 5 (bi-icons) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
    .about-me img {
        border-radius: 90%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .about-me {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .about-me p {
        font-size: 16px;
        color: #555;
    }
</style>
@endsection
