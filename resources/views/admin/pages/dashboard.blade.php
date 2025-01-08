@extends('admin.master_layout')
@section('page_content')
<div class="marquee-container">
    <div class="marquee">
        <span>CHÀO MỪNG {{ Auth::user()->Full_name }} ĐẾN VỚI TRANG QUẢN TRỊ
        </span>
    </div>
</div>

<style>

.marquee-container {
    position: fixed;  
    top: 50%; 
    left: 50%;  
    transform: translate(-50%, -50%);  
    width: 80%;  
    overflow: hidden;
    background-color: #85bcde;
}

.marquee {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 10s linear infinite;
    color: rgb(2, 12, 25);
    font-size: 30px;
    font-family: 'Merriweather', serif;


    padding: 50px;
}

@keyframes marquee {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(-100%);
    }
}


</style>
@endsection