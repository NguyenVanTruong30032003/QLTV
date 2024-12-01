<div class="container">

    
    <h2>Giỏ Mượn Sách</h2>

    @if (count($borrowCart) > 0)
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
                @foreach ($borrowCart as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                style="width: 100px; height: auto;">
                        </td>
                        <td>{{ $item['about'] ?? 'Thông tin không có' }}</td> <!-- Kiểm tra trường 'about' -->
                        <td>{{ $item['author'] ?? 'Tác giả không có' }}</td> <!-- Kiểm tra trường 'author' -->
                        <td>
                            <form action="{{ route('borrow.remove', $index) }}" method="POST" style="display:inline;"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Khu vực hành động -->
        <div class="actions text-center">
            <a href="{{ route('borrow.create') }}" class="btn btn-success">Tạo Phiếu Mượn</a>
            <a href="{{ route('Trang_chu') }}" class="btn btn-primary">Tiếp Tục Mượn Sách</a>
        </div>
    @else
        <p class="text-center">Giỏ mượn của bạn đang trống.</p>
    @endif
</div>

<style>
    .container {
        margin-top: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        text-align: center;
        padding: 10px;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f4f4f4;
        font-weight: bold;
        color: #555;
    }

    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tr:hover {
        background-color: #f1f1f1;
    }

    img {
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-danger {
        color: #fff;
        background-color: #e3342f;
        border-color: #e3342f;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn-danger:hover {
        background-color: #cc1f1a;
        border-color: #cc1f1a;
    }

    .btn-primary {
        color: #fff;
        background-color: #3490dc;
        border-color: #3490dc;
        padding: 10px 20px;
        border-radius: 5px;
        display: inline-block;
        margin-top: 20px;
        text-align: center;
        text-decoration: none;
    }

    .btn-primary:hover {
        background-color: #c0d6e7;
        border-color: #2779bd;
    }

    p {
        text-align: center;
        font-size: 18px;
        color: #777;
    }

    /* Thêm hiệu ứng hover */
    .btn-danger,
    .btn-primary {
        transition: background-color 0.3s ease-in-out, transform 0.2s;
    }

    .btn-danger:hover,
    .btn-primary:hover {
        transform: translateY(-2px);
    }

    .btn-success {
        color: #fff;
        background-color: #5518e4;
        border-color: #38c172;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        text-align: center;
        display: inline-block;
        text-decoration: none;
        margin-right: 10px;
    }

    .btn-success:hover {
        background-color: #d7fb0e;
        border-color: #2f9e59;
        transform: translateY(-2px);
        transition: background-color 0.3s ease-in-out, transform 0.2s;
    }

    .actions {
        margin-top: 20px;
        text-align: center;
    }

    .actions a {
        margin: 5px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const action = form.action;

            // Gửi request xóa bằng AJAX
            fetch(action, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Xóa dòng tương ứng trong bảng
                        form.closest('tr').remove();
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                });
        });
    });


    $('body').on('click', '.btn-add-borrow', function(e) {
        let mainDescription = $('#main-description').val();
        $.ajax({
            url: '/create_borrow',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                description: mainDescription
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Tạo phiếu mượn thành công!');
                    $('#modal-default2').modal('hide');
                    $('#main-description').val('');
                    $('#example-table tbody').empty();
                } else if (response.error) {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText); // In ra console để kiểm tra chi tiết lỗi
                alert('Có lỗi xảy ra: ' + xhr.responseText); // Hiển thị lỗi trong alert
            }
        });
    });

    setTimeout(function() {
        $("#myAlert").fadeOut(500);
    }, 3500);
</script>

public function create()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (auth()->check()) {
            $user = auth()->user(); // Lấy thông tin người dùng đang đăng nhập
        } else {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để mượn sách.');
        }

        // Lấy tất cả sách từ cơ sở dữ liệu
        $books = Book::all();

        // Lấy giỏ mượn của người dùng từ session
        $borrowCart = session('borrowCart', []); // Giả sử giỏ mượn lưu trong session

        // Truyền thông tin người dùng, sách và giỏ mượn vào view
        return view('Site.Borrow.ticket_borrow', compact('user', 'books', 'borrowCart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store1(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Lấy giỏ mượn từ session với khóa 'br' (giống với khóa trong addToBorrow)
        $borrowCart = session('br', []);

        // Kiểm tra nếu giỏ mượn trống, báo lỗi
        if (empty($borrowCart)) {
            return redirect()->route('borrow.create')->with('error', 'Giỏ mượn trống!');
        }

        // Lưu phiếu mượn vào cơ sở dữ liệu
        $borrowRecord = new BorrowRecord();
        $borrowRecord->user_id = $user->id;
        $borrowRecord->status = 'Đang mượn';
        $borrowRecord->save();

        // Lưu các sách trong phiếu mượn
        foreach ($borrowCart as $item) {
            $borrowRecord->books()->attach($item['id']); // Giả sử có quan hệ nhiều-nhiều giữa BorrowRecord và Book
        }

        // Xóa giỏ mượn trong session
        session()->forget('br'); // Xóa giỏ mượn sau khi đã tạo phiếu mượn

        return redirect()->route('borrow.show')->with('success', 'Phiếu mượn đã được tạo!');
    }