<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    protected $fillable=[
        'Name',
        'Address',
        'Phone',
        'Email',
        'Status',
        'IsActive'
    ];
    protected $primaryKey = 'Id';
    protected $table = 'publisher';
    public $timestamps = false;
}