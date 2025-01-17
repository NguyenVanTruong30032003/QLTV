<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset("img/favicon.ico")}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset("lib/owlcarousel/assets/owl.carousel.min.css")}}" rel="stylesheet">
    <link href="{{asset("lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css")}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset("css/style.css")}}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <form  action="{{route("create_user")}}" method="post" >
                            @csrf
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            
                            <h3 style="text-align: center" >Đăng ký Tài Khoản</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="ma_sv" class="form-control" id="floatingText" placeholder="Mã sinh viên" value="{{ old('ma_sv') }}" >
                            @error('ma_sv')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="floatingText">Mã sinh viên</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="Full_name" class="form-control" id="floatingText" placeholder="Tên" value="{{ old('Full_name') }}" >
                            @error('Full_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="floatingText">Họ Tên</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingText" placeholder="Gmail" value="{{ old('email') }}" >
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="floatingText">Gmail</label>
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password_confirmation" class="form-control"  placeholder="Password_confirmation">
                            @error('password_confimation')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="floatingPassword">Nhập lại mật khẩu</label>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Đăng Ký</button>
                        <p class="text-center mb-0">Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset("lib/chart/chart.min.js")}}"></script>
    <script src="{{asset("lib/easing/easing.min.js")}}"></script>
    <script src="{{asset("lib/waypoints/waypoints.min.js")}}"></script>
    <script src="{{asset("lib/owlcarousel/owl.carousel.min.js")}}"></script>
    <script src="{{asset("lib/tempusdominus/js/moment.min.js")}}"></script>
    <script src="{{asset("lib/tempusdominus/js/moment-timezone.min.js")}}"></script>
    <script src="{{asset("lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js")}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset("js/main.js")}}"></script>
</body>

</html>