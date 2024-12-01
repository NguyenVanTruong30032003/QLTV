<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'About',
        'Images',
        'Categories_id',
        'Publisher_id',
        'Quantity',
        'Stock',
        'Number_borowed',
        'Price',
        'Code',
        'Publiser_year',
        'author',
        'Create_date',
        'Create_by',
        'Update_date',
        'Update_by',
        'IsActive',
     
    ];

    protected $primaryKey = 'Id';
    protected $table = 'books';
    public $timestamps = false;

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'Categories_id', 'Id');
    }

    // Quan hệ với Publisher
    public function publisher()
{
    return $this->belongsTo(Publisher::class, 'Publisher_id', 'Id');
}
public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

}