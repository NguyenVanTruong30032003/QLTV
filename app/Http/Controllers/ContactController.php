<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   

public function index()
{
    // Lấy tất cả thể loại từ bảng 'categories'
    $categories = Category::all();

    // Trả về view contact và truyền dữ liệu categories
    return view('Site.Page.contact', compact('categories'));
}

}
