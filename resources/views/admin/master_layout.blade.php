<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset("imgfavicon.ico")}}" rel="icon">

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h5 class="text-primary"></i>QUẢN LÝ THƯ VIỆN</h5>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                   
                </div>
                <div class="navbar-nav w-100">
                    <a href="/admin/show_menus" class="nav-item nav-link active"><i class="fa-solid fa-bars"></i>Quản Lý Menu</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-book"></i>Quản Lý Sách</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="/admin/show_books" class="dropdown-item">Sách</a>
                            <a href="/admin/show_category" class="dropdown-item">Thể Loại Sách</a>
                            <!--<a href="element.html" class="dropdown-item">Other Elements</a>-->
                        </div>
                    </div>
                    <a href="/admin/show_publisher" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Quản Lý Nhà XB</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi-person-fill"></i>Quản Lý tài khoản</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('show_useradmin')}}" class="dropdown-item">Quản trị</a>
                            <a href="{{route('show_user')}}" class="dropdown-item">người dùng</a>
                            
                            <!--<a href="element.html" class="dropdown-item">Other Elements</a>-->
                        </div>
                    </div>
                    <a href="/admin/borrow" class="nav-item nav-link"><i class="bi-cart-fill"></i>Quản Lý Đơn Mượn</a>
                    <a href="/admin/book-stats" class="nav-item nav-link"><i class="bi-cart-fill"></i>Thống kê</a>
                    
                   
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{asset("img/user.jpg")}}" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{asset("img/user.jpg")}}" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{asset("img/user.jpg")}}" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        
                            <span class="d-none d-lg-inline-flex"> {{Auth::user()->Full_name}}</span> <!-- Hiển thị tên người dùng -->
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ route('my_profile') }}" class="dropdown-item">Tài Khoản </a>
                           
                            <a href="{{route('log_out')}}" class="dropdown-item">Thoát</a>
                        </div>
                    </div>
                    
                </div>
            </nav>
            <!-- Navbar End -->


            @yield('page_content')


          
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
    <script src="{{asset('lib/chart/chart.min.js')}}"></script> 
    @stack('scripts')
    
</body>

</html>