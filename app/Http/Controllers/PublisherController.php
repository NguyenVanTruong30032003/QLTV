<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Publisher::query();

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('Name', 'like', "%{$search}%")
              ->orWhere('Address', 'like', "%{$search}%")
              ->orWhere('Phone', 'like', "%{$search}%")
              ->orWhere('Email', 'like', "%{$search}%");
    }

    $publisher = $query->get();

    return view('admin.pages.publisher.index', compact('publisher'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.Publisher.add'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
        {
            // Validate dữ liệu
    $request->validate([
        'Name' => 'required|string|max:255',
        'Address' => 'required|string|max:255',
        'Phone' => 'required|string|max:20',
        'Email' => 'required|email|max:255',
        'Status' => 'required|string',
    ]);

    // Tạo dữ liệu đầu vào
    $inputData = [
        'Name' => $request->Name,
        'Address' => $request->Address,
        'Phone' => $request->Phone,
        'Email' => $request->Email,
        'Status' => $request->Status,
        'IsActive' => $request->has('IsActive') ? 1 : 0, 
    ];

    // Lưu dữ liệu vào cơ sở dữ liệu
    Publisher::create($inputData);

    // Chuyển hướng về trang danh sách với thông báo thành công
    return redirect()->route("show.publisher")->with('success', 'Nhà xuất bản đã được thêm thành công!');
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
    // Lấy thông tin nhà xuất bản theo ID
    $publisher = Publisher::findOrFail($id);

    // Trả về view và truyền biến $publisher vào view
    return view('admin.pages.Publisher.edit', compact('publisher'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Tìm nhà xuất bản theo ID
    $publisher = Publisher::findOrFail($id);

    // Cập nhật dữ liệu
    $publisher->update([
        'Name' => $request->Name,
        'Address' => $request->Address,
        'Phone' => $request->Phone,
        'Email' => $request->Email,
        'Status' => $request->Status,
        'IsActive' => $request->has('IsActive') ? 1 : 0,
    ]);

    // Chuyển hướng về trang danh sách với thông báo thành công
    return redirect()->route('show.publisher')->with('success', 'Nhà xuất bản đã được cập nhật thành công!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Tìm nhà xuất bản theo ID
    $publisher = Publisher::findOrFail($id);

    // Xóa nhà xuất bản
    $publisher->delete();

    // Chuyển hướng về trang danh sách với thông báo thành công
    return redirect()->route('show.publisher')->with('success', 'Nhà xuất bản đã được xóa thành công!');
}

}
