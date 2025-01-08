<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Borrow;
use App\Models\Borrow_detail;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả người dùng với vai trò quản trị viên
        $users = User::where('Role_id', 1)->get();
        return view('admin.pages.User.index', compact('users'));
        
    }

    public function indexuser()
    {
        // Lấy tất cả người dùng với vai trò người dùng
        $users = User::where('Role_id', 2)->get();
        return view('admin.pages.User.index', compact('users'));
    }
    public function show_user_id($id)
{
    $user = User::findOrFail($id);
    return view('admin.pages.User.show', compact('user'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.User.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'ma_sv' => 'required|string',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:3|max:20|confirmed',
            'password_confirmation' => 'required|string|min:3|max:20',
            'Avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'ma_sv.required' => 'Mã sinh viên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.unique' => 'Email này đã được sử dụng.',
            'email.max' => 'Email không được dài quá 100 ký tự.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự.',
            'password.max' => 'Mật khẩu không được dài quá 20 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu xác nhận.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Tạo mới người dùng
        $user = new User;
        $user->SV_id = $request->ma_sv;
        $user->Email = $request->email;
        
        $user->Full_name = $request->Full_name;
        $user->Role_id = 2;
        $user->Pw = $request->password;
        $user->Create_date = now();
        $user->IsAction = 1;

        // Xử lý upload hình ảnh
        if ($request->hasFile('Avatar')) {
            $avatarPath = $request->file('Avatar')->store('img', 'public');
            $user->Avatar = $avatarPath;
        }

        if ($user->save()) {
            $request->session()->put("message", ["style" => "success", "msg" => "Đăng ký tài khoản thành công"]);
        } else {
            $request->session()->put("message", ["style" => "danger", "msg" => "Đã xảy ra lỗi khi lưu thông tin."]);
        }

        return redirect()->route("login");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Trống (nếu cần thêm, có thể triển khai sau)
    }

    public function login()
    {
        return view('admin.pages.User.login');
    }

    public function checkLogin(Request $request)
    {
        // Xác thực đầu vào
        $request->validate([
            'ma_sv' => 'required',
            'password' => 'required',
        ]);

        $user = User::where("SV_id", $request->ma_sv)->first();

        if ($user && $request->password === $user->Pw) {
            Auth::login($user);
            return redirect()->route("quanlytv");
        }

        return redirect()->route("login")->with('error', 'Mã sinh viên hoặc mật khẩu không đúng');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('show_user')->with('error', 'User không tồn tại');
        }
    
        return view('user.edit', compact('user'));
    }
    

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('show_user')->with('error', 'Người dùng không tồn tại.');
        }

        // Validation
        $request->validate([
            'Name' => 'required|string|max:255',
            'Full_name' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Phone' => 'required|numeric',
            'Address' => 'nullable|string|max:255',
            'Avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Xử lý dữ liệu
        $data = $request->all();
        $data['IsAction'] = $request->has('IsAction') ? 1 : 0;
        $data['Update_date'] = now();

        // Xử lý ảnh đại diện
        if ($request->hasFile('Avatar')) {
            if ($user->Avatar) {
                Storage::disk('public')->delete($user->Avatar);
            }
            $avatarPath = $request->file('Avatar')->store('img', 'public');
            $data['Avatar'] = $avatarPath;
        }

        // Cập nhật người dùng
        $user->update($data);

        // Cập nhật lại session nếu cần
        session()->put('user', $user);
        session()->put('user_name', $user->Full_name);
        session()->put('avatar', $user->Avatar);

        return redirect()->route('show_user')->with('success', 'Cập nhật người dùng thành công.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function logout()
    {
        Session::forget(['user', 'user_name', 'avatar']);
        return redirect()->route('Trang_chu');
    }
    public function myProfile()
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::user(); // Sử dụng Auth để lấy thông tin người dùng hiện tại
        if (!$user) {
            // Nếu không có người dùng đăng nhập, chuyển hướng đến trang login hoặc trang khác
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        // Trả về view với thông tin người dùng
        return view('admin.pages.User.profile', compact('user'));
    }


    public function lockuser(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->IsAction = 0;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Khóa người dùng thành công']);
        }
        return response()->json(['success' => false, 'message' => 'Người dùng không tồn tại']);
    }

    public function roleuser(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->Role_id = 1;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Phân quyền thành công']);
        }
        return response()->json(['success' => false, 'message' => 'Người dùng không tồn tại']);
    }

    public function handleLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function show_imfomation()
    {
        $categories = Category::all();
        return view('Site.User.User_imformation', [
            'categories' => $categories,
            
        ]);
    }
    
    public function borrow_wait_user()
    {
        $user = Auth::user()->Id;
        $br = Borrow::where('Borrow_user_id', $user)->where('Status',  1)->get();
        $categories = Category::all();
        return view('Site.User.borrow_wait', [
            'categories' => $categories,
            'br' => $br
        ]);
    }

    public function book_wait(String $id)
    {
       
        $br = Borrow_detail::with('book')->where('Borrow_id', $id)->get();
        $categories = Category::all();
        return view('Site.User.Book_in_borrow_wait', [
            'br' => $br,
            'categories' => $categories
        ]);
    }


    //admin
    public function book_wait_admin(String $id)
    {
        // dd($id);
        $br = Borrow_detail::with('book')->where('Borrow_id', $id)->get();

        return view('admin.pages.Borrow.', ['br' => $br]);
    }

    public function list_borrow_wait()
    {
        $user = Auth::user()->Id;
        // dd($user);
        $br = Borrow::where('Borrow_user_id', $user)->where('Status',  1)->get();
        // dd($br);
        return view('admin.pages.Borrow.waiting_', ['br' => $br]);
    }

    

    public function book_in_wait(String $id)
    {
        $br_ok = Borrow::find($id);
        $br = Borrow_detail::with('book')->where('Borrow_id', $id)->get();
    
        // Lấy thông tin người dùng từ Borrow_user_id
        $student = User::find($br_ok->Borrow_user_id);  // Giả sử Borrow_user_id lưu trữ ID người dùng
    
        return view('admin.pages.Borrow.detail_wating_borrow', ['br' => $br, 'br_ok' => $br_ok, 'student' => $student]);
    }
    
   
}
