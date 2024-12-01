<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Nếu có từ khóa tìm kiếm, lọc theo tên. Nếu không, lấy tất cả thể loại.
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('Name', 'like', '%' . $search . '%');
        })->get();
    
        return view('admin.pages.Category.index', [
            'categories' => $categories,
            'search' => $search, // Truyền giá trị tìm kiếm về view để hiển thị lại trong input
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.Category.add_category');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputData = [
            'Name' => $request->Name ?? 'trường', // Đảm bảo trường lấy từ form là 'Name'
            'About' => $request->About ?? 'tú lon', // Trường lấy từ form là 'About'
            'Create_date' => now(), // Đảm bảo đúng format ngày giờ
            'Create_by' => $request->Create_by ?? 'tú lon',
            'Update_date' => now(),
            'Update_by' => null,
            'IsActive' => $request->has('IsActive') ? 1 : 0,
        ];
    
        // Lưu dữ liệu vào bảng
        $category = Category::create($inputData);
    
        return redirect()->route('show.categories')->with('success', 'Thêm thể loại thành công!');
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
    
    $category = Category::findOrFail($id);
    
     return view('admin.pages.Category.edit',['category'=>$category]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $rqt, string $id)
    {
        $categori = Category::findOrFail($id);
        
        $inputData=[
            'Name'=>$rqt->Name ?? $categori->Name,
            'About'=>$rqt->About ?? $categori->About,
            'Update_by'=>$rqt->Update_by ?? $categori->Update_by,
            'IsActive'     => $rqt->has('IsActive') ? 1 : 0 
        ];
        
        
        $categori->update($inputData);
        $rqt->session()->put("messenge", ["style"=>"success","msg"=>"Cập nhật danh mục thành công"]);
        return redirect()->route("show.categories");
    }
    public function destroy( string $id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
            return response()->json(['success'=>true,'message' => 'Xóa thể loại thành công']);
        }
        return response()->json(['success'=>false,'message' => 'Thể loại không tồn tại']);
    }
}
