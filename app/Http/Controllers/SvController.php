<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class SvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả sách
        $books = Book::paginate(8); // Đảm bảo có dấu ngoặc đơn () để gọi phương thức
        $menus = Menu::all();
        $categories = Category::all(); // Cũng cần dấu ngoặc đơn ()
    
        // Trả về view và truyền dữ liệu vào dưới dạng mảng
        return view('Site.index', [
            'books' => $books,
            'categories' => $categories,
            'menus' =>$menus,
        ]);
    }
    public function list_book()
    {
        // Lấy tất cả sách
        $books = Book::all(); // Đảm bảo có dấu ngoặc đơn () để gọi phương thức
        $menus = Menu::all();
        $categories = Category::all(); // Cũng cần dấu ngoặc đơn ()
    
        // Trả về view và truyền dữ liệu vào dưới dạng mảng
        return view('Site.Book.list', [
            'books' => $books,
            'categories' => $categories,
            'menus' =>$menus,
        ]);
    }
    // public function showlistBookByCategory($id)
    // {
    //     // Lấy thể loại theo ID
    //     $category = Category::findOrFail($id);

    //     // Lấy tất cả sách thuộc thể loại này
    //     $books = $category->books; // Sử dụng quan hệ books()

    //     // Trả về view với danh sách sách và thông tin thể loại
    //     return view("Site.Category.a", compact('books', 'category'));
    // }   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function showlistBookByCategory($id)
    {
        // Lấy thể loại hiện tại theo ID
        $category = Category::findOrFail($id);
    
        // Lấy tất cả sách thuộc thể loại này
        $books = $category->books;
    
        // Lấy tất cả thể loại để hiển thị trong menu
        $categories = Category::all();
    
        // Truyền các biến category, books, và categories vào view
        return view("Site.Category.ShowBookByCategory", compact('books', 'category', 'categories'));
    }
  
    

}
