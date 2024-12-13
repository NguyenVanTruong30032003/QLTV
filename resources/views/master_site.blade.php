
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset("site/css/bootstrap.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("site/css/font-awesome.min.css" )}}" type="text/css">
    <link rel="stylesheet" href="{{asset("site/css/elegant-icons.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("site/css/jquery-ui.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("site/css/magnific-popup.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("site/css/owl.carousel.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("site/css/slicknav.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("site/css/style.css")}}" type="text/css">
	<style>
	.categories__large__item {
    position: relative;
    height: 300px; /* Đặt chiều cao cố định cho ô lớn bên trái */
}

.categories__item {
    position: relative;
    height: 300px; /* Đặt chiều cao cố định cho các ô nhỏ */
}

.categories__item img {
    width: 100%;
    height: 100%; /* Đảm bảo ảnh phủ đầy ô */
    object-fit: cover; /* Giữ tỷ lệ ảnh mà không làm méo */
}

.categories__text {
    position: absolute;
    bottom: 20px;
    left: 60px; /* Điều chỉnh vị trí text */
    color: #fff;
    background-color: rgba(0, 0, 0, 0); /* Thêm nền mờ cho văn bản */
    padding: 10px;
    text-align: left;
    border-radius: 5px;
    padding-right: 20px; /* Điều chỉnh khoảng cách bên phải */
}

.categories__item.categories__large__item img {
    height: 100%; /* Đảm bảo ảnh ô lớn phủ đầy */
}

	</style>
</head>

<body>
    

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            
            <li><a href="#"><span class="icon_bag_alt"></span>
				<div class="tip">
					{{ session('br') ? count(session('br')) : 0 }} 
				</div> 
			</a></li>
			
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="{{asset("site/img/logo.png")}}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

   <!-- Header Section Begin -->
   <header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="./index.html"><img src="{{ asset('site/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ route('Trang_chu') }}">Trang chủ</a></li>
                        <li><a href="{{ route('list.book.user') }}">Sách</a></li>
                        <li><a href="#">Nhà Xuất Bản</a></li>
                        <!-- Thể Loại -->
                        <li><a href="#">Thể Loại</a>
                            <ul class="dropdown">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('show_book_in_category', ['id' => $category->Id]) }}">{{ $category->Name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="">Blog</a></li>
                        <li><a href="{{ route('contact') }}">liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            

            <!-- Tên người dùng và giỏ hàng -->
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        @if(Auth::check())  <!-- Kiểm tra xem người dùng đã đăng nhập hay chưa -->
                        <a href="{{route('imfomation')}}"  >{{ Auth::user()->Full_name }}</a> 
                            <a href="{{ route('login') }}">Đăng Xuất</a>  <!-- Liên kết đăng nhập -->
                        @else
                            <a href="{{ route('login') }}">Đăng Nhập</a>  <!-- Liên kết đăng nhập -->
                            <a href="{{ route('create_user') }}">Đăng Ký</a>  <!-- Liên kết đăng ký -->
                        @endif
                    </div>

                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="{{ route('borrow.show') }}"><span class="icon_bag_alt"></span>
                            <div class="tip">
                                {{ session('br') && count(session('br')) > 0 ? count(session('br')) : 0 }}
                            </div>
                        </a></li>
                    </ul>
                    
                    
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->


        

    <!-- Header Section End -->

 @yield('pages_contend_user')



<!-- Js Plugins -->
<script src="{{asset("site/js/jquery-3.3.1.min.js")}}"></script>
<script src="{{asset("site/js/bootstrap.min.js")}}"></script>
<script src="{{asset("site/js/jquery.magnific-popup.min.js")}}"></script>
<script src="{{asset("site/js/jquery-ui.min.js")}}"></script>
<script src="{{asset("site/js/mixitup.min.js")}}"></script>
<script src="{{asset("site/js/jquery.countdown.min.js")}}"></script>
<script src="{{asset("site/js/jquery.slicknav.js")}}"></script>
<script src="{{asset("site/js/owl.carousel.min.js")}}"></script>
<script src="{{asset("site/js/jquery.nicescroll.min.js")}}"></script>
<script src="{{asset("site/js/main.js")}}"></script>
</body>

</html>