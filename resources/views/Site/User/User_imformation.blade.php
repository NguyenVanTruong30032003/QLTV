@extends('master_site')
@section('pages_contend_user')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #f5f5f5;
            padding: 20px;
            border-right: 1px solid #e0e0e0;
        }

        .sidebar img {
            border-radius: 50%;
        }

        .sidebar .profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .sidebar .profile img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .sidebar .profile .username {
            font-weight: bold;
        }

        .sidebar .menu {
            list-style: none;
            padding: 0;
        }

        .sidebar .menu li {
            margin-bottom: 10px;
        }

        .sidebar .menu li a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
        }

        .sidebar .menu li a i {
            margin-right: 10px;
        }

        .sidebar .menu li a.new {
            color: red;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .content .tabs {
            display: flex;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
        }

        .content .tabs a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            border-bottom: 2px solid transparent;
        }

        .content .tabs a.active {
            border-bottom: 2px solid red;
            color: red;
        }

        .content .search-bar {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .content .search-bar input {
            flex: 1;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }

        .content .order-list {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content .order-item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #e0e0e0;
            padding: 20px 0;
        }

        .content .order-item:last-child {
            border-bottom: none;
        }

        .content .order-item img {
            width: 80px;
            height: 80px;
            margin-right: 20px;
        }

        .content .order-item .details {
            flex: 1;
        }

        .content .order-item .details .title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .content .order-item .details .price {
            color: red;
            font-weight: bold;
        }

        .content .order-item .actions {
            display: flex;
            align-items: center;
        }

        .content .order-item .actions button {
            background-color: red;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .content .order-item .actions button:last-child {
            background-color: #e0e0e0;
            color: #333;
        }

        .content .order-item .status {
            color: red;
            font-weight: bold;
        }
    </style>

    <body>
        <div class="container">
            <div class="sidebar">
                <div class="profile">
                    <img alt="User profile picture" height="50"
                        src="https://storage.googleapis.com/a1aa/image/qjeKxVa7DlXobilG2TWNGx2OBnGIytzUruBODJhHDUvGfE4TA.jpg"
                        width="50" />
                    <div>
                        <div>
                            {{ Auth::user()->Full_name }}
                        </div>
                        <a href="#">
                            Sửa Hồ Sơ
                        </a>
                    </div>
                </div>
                <ul class="menu">
                    <li>

                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-user">
                            </i>
                            Tài Khoản Của Tôi
                        </a>
                    </li>
                    <li>
                        <a class="active" href="#">
                            <i class="fas fa-shopping-cart">
                            </i>
                            Phiếu mượn
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-bell">
                            </i>
                            Thông Báo
                        </a>
                    </li>

                </ul>
            </div>
            <div class="content">
                <div class="tabs">

                    <a class="active" href="{{route('br_wait')}}">Chờ duyệt</a>
                    <a href="#">Đang mượn</a>
                    <a href="#">Đã trả</a>
                    <a href="#">Muộn</a>
                    <a href="#"> Đã hủy</a>

                </div>
                @yield('list_borrow')
            </div>
        </div>
        </div>
        </div>
    </body>
@endsection
