  @extends('master_site')
  @section('pages_contend_user')
  <style>
 .product__item__pic {
    position: relative;
    width: 100%;
    height: !00%;  /* Đặt chiều cao cố định cho phần ảnh */
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
}

.product__item__pic img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    transition: transform 0.3s ease;  /* Hiệu ứng mượt khi hover */
}

.product__item__pic:hover img {
    transform: scale(1.1);  /* Tăng kích thước ảnh khi hover */
}

.product__hover {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    background-color: rgba(0, 0, 0, 0.5);
    transition: opacity 0.3s ease;
    border-radius: 5px;
}

.product__item__pic:hover .product__hover {
    opacity: 1;
}

.product__hover li {
    list-style: none;
    margin: 0 10px;
}
.add-to-borrow {
    position: relative;
    display: inline-block;
    padding: 10px;
    background-color: #f0ad4e;
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 20px;
    cursor: pointer;
    transition: transform 0.3s ease, background-color 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.add-to-borrow:hover {
    background-color: #e68a00;
    transform: scale(1.1);  /* Tăng kích thước khi hover */
}

.add-to-borrow:focus {
    outline: none;  /* Bỏ outline khi nhấn */
}

.add-to-borrow .icon_bag_alt {
    font-size: 24px;
}

  </style>
  <!-- Categories Section Begin -->
   <section class="categories">
    <div class="container-fluid">
        <div class="row">
            <!-- Ô lớn bên trái -->
            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                <div class="categories__item categories__large__item">
                    <img src="{{ asset('site/img/categories/category-1.jpg') }}" alt="Fashion" class="img-fluid">
                    <div class="categories__text">
                        <h4>Fashion</h4>
                        <p>300 items</p>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
        
            <!-- 4 ô nhỏ bên phải -->
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item">
                            <img src="{{ asset('site/img/categories/category-2.jpg') }}" alt="Cosmetics" class="img-fluid">
                            <div class="categories__text">
                                <h4>Cosmetics</h4>
                                <p>159 items</p>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item">
                            <img src="{{ asset('site/img/categories/category-3.jpg') }}" alt="Accessories" class="img-fluid">
                            <div class="categories__text">
                                <h4>Accessories</h4>
                                <p>120 items</p>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item">
                            <img src="{{ asset('site/img/categories/category-4.jpg') }}" alt="Shoes" class="img-fluid">
                            <div class="categories__text">
                                <h4>Shoes</h4>
                                <p>80 items</p>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item">
                            <img src="{{ asset('site/img/categories/category-5.jpg') }}" alt="Bags" class="img-fluid">
                            <div class="categories__text">
                                <h4>Bags</h4>
                                <p>200 items</p>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<!-- Categories Section End -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- Product Section Begin -->
<section class="product spad">
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="section-title">
                <h4>Tất cả sản phẩm</h4>
            </div>
        </div>
     
        
    </div>
    <div class="row property__gallery">
        @foreach ($books as $book)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="product__item">
            <!-- Phần hiển thị ảnh sách -->
            <div class="product__item__pic">
                <img src="{{ asset('storage/' . $book->Images) }}" alt="{{ $book->Name }}" class="img-fluid">
                <ul class="product__hover">
                    <li><a href="{{ asset('storage/' . $book->Images) }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                    
                    <form action="{{ route('addToBorrow', $book->Id) }}" method="POST" class="add-to-borrow-form" style="display:inline;">
                        @csrf
                        <button type="button" class="add-to-borrow" data-book-id="{{ $book->Id }}"><span class="icon_bag_alt"></span></button>
                    </form>
                    
                    
                </ul>
            </div>

            <!-- Phần văn bản hiển thị thông tin sách -->
            <div class="product__item__text">
                <h6><a href="{{ route('showchitiet', ['id' => $book->Id]) }}">{{ $book->Name }}</a></h6>

                
                <div class="product__price">{{ $book->About }}</div>
            </div>
            
        </div>
    </div>
@endforeach
<div class="container">
    <div class="d-flex justify-content-center mt-4">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
</div>

    </div>
    
</div>
</section>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-duallistbox/4.0.2/bootstrap-duallistbox.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-duallistbox/4.0.2/jquery.bootstrap-duallistbox.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 // Xử lý nút "Thêm vào phiếu mượn"
 document.querySelectorAll('.add-to-borrow').forEach(button => {
        button.addEventListener('click', function () {
            let form = this.closest('form');
            let bookId = this.dataset.bookId; // Lấy bookId từ data attribute
            let formData = new FormData(form);

            // Gửi AJAX request đến route addToBorrow
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',  // Đảm bảo là AJAX request
                    'Accept': 'application/json'  // Đảm bảo nhận dữ liệu trả về dưới dạng JSON
                }
            })
            .then(response => response.json())  // Chuyển dữ liệu trả về thành JSON
            .then(data => {
                // Kiểm tra kết quả từ server
                if (data.success) {
                    // Hiển thị thông báo thành công
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: "Đã thêm sách vào phiếu mượn!",
                        timer: 3000
                    });
                } else {
                    // Hiển thị thông báo lỗi nếu không thành công
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: "Bạn chỉ mượn được một cuốn sách này",
                        timer: 3000
                    });
                }
            })
            .catch(error => {
                // Hiển thị thông báo khi có lỗi xảy ra trong quá trình gửi request
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: "Đã xảy ra lỗi. Vui lòng thử lại!",
                    timer: 3000
                });
            });
        });
    });

