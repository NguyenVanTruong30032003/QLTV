@extends('master_site')
@section('pages_contend_user')
<h2 class="page-title">Phiếu mượn đang chờ duyệt</h2>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="cart-table-wrapper">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sách</th>
                        <th>Tác giả</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($br as $brr)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $brr->book->Images) }}" alt="{{ $brr->book->Name }}" class="book-image">
                            </td>
                            <td class="book-title">{{ $brr->book->Name }}</td>
                            <td class="book-title">{{ $brr->book->author }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<style>
    /* Tiêu đề trang */
    .page-title {
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 30px;
        text-transform: uppercase;
    }

    /* Khung bảng */
    .cart-table-wrapper {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Bảng chính */
    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-table thead {
        background: #007bff;
        color: #fff;
    }

    .cart-table thead th {
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        padding: 15px;
    }

    .cart-table tbody tr {
        background: #fff;
        border-bottom: 1px solid #ddd;
        transition: background-color 0.3s ease;
    }

    .cart-table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .cart-table td {
        text-align: center;
        padding: 15px;
    }

    /* Ảnh sách */
    .book-image {
        width: 100px;
        height: auto;
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .book-image:hover {
        transform: scale(1.2);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Tên sách */
    .book-title {
        font-size: 18px;
        font-weight: 500;
        color: #34495e;
        text-align: left;
    }
</style>

