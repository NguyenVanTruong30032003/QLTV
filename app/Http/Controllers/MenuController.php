<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $search = $request->input('search');
    
        // Kiểm tra nếu có từ khóa, tìm các bản ghi phù hợp, nếu không thì lấy tất cả bản ghi
        $menus = Menu::when($search, function($query, $search) {
            return $query->where('Name', 'LIKE', '%' . $search . '%');
        })->get();
    
        return view('admin.pages.Menu.index', compact('menus', 'search'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.Menu.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
       
    
        // Tạo dữ liệu để lưu vào cơ sở dữ liệu
        $inputData = [
            'Name' => $request->Name ?? 'aaa',
            'Item_level' => $request->Item_level ?? 1,
            'Parent_level' => $request->Parent_level ?? 1,
            'Item_oder' => $request->Item_oder ?? 1,
            'Icon' => $request->Icon ?? 'default-icon.png', // Gán giá trị mặc định cho Icon
            'Route' => $request->Route ?? '',
            'Create_date' => now(),
            'Create_by' => $request->Create_by ?? 'tu',
            'Update_date' => now(),
            'Update_by' => null,
            'IsActive' => $request->has('IsActive') ? 1 : 0
        ];
    
        // Tạo menu mới
        $menus = Menu::create($inputData);
    
        return redirect()->route("show.menus");
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
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.pages.Menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */


public function update(Request $request, $id)
{
    $menu = Menu::findOrFail($id);

    $inputData = [
        'Name' => $request->Name ?? $menu->Name,
        'Item_level' => $request->Item_level ?? $menu->Item_level,
        'Parent_level' => $request->Parent_level ?? $menu->Parent_level,
        'Item_oder' => $request->Item_oder ?? $menu->Item_oder,
        'Icon' => $request->Icon ?? $menu->Icon,
        'Route' => $request->Route ?? $menu->Route,
        'Update_by' => $request->Update_by ?? $menu->Update_by,
        'IsActive' => $request->has('IsActive') ? 1 : 0,
    ];

    $menu->update($inputData);
    $request->session()->put("message", ["style" => "success", "msg" => "Cập nhật menu thành công"]);
    return redirect()->route('show.menus'); // Thay 'show.menus' bằng route hiển thị danh sách menu của bạn
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);
        if($menu){
            $menu->delete();
            return response()->json(['success'=>true,'message' => 'Xóa menu thành công']);
        }
        return response()->json(['success'=>false,'message' => 'menu không tồn tại']);
    }
}
