@extends('master_site')

@section('pages_contend_user')
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <!-- Phần hình ảnh nhỏ -->
            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <div class="product__details__pic border rounded p-2 shadow-sm">
                    <img src="{{ asset('storage/' . $book->Images) }}" alt="Product Image" class="product__big__img rounded">
                </div>
            </div>

            <!-- Phần thông tin sách -->
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h2><strong>{{ $book->Name }}</strong></h2>
                    <p><strong>Thông tin:</strong> {{ $book->About }}</p>
                    <p><strong>Nhà Xuất Bản:</strong> {{ $book->publisher->Name ?? 'N/A' }}</p>
                    <p><strong>Địa Chỉ:</strong> {{ $book->publisher->Address ?? 'N/A' }}</p>
                    <p><strong>Điện thoại:</strong> {{ $book->publisher->Phone ?? 'N/A' }}</p>
                    <p><strong>Năm xuất bản:</strong> {{ $book->Publiser_year }}</p>
                    <p><strong>Tác giả:</strong> {{ $book->Author }}</p>
                    <div class="product__details__button">
                        <!-- Form thêm vào giỏ mượn -->
                        <form id="add-to-borrow-form" action="{{ route('addToBorrow', $book->Id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary add-to-borrow">
                                <i class="fa fa-shopping-cart"></i> Thêm vào giỏ mượn
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="alert-container"></div> <!-- Div để hiển thị thông báo -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>

<script>
    // Lắng nghe sự kiện submit form
    document.querySelector('.add-to-borrow').addEventListener('click', function(e) {
        e.preventDefault(); // Ngừng hành động mặc định của form

        let form = this.closest('form'); // Tìm form chứa nút bấm
        let formData = new FormData(form); // Lấy dữ liệu từ form

        // Gửi yêu cầu AJAX với Axios
        axios.post(form.action, formData)
            .then(response => {
                if (response.data.success) {
                    // Hiển thị thông báo thành công
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: response.data.message,
                        timer: 3000
                    });
                } else {
                    // Hiển thị thông báo lỗi
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: response.data.message,
                        timer: 3000
                    });
                }
            })
            .catch(error => {
                // Nếu có lỗi khi gửi yêu cầu
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Đã có lỗi xảy ra khi thêm sách vào giỏ mượn.',
                    timer: 3000
                });
            });
    });
</script>
@endsection
<style>
    .product__details__pic {
        width: 100%;
        height: auto;
    }

    .product__big__img {
        width: 100%;
        height: 600px;
        object-fit: cover;
        border-radius: 5px;
    }

    .product__details__text {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .product__details__button .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: 0.3s ease;
    }

    .product__details__button .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>
