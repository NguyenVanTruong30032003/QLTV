@extends('master_site')

@section('pages_contend_user')
<style>
    /* Vùng chứa ảnh sách */
    .product__item__pic {
        position: relative;
        width: 100%;
        height: 400px; /* Chiều cao cố định */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
    }

    .product__item__pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Hiệu ứng hover trên ảnh */
    .product__item__pic:hover img {
        filter: brightness(0.8);
        transition: filter 0.3s ease;
    }

    /* Các icon được căn chỉnh ngang */
    .product__hover {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px; /* Khoảng cách giữa các icon */
        opacity: 0; /* Ẩn nút ban đầu */
        transition: opacity 0.3s ease;
    }

    .product__item__pic:hover .product__hover {
        opacity: 1; /* Hiện nút khi hover */
    }

    /* Nút thêm vào giỏ mượn (chỉ với icon) */
    .add-to-borrow,
    .image-popup {
        font-size: 24px;
        color: #007bff;
        border: none;
        cursor: pointer;
        background-color: transparent;
        transition: color 0.3s;
    }

    .add-to-borrow:hover,
    .image-popup:hover {
        color: #0056b3;
    }

    /* Nút phóng to ảnh */
    .product__hover a {
        color: #fff;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 10px;
        border-radius: 50%;
        text-align: center;
    }
</style>

<section class="property-details spad">
    <div class="container">
        <div class="row property__gallery">
            @foreach ($books as $book)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <!-- Hiển thị ảnh sách -->
                    <div class="product__item__pic">
                        <img src="{{ asset('storage/' . $book->Images) }}" alt="{{ $book->Name }}" class="img-fluid">
                        <ul class="product__hover">
                            <!-- Nút phóng to ảnh -->
                            <li>
                                <a href="{{ asset('storage/' . $book->Images) }}" class="image-popup">
                                    <span class="arrow_expand"></span>
                                </a>
                            </li>
                            <!-- Nút thêm vào phiếu mượn với icon -->
                            <li>
                                <form action="{{ route('addToBorrow', $book->Id) }}" method="POST" class="add-to-borrow-form">
                                    @csrf
                                    <button type="button" class="add-to-borrow">
                                        <span class="icon_bag_alt"></span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <!-- Hiển thị văn bản thông tin sách -->
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

<!-- Sử dụng SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Xử lý nút "Add to Borrow" bằng AJAX
    document.querySelectorAll('.add-to-borrow').forEach(button => {
        button.addEventListener('click', function() {
            let form = this.closest('form'); // Tìm form chứa nút bấm
            let formData = new FormData(form); // Lấy dữ liệu từ form

            // Gửi yêu cầu Ajax
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Đảm bảo gửi yêu cầu Ajax
                }
            })
            .then(response => response.json()) // Chuyển đổi phản hồi thành JSON
            .then(data => {
                if (data.success) {
                    // Hiển thị thông báo thành công với SweetAlert
                    Swal.fire({
                        title: 'Thành công!',
                        text: 'Sách đã được thêm vào giỏ mượn!',
                        icon: 'success',
                        confirmButtonText: 'Đóng'
                    });
                } else {
                    // Hiển thị thông báo lỗi
                    Swal.fire({
                        title: 'Lỗi!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'Đóng'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Đã xảy ra lỗi!',
                    text: 'Không thể thêm sách vào giỏ mượn.',
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            });
        });
    });
</script>
@endsection
