@extends('master_site')
@section('pages_contend_user')
<h2>Phiếu mượn đang chờ duyệt</h2>
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
                    @foreach ($br as $brr )
                        <tr>
                            <td class="cart__product__item">
                                <img src="{{ asset('storage/' .  $brr->book->Images) }}" style="width: 100px; height: auto;">
                            </td>
                            <td class="cart__price">{{ $brr->book->Name }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
