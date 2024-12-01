<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow_detail extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class, 'Book_id');
    }
    protected $fillable = [
        'Borrow_id',
        'Book_id',
        'Create_date',
        'Create_by',
        'Update_date',
        'Update_by',
        'Status',
        'IsAction'
    ];
    protected $primaryKey = 'Id';
    protected $table = 'borrow_details';
    public $timestamps = false;
}