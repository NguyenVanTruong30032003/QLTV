<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Chỉ định tên bảng trong cơ sở dữ liệu
    protected $table = 'users';

    // Các trường có thể gán giá trị
    protected $fillable = [
        'SV_id',
        'Full_name',
        'Email',
        'Phone',
        'Pw', // Trường mật khẩu sẽ cần được mã hóa khi lưu
        'Avatar',
        'Address',
        'Role_id',
        'Create_date',
        'Create_by',
        'Update_date',
        'Update_by',
        'IsAction',
    ];

    // Khóa chính của bảng
    protected $primaryKey = 'Id';

    // Không sử dụng timestamps tự động của Laravel
    public $timestamps = false;

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    public static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if ($user->isDirty('Pw')) {  // Kiểm tra nếu có thay đổi mật khẩu
                $user->Pw = bcrypt($user->Pw);  // Mã hóa mật khẩu
            }
        });
    }
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
