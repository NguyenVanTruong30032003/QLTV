@extends('master_site')

@section('pages_contend_user')
<style>
    .product__item__pic {
        position: relative;
        width: 100%;
        height: 400px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
    }

    /* Vùng chứa các nút hover */
    .product__hover {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px; /* Khoảng cách giữa các nút */
        opacity: 0; /* Ẩn nút ban đầu */
        transition: opacity 0.3s ease;
    }

    /* Khi hover vào ảnh */
    .product__item__pic:hover .product__hover {
        opacity: 1; /* Hiển thị các nút */
    }

    /* Hiệu ứng hover ảnh */
    .product__item__pic:hover img {
        filter: brightness(0.8);
        transition: filter 0.3s ease;
    }

    /* Cố định kích thước ảnh */
    .product__item__pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Nút hover */
    .product__hover a, .add-to-borrow {
        color: #fff;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 10px;
        border-radius: 50%;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    /* Hiệu ứng khi hover vào nút */
    .product__hover a:hover, .add-to-borrow:hover {
        background-color: #007bff;
        transform: scale(1.1); /* Phóng to nhẹ */
    }
</style>

<section class="property-details spad">
    <div class="container">
        <div class="row property__gallery">
            @foreach ($books as $book)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <!-- Ảnh sách -->
                    <div class="product__item__pic">
                        <img src="{{ asset('storage/' . $book->Images) }}" alt="{{ $book->Name }}" class="img-fluid">
                        <ul class="product__hover">
                            <!-- Nút phóng to ảnh -->
                            <li>
                                <a href="{{ asset('storage/' . $book->Images) }}" data-lightbox="gallery-{{ $book->Id }}">
                                    <span class="arrow_expand"></span>
                                </a>
                            </li>
                            <!-- Nút thêm vào phiếu mượn -->
                            <li>
                                <form action="{{ route('addToBorrow', $book->Id) }}" method="POST" class="add-to-borrow-form">
                                    @csrf
                                    <button type="button" class="add-to-borrow" data-book-id="{{ $book->Id }}">
                                        <span class="icon_bag_alt"></span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- Thông tin sách -->
                    <div class="product__item__text">
                        <h6>
                            <a href="{{ route('showchitiet', ['id' => $book->Id]) }}">{{ $book->Name }}</a>
                        </h6>
                        <div class="product__price">{{ $book->About }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Import thư viện Lightbox -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />

<!-- Import thư viện SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
</script>
@endsection
