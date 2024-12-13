@extends('Site.User.User_imformation')
@section('list_borrow')

    
    <div class="search-bar">
        <input placeholder="Bạn có thể tìm kiếm theo tên Shop, ID đơn hàng hoặc Tên Sản phẩm" type="text" />
    </div>
    @foreach ( $br as $brr )
        <div class="order-list">
        <div class="order-item">
            <div class="details">
                <div class="title">
                    QLTV{{$brr->Id}}
                </div>

                <div class="status">Đang chờ 1</div>
            </div>
            <div class="actions">
                <a  href="{{route('br_wait_book_In', ['id'=>$brr['Id']])}}" >xem chi tiết</a>
                
            </div>
            <div class="price">ngày {{$brr->Create_date}}  </div>
        </div>
    </div>
    @endforeach
    


@endsection