// Hàm cập nhật số lượng giỏ mượn trên header
function updateCartCount(cartCount) {
    const cartTip = document.querySelector('.tip');
    if (cartTip) {
        cartTip.textContent = cartCount;  // Cập nhật số lượng trong giỏ
    }
}

// Hàm cập nhật số lượng giỏ mượn trên header
function updateCartCount(cartCount) {
    const cartTip = document.querySelector('.tip');
    if (cartTip) {
        cartTip.textContent = cartCount;  // Cập nhật số lượng trong giỏ
    }
}

</script>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/ht-1.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Chain bucket bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/ht-2.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Pendant earrings</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/ht-3.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Cotton T-Shirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best seller</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/bs-1.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Cotton T-Shirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/bs-2.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Zip-pockets pebbled tote <br />briefcase</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/bs-3.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Round leather bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Feature</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/f-1.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Bow wrap skirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/f-2.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Metallic earrings</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/f-3.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Flap cross-body bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->

<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <img src="{{asset("site/img/discount.jpg")}}" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <span>Discount</span>
                        <h2>Summer 2019</h2>
                        <h5><span>Sale</span> 50%</h5>
                    </div>
                    <div class="discount__countdown" id="countdown-time">
                        <div class="countdown__item">
                            <span>22</span>
                            <p>Days</p>
                        </div>
                        <div class="countdown__item">
                            <span>18</span>
                            <p>Hour</p>
                        </div>
                        <div class="countdown__item">
                            <span>46</span>
                            <p>Min</p>
                        </div>
                        <div class="countdown__item">
                            <span>05</span>
                            <p>Sec</p>
                        </div>
                    </div>
                    <a href="#">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount Section End -->





<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    cilisis.</p>
                    <div class="footer__payment">
                        <a href="#"><img src="{{asset("site/img/payment/payment-1.png")}}" alt=""></a>
                        <a href="#"><img src="{{asset("site/img/payment/payment-2.png")}}" alt=""></a>
                        <a href="#"><img src="{{asset("site/img/payment/payment-3.png")}}" alt=""></a>
                        <a href="#"><img src="{{asset("site/img/payment/payment-4.png")}}" alt=""></a>
                        <a href="#"><img src="{{asset("site/img/payment/payment-5.png")}}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Account</h6>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Orders Tracking</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Wishlist</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#">
                        <input type="text" placeholder="Email">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer__copyright__text">
                    <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->
@endsection