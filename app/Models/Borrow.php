<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'Borrow_user_id'); 
    }
    public function details()
    {
        return $this->hasMany(Borrow_detail::class, 'Borrow_id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    protected $fillable = [
        'Borrow_user_id',
        'Borrow_admin_id',
        'Return_date',
        'Create_date',
        'Create_by',
        'Update_date',
        'Update_by',
        'Status',
        'IsAction',
    ];
    protected $primaryKey ='Id';
    protected $table = 'borrow';
    public $timestamps = false;
}