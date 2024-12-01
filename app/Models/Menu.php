<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Khai báo các trường có thể được gán giá trị hàng loạt
    protected $fillable = [
        'Name', 
        'Item_level', 
        'Parent_level', 
        'Item_oder', 
        'Icon', 
        'Route', 
        'Create_date', 
        'Create_by', 
        'Update_date',
        'Update_by',
        'IsActive'
       
    ];
    protected $primaryKey = 'Id';
    protected $table = 'menus';
    public $timestamps = false;

}
