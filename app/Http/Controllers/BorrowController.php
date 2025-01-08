<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\borrow;
use App\Models\Borrow_detail;
use App\Models\Borrow_return_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BorrowController extends Controller
{
    public function addToBorrow(Request $request, $id)
    {

        $book = Book::find($id);


        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Sách không tồn tại.']);
        }


        $cart = session()->get('br', []);
        if (isset($cart[$id])) {
            return response()->json(['success' => false, 'message' => 'Bạn chỉ có thể mượn một cuốn sách này.']);
        }

        $cart[$id] = [
            'name' => $book->Name,
            'quantity' => 1,
            'about' => $book->About,
            'author' => $book->author,
            'image' => $book->Images
        ];

        // Lưu giỏ vào session
        session()->put('br', $cart);

        // Trả về phản hồi với số lượng giỏ hàng
        return response()->json(['success' => true, 'message' => 'Sách đã được thêm vào giỏ mượn!']);
    }


    public function removeFromCart($id)
    {
        // Lấy giỏ mượn từ session
        $cart = session()->get('br', []);

        // Kiểm tra nếu sách tồn tại trong giỏ
        if (isset($cart[$id])) {
            // Xóa sách khỏi giỏ
            unset($cart[$id]);

            // Cập nhật lại giỏ mượn trong session
            session()->put('br', $cart);

            // Trả về phản hồi thành công
            return response()->json([
                'success' => true,
                'message' => 'Sách đã được xóa khỏi giỏ mượn.',
                'cartCount' => count($cart) // Cập nhật số lượng giỏ mượn
            ]);
        }

        // Nếu sách không tồn tại trong giỏ
        return response()->json([
            'success' => false,
            'message' => 'Sách không tồn tại trong giỏ mượn.'
        ]);
    }



    public function showBorrow()
    {
        // Lấy giỏ mượn từ session, nếu không có thì gán là mảng rỗng
        $borrowCart = session('br', []);
    
        // Kiểm tra nếu giỏ mượn trống
        if (empty($borrowCart)) {
            return view('Site.Borrow.Show_borow')->with('message', 'Giỏ mượn của bạn đang trống.');
        }
    
        // Lấy danh sách thể loại
        $categories = Category::all();
    
        // Trả về view với dữ liệu giỏ mượn và thể loại
        return view('Site.Borrow.Show_borow', compact('borrowCart', 'categories'));
    }
    
    


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách phiếu mượn và liên kết với user và book
        $borrows = Borrow::with('user', 'book')->orderBy('id', 'desc')->get();
    
        // Đếm số lượng phiếu mượn (có thể thêm điều kiện nếu cần)
        $pendingBorrowCount_1 = Borrow::where('status', 1)->count();
        $pendingBorrowCount_2 = Borrow::where('status', 2)->count();
        $pendingBorrowCount_3 = Borrow::where('status', 3)->count();
        $pendingBorrowCount_4 = Borrow::where('status', 0)->count();
        return view('admin.pages.Borrow.Books_in_borrow', compact('borrows',
         'pendingBorrowCount_1',
        'pendingBorrowCount_2',
        'pendingBorrowCount_3',
        'pendingBorrowCount_4',
    ));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    

    public function store(Request $request)
    {
       
        
    
        $br = new Borrow();
        $br->Borrow_user_id = Auth::user()->Id; 
        $br->Create_date = now();
        $br->Return_date = now()->addMonth(); 
        $br->Status = 1; 
        $br->IsAction = 1;
        $br->save();
    
        $br_id = $br->Id;
        $borrow = session()->get('br', []);
        foreach ($borrow as $book_id => $book) {
            $br_detail = new Borrow_detail();
            $br_detail->Borrow_id = $br_id; // ID phiếu mượn
            $br_detail->Book_id = $book_id; // ID sách
            $br_detail->Create_date = now(); // Ngày tạo
            $br_detail->IsAction = 1; // Trạng thái hoạt động
            $br_detail->save();
        }
    
        session()->forget('borrow');
    
        return redirect()->route('borrow.show')->with('message', 'Phiếu mượn đã được tạo thành công.');
    }


    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    // xoá trong phiếu mượn
    public function deleteBorrow($id)
{
    try {
        $borrow = Borrow::findOrFail($id); // Tìm bản ghi với ID
        $borrow->Status = 0; // Cập nhật trạng thái thành 0
        $borrow->save(); // Lưu thay đổi vào cơ sở dữ liệu

        return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
    }
}

public function Borrowing()
    {
        $br = Borrow::where('Status', 2)->get();
        // dd($br);
        return view('admin.pages.Borrow.da_duyet', ['br' => $br]);
    }
    public function get_return($id)
    {
        $book = Borrow_detail::with('book')->where('Borrow_id', $id)->get();
        $sv = Borrow::with('user')->where('Id', $id)->first();
        $br = Borrow::find($id); // Kiểm tra nếu không có bản ghi nào được tìm thấy
    
        if (!$br) {
            // Nếu không có phiếu mượn nào, trả về view với thông báo hoặc hành động khác
            return redirect()->route('some_route')->with('error', 'Không tìm thấy phiếu mượn.');
        }
    
        return view('admin.pages.Borrow.da_duyet', ['br' => $br, 'book' => $book, 'sv' => $sv]);
    }
    
    

    public function list_borrowing()
    {
      
        $br = Borrow::where('Status', 1)->get();
       
        //  dd($br);
       return view('admin.pages.Borrow.waiting_borrow', ['br' => $br]);
    }
    // BorrowController.php

// BorrowController.php

public function confirmBorrow($id)
{
    $borrow = Borrow::find($id);

    
    if ($borrow) {
        // Cập nhật status
        $borrow->status = 2;
        $borrow->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

public function detail_return(String $id)
    {
        $br_ok = Borrow::find($id);
        $br = Borrow_detail::with('book')->where('Borrow_id', $id)->get();
    
        // Lấy thông tin người dùng từ Borrow_user_id
        $student = User::find($br_ok->Borrow_user_id);  // Giả sử Borrow_user_id lưu trữ ID người dùng
    
        return view('admin.pages.Borrow.detail_return', ['br' => $br, 'br_ok' => $br_ok, 'student' => $student]);
    }

    public function listReturned()
    {
        $returnedBorrows = Borrow::where('Status', 3)->get(); // Status = 3 là đã trả
        return view('admin.pages.Borrow.returned_borrows', ['returnedBorrows' => $returnedBorrows]);
    }

    public function showDetails($id)
{
    $borrow = Borrow::with('details.book')->findOrFail($id); // Load chi tiết mượn sách
    return view('admin.pages.Borrow.show_return_detail', compact('borrow'));
}

public function borrow_deleted()
{
    $deletedBorrows = Borrow::where('Status', 0)->get(); // Status = 3 là đã trả
    return view('admin.pages.Borrow.borrow_deleted', ['deletedBorrows' => $deletedBorrows]);
}

public function borrow_deleted_detail($id)
{
    // Lấy phiếu mượn đã xóa từ DB, dựa trên ID
    $borrow = Borrow::with('details.book')  // Eager loading để lấy thông tin chi tiết sách
                    ->where('Status', 0)  // Trạng thái là 0 tức là đã xóa
                    ->findOrFail($id);

    // Trả về view với thông tin phiếu mượn đã xóa
    return view('admin.pages.Borrow.borrow_delete_detail', ['borrow' => $borrow]);
}
public function confirmReturn($id)
{
    $borrow = Borrow::find($id);

    
    if ($borrow) {
        // Cập nhật status
        $borrow->status = 3;
        $borrow->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

}


