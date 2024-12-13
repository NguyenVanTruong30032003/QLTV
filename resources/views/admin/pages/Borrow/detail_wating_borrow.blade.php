@extends('admin.master_layout')
@section('page_content')

<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">Phiếu mượn</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Thông tin phiếu </li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox invoice">
        <div class="invoice-header">
            <div class="row">
                <div class="col-6">

                    <div>
                        <div class="m-b-5 font-bold">Thông tin sinh viên </div>
                        <ul class="list-unstyled m-t-10">
                            <li class="m-b-5">
                                <span class="font-strong">Tên:</span> {{ $student->Full_name }}
                            </li>
                            <li class="m-b-5">
                                <span class="font-strong">Email:</span> {{ $student->Email }}
                            </li>
                            <li class="m-b-5">
                                <span class="font-strong">Số điện thoại:</span> {{ $student->Phone }}
                            </li>
                            <li>
                                <span class="font-strong">Mã sinh viên:</span> {{ $student->SV_id }}
                            </li>
                        </ul>
                    </div>
                    

                </div>

            </div>
        </div>


        <table class="table table-striped no-margin table-invoice">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($br as $bor)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $bor->book->Images) }}" alt="" style="width: 80px; height: 120px">
                    </td>
                    
                    <td>{{ $bor->book->Name }}</td>
                    <td>{{ $bor->book->author }}</td>
                    <td>
                        <a class="btn btn-default btn-xs m-r-5" title="Xem chi tiết">
                            <i class="fa fa-eye font-14"></i></a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table no-border">
            <thead>
                <tr>
                    <th></th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-right">
                    <td class="font-bold font-18">Ngày mượn:</td>
                    <td class="font-bold font-18">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td> <!-- Hiển thị ngày hiện tại -->
                </tr>
                <tr class="text-right">
                    <td class="font-bold font-18">Ngày trả:</td>
                    <td class="font-bold font-18">{{ \Carbon\Carbon::now()->addMonth()->format('d/m/Y') }}</td> <!-- Thay thế bằng biến chứa ngày trả -->
                </tr>
            </tbody>
        </table>
        <div class="text-right">
            <button class="btn btn-primary" type="button" onclick="window.history.back();">
                <i></i> Quay lại
            </button>
            <a class="btn btn-success  btn-add-borrow" data-id="{{ $br_ok->Id }}" title="Xác nhận phiếu ">
                                <span >Xác nhận phiếu</span></a>
        </div>

    </div>


    <style>
        .invoice {
            padding: 20px
        }

        .invoice-header {
            margin-bottom: 50px
        }

        .invoice-logo {
            margin-bottom: 50px;
        }

        .table-invoice tr td:last-child {
            text-align: right;
        }
    </style>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.btn-add-borrow', function() {
            let _id = $(this).data("id");
            Swal.fire({

                title: "Xác nhận phiếu mượn",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xác nhận",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/add_borrow/" + _id,
                        type: "POST",
                        data: {
                            
                            _token: '{{ csrf_token() }}',
                         
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Xác nhận thành công",
                                    toast: true,
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                $('#row_' + _id).remove();
                            } else {
                                toastr.error('Xac nhận  không thành công');
                            }
                        },
                        error: function() {
                            toastr.error('Có lỗi xảy ra. Vui lòng thử lại!');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection