<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Borrow;
use App\Models\Borrow_detail;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        
        $books = Book::with(['Category', 'Publisher'])
                     ->when($search, function ($query) use ($search) {
                         return $query->where('Name', 'like', '%' . $search . '%')
                                      ->orWhere('About', 'like', '%' . $search . '%');
                     })
                     ->get();
        
        return view('admin.pages.Books.index', compact('books'));
    }
    public function index_user(Request $request)
    {
        $books = Book::all();
        return view('Site.pages.Books.index', compact('books'));
    }
    

    public function create()
    {
        $categories = Category::all();
        $publis = Publisher::all();
        return view('admin.pages.Books.add', ['categories' => $categories, 'publis' => $publis]);
    }

    public function store(Request $request)
    {
        $inputData = [
            'Name' => $request->name ?? 'tú lon',
            'About' => $request->About ?? 'tú lon',
            'Categories_id' => $request->Categories_id ?? 1,
            'Publisher_id' => $request->Publisher_id ?? 1,
            'Quantity' => $request->Quantity ?? 1,
            'Price' => $request->Price ?? 10000,
            'author' => $request->author ?? 'tú hữu',
            'Publised_name' => $request->Publised_name ?? 'Việt nam',
            'Publised_year' => $request->Publised_year ?? '2024',
            'Create_date' => now(),
            'Create_by' => $request->Create_by ?? 'tú lon',
            'IsActive' => $request->has('IsActive') ? 1 : 0
        ];
    
        if ($request->hasFile('Images')) {
            $image = $request->file('Images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Lưu ảnh vào thư mục public/storage/books
            $image->storeAs('books', $imageName, 'public');
    
            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            $inputData['Images'] = 'books/' . $imageName;
        }
    
        // Tạo mới sách với dữ liệu đã xử lý
        Book::create($inputData);
        return redirect()->route('show.books')->with('success', 'Sách đã được thêm thành công');
    }
    

    
    public function edit(string $id)
    {
        $books = Book::find($id);
        $categories = Category::all();
        $publis = Publisher::all();
        return view('admin.pages.Books.edit', compact('books', 'categories', 'publis'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        // Lấy dữ liệu từ form
        $inputData = [
            'Name' => $request->Name ?? 'tú lon',
            'About' => $request->About ?? 'tú lon',
            'Categories_id' => $request->Categories_id ?? 1,
            'Publisher_id' => $request->Publisher_id ?? 1,
            'Quantity' => $request->Quantity ?? 1,
            'Price' => $request->Price ?? 10000,
            'author' => $request->author ?? 'tú hữu',
            'Publised_name' => $request->Publised_name ?? 'Việt nam',
            'Publised_year' => $request->Publised_year ?? '2024',
            'Update_date' => now(),
            'Update_by' => $request->Update_by ?? 'tú lon',
            'IsActive' => $request->has('IsActive') ? 1 : 0
        ];
    
        // Xử lý ảnh
        if ($request->hasFile('Images')) {
            $image = $request->file('Images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Xóa ảnh cũ nếu có
            if ($book->Images && Storage::exists('public/' . $book->Images)) {
                Storage::delete('public/' . $book->Images);
            }
    
            // Lưu ảnh mới
            
            $path = $image->storeAs('books', $imageName, 'public');
            $inputData['Images'] = 'books/' . $imageName;
        } else {
            // Giữ lại ảnh cũ nếu không có ảnh mới
            $inputData['Images'] = $book->Images;
        }
    
        // Cập nhật sách với dữ liệu đã xử lý
        $book->update($inputData);
    
        return redirect()->route('show.books')->with('success', 'Cập nhật sách thành công');
    }
    
    
    
    
    public function showchitiet($id)
{
    $book = Book::with('publisher', 'category')->findOrFail($id);
    
   
    $categories = Category::all(); // Lấy tất cả thể loại sách nếu cần hiển thị
    
    // Trả về view và truyền các biến 'book' và 'categories'
    return view('Site.Book.bookdetail', compact('book', 'categories'));
}

    public function destroy(string $id)
    {
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return response()->json(['success' => true, 'message' => 'Xóa sách thành công']);
        }
        return response()->json(['success' => false, 'message' => 'Sách không tồn tại']);
    }
    public function showlistBookByCategory($id)
{
    $category = Category::findOrFail($id);  // Trả về một đối tượng Category, không phải Collection

    $books = $category->books;  // Đây là Collection các đối tượng Book liên quan

    return view("Site.Category.ShowBookByCategory", compact('books', 'category'));
}
public function statistics()
{
    // Lấy số liệu thống kê từ bảng borrow
    $borrow = DB::table('borrow')->where('Status', 1)->count(); // Sách đang mượn
    $borrowed = DB::table('borrow')->where('Status', 2)->count(); // Sách đã mượn xong
    $returned = DB::table('borrow')->where('Status', 3)->count(); // Sách đã trả
    $deleted = DB::table('borrow')->where('Status', 0)->count(); // Sách đã xóa
    $totalBorrowed = DB::table('borrow')->count(); // Tổng số sách mượn

    // Lấy tất cả thể loại sách nếu cần hiển thị
    $categories = Category::all(); 
   //dd(compact('borrow', 'borrowed', 'returned', 'deleted', 'totalBorrowed', 'categories'));
    // Trả dữ liệu cho view
    return view('admin.pages.statistics.statistics', [
        'borrow' => $borrow,
        'borrowed' => $borrowed,
        'returned' => $returned,
        'deleted' => $deleted,
        'totalBorrowed' => $totalBorrowed,
        'categories' => $categories
    ]);
}

public function getStatsForWeek()
{
    $startOfWeek = Carbon::now()->startOfWeek(); // Ngày đầu tuần
    $endOfWeek = Carbon::now()->endOfWeek(); // Ngày cuối tuần

    // Thống kê các đơn trong tuần theo trạng thái
    $borrow = Borrow::where('status', 'pending')
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->count();

    $borrowed = Borrow::where('status', 'borrowed')
                      ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                      ->count();

    $returned = Borrow::where('status', 'returned')
                      ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                      ->count();

    $deleted = Borrow::where('status', 'deleted')
                     ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                     ->count();

    $totalBorrowed = $borrow + $borrowed + $returned + $deleted;

    // Trả lại dữ liệu cho view
    return view('admin.pages.statistics.statistics', compact('borrow', 'borrowed', 'returned', 'deleted', 'totalBorrowed'));
}



}






