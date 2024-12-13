<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SvController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ContactController;

// Route::get('/', function () {
//     return view('master_site');
// });

Route::get('/', [SvController::class, 'index'])->name('Trang_chu');
Route::get('/master_site', [DashboardController::class, 'master_site']);

Route::get('/user_if', [UserController::class, 'show_imfomation'])->name('imfomation');
Route::get('/borrow_wait', [UserController::class, 'borrow_wait_user'])->name('br_wait');
Route::get('/borrow_wait_book/{id}', [UserController::class, 'book_wait'])->name('br_wait_book_In');
Route::get('/book_wait_borrow/{Id}', [UserController::class, 'book_wait'])->name('book_wait_br');


Route::get('/register', [UserController::class, 'create'])->name('register_user');
//Route::get('/register', [UserController::class, 'store'])->name('create_user');
Route::post('/register', [UserController::class, 'store'])->name('create_user');
Route::get('/log_out', [UserController::class, 'handleLogout'])->name('log_out');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/check-login', [UserController::class, 'checkLogin'])->name('check_login');

Route::delete('/admin/delete_borrow/{id}', [BorrowController::class, 'deleteBorrow'])->name('borrow.delete');

Route::get('/chitietbooks/{id}', [BookController::class, 'showchitiet'])->name('showchitiet');
Route::get('/show_books', [BookController::class, 'index'])->name('show.books.user');
Route::get('/show_list_books', [SvController::class, 'list_book'])->name('list.book.user');
Route::post('/add-to-borrow/{id}', [BorrowController::class, 'addToBorrow'])->name('addToBorrow');
Route::get('/borrow-cart', [BorrowController::class, 'showBorrow'])->name('borrow.show');

Route::delete('/borrow-cart/{id}', [BorrowController::class, 'removeFromCart'])->name('borrow.remove');
Route::get('/borrow/create', [BorrowController::class, 'create'])->name('borrow.create');
Route::post('/borrow/store', [BorrowController::class, 'store'])->name('borrow.store');

Route::get('/borrow', [BorrowController::class, 'index'])->name('borrow.index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');


Route::get('/book_in_categories/{id}', [SvController::class, 'showlistBookByCategory'])->name('show_book_in_category');

Route::prefix('admin')->middleware(CheckLogin::class)->group(function () {
    
//category user

   
Route::get('/admin', [DashboardController::class, 'index'])->name('quanlytv');

    // Category Routes
    Route::get('/show_category', [CategoryController::class, 'index'])->name('show.categories');
    Route::get('/add_category', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/create_category', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit_category/{Id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update_category/{Id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/destroy_category/{Id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    Route::get('/show_publisher', [PublisherController::class, 'index'])->name('show.publisher');
    Route::get('/add_publisher', [PublisherController::class, 'create'])->name('publisher.create');
    Route::post('/create_publisher', [PublisherController::class, 'store'])->name('publisher.store');
    Route::get('/edit_publisher/{Id}', [PublisherController::class, 'edit'])->name('publisher.edit');
    Route::post('/publisher/{id}/update', [PublisherController::class, 'update'])->name('publisher.update');
    Route::delete('/publisher/{id}/delete', [PublisherController::class, 'destroy'])->name('publisher.destroy');
    
    // Book Routes
    Route::get('/show_books', [BookController::class, 'index'])->name('show.books');
    Route::get('/add_book', [BookController::class, 'create'])->name('books.create');
    Route::post('/create_book', [BookController::class, 'store'])->name('books.store');
    Route::get('/edit_book/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/update_book/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/delete_book/{id}', [BookController::class, 'destroy'])->name('books.destroy');

    // Menu Routes
    Route::get('/show_menus', [MenuController::class, 'index'])->name('show.menus');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/edit_menu/{id}', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/update_menu/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/delete_menu/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');

    Route::get('/show_users', [UserController::class, 'index'])->name('show_useradmin');
    Route::get('/show_user', [UserController::class, 'indexuser'])->name('show_user');
    //thêm
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/my-profile', [UserController::class, 'myProfile'])->name('my_profile');
    Route::get('/xemchitiet/{id}', [UserController::class, 'show_user_id'])->name('users.xemchitiet');
    Route::post('/user_lock/{Id}', [UserController::class, 'lockuser'])->name('lock_user');
    Route::post('/user_role/{Id}', [UserController::class, 'roleuser'])->name('role_user');

    Route::get('/borrow', [BorrowController::class, 'index'])->name('borrow.index');

    //mượn
    Route::get('/list_borrowing', [UserController::class, 'list_borrowing'])->name('borrowing2');
    Route::get('/book_wait_borrow/{Id}', [UserController::class, 'book_in_wait'])->name('book_in_wait');
 

});
