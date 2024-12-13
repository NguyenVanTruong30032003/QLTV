<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\borrow;
use App\Models\Borrow_detail;
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
        $borrows = Borrow::with('user', 'book')->orderBy('id', 'desc')->get();

    return view('admin.pages.Borrow.Books_in_borrow', compact('borrows'));
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
    $borrow = Borrow::find($id);
    if ($borrow) {
        $borrow->delete();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false]);
}

}
