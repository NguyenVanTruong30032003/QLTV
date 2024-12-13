<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'SV_id',
        'Full_name',
        'Email',
        'Phone',
        'Pw', 
        'Avatar',
        'Address',
        'Role_id',
        'Create_date',
        'Create_by',
        'Update_date',
        'Update_by',
        'IsAction',
    ];
    
    protected $primaryKey = 'Id';
    public $timestamps = false;
    public static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if ($user->isDirty('Pw')) {  
                $user->Pw = bcrypt($user->Pw);  
            }
        });
    }
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
