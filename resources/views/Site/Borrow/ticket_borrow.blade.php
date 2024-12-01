<div class="container mt-5">
    <h2 class="my-4 text-center text-primary">Tạo Phiếu Mượn</h2>

    <div class="user-info mb-4 p-4 border rounded-3 shadow-sm bg-light">
        <p><strong>Tên người mượn:</strong> {{ $user->Full_name }}</p>
        <p><strong>Email:</strong> {{ $user->Email }}</p>
        <p><strong>Số điện thoại:</strong> {{ $user->Phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $user->Address }}</p>
    </div>

   
   
    @if(count($borrowCart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên Sách</th>
                    <th>Ảnh</th>
                    <th>Thông Tin</th>
                    <th>Tác Giả</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowCart as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 100px; height: auto;">
                    </td>
                    <td>{{ $item['about'] ?? 'Thông tin không có' }}</td> <!-- Kiểm tra trường 'about' -->
                    <td>{{ $item['author'] ?? 'Tác giả không có' }}</td> <!-- Kiểm tra trường 'author' -->
                    <td>
                        <form action="{{ route('borrow.remove', $index) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="actions text-center mt-4">
            <form action="{{ route('borrow.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-lg px-5 py-3">Tạo Phiếu Mượn</button>
            </form>
        </div>
    @else
        <p class="text-center text-warning mt-3">Giỏ mượn của bạn đang trống.</p>
    @endif
</div>
<style>
    /* Cải thiện giao diện tổng thể */
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }

    .container {
        margin-top: 50px;
    }

    /* Các style cho các phần của form */
    h2, h3 {
        font-weight: bold;
        color: #007bff;
    }

    .user-info {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .user-info p {
        font-size: 1.1rem;
        color: #555;
    }

    /* Cải tiến bảng sách */
    .table {
        margin-top: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        border-collapse: collapse;
    }

    .table th, .table td {
        vertical-align: middle;
        text-align: center;
        padding: 12px;
    }

    .table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .img-fluid {
        max-width: 100px;
        height: auto;
        border-radius: 5px;
    }

    /* Cải tiến nút "Lưu Phiếu Mượn" */
    .btn-lg {
        padding: 0.75rem 1.25rem;
        font-size: 1.1rem;
        font-weight: bold;
        border-radius: 25px;
        text-transform: uppercase;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #fda500;
        transform: translateY(-2px);
    }

    .btn-success:focus {
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.5);
    }

    /* Cải thiện thông báo giỏ mượn trống */
    .text-warning {
        font-size: 1.2rem;
        font-weight: bold;
    }
</style>
