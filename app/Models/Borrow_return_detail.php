<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow_return_detail extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class, 'Book_id');
    }
    protected $fillable = [
        'Borrow_return_id',
        'Book_id',
        'Error',
        'Create_date',
        'Create_by',
        'Update_date',
        'Update_by',
        'Status',
        'IsAction',
    ];
    protected $primaryKey ='Id';
    protected $table = 'borrow_return_details';
    public $timestamps = false;
}
