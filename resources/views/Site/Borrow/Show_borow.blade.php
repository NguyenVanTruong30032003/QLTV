@extends('master_site')
@section('pages_contend_user')
    <section class="shop-cart spad">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (count($borrowCart) > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sách</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrowCart as $index => $item)
                                    <tr>
                                        <td class="cart__product__item">
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 100px; height: auto;">
                                        </td>
                                        <td class="cart__price">{{ $item['name'] }}</td>
                                        <td class="cart__close">
                                            <form action="{{ route('borrow.remove', $index) }}" method="POST" class="remove-from-cart-form">
                                                @csrf
                                                @method('DELETE') <!-- Điều này sẽ thay đổi phương thức HTTP thành DELETE -->
                                                <button type="submit" class="remove-from-cart">
                                                    <span class="icon_close"></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Thông tin mượn</h6>
                        <ul>
                            <li>Ngày mượn <input type="date" class="form-control"></li>
                            <li>Ngày trả <input type="date" class="form-control"></li>
                        </ul>
        
                        <form action="{{ route('borrow.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="primary-btn">Tạo phiếu mượn</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                Giỏ mượn của bạn đang trống. Hãy chọn sách để thêm vào giỏ.
            </div>
        @endif
        
        </div>
    </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
<script>
    document.querySelectorAll('.remove-from-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Ngừng hành động mặc định của form

            const form = this.closest('form'); // Tìm form gần nhất
            const url = form.action; // Lấy URL của form

            // Hiển thị thông báo xác nhận xóa sản phẩm
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gửi yêu cầu xóa qua AJAX sử dụng axios
                    axios.delete(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',  // Đảm bảo là yêu cầu AJAX
                            'Content-Type': 'application/x-www-form-urlencoded'  // Đặt content type cho form submission
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            // Xóa dòng trong bảng nếu xóa thành công
                            const row = this.closest('tr');
                            row.remove();
                            Swal.fire('Đã xóa!', 'Sản phẩm đã được xóa khỏi giỏ.', 'success');
                        } else {
                            Swal.fire('Lỗi', 'Không thể xóa sản phẩm, vui lòng thử lại!', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Lỗi', 'Đã có lỗi xảy ra khi xóa sản phẩm.', 'error');
                    });
                }
            });
        });
    });
</script>

@endsection
