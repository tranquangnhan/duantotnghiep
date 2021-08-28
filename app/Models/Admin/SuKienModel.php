<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuKienModel extends Model
{
    use HasFactory;
    protected $table = 'Sukien';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idns',
        'title',
        'mota',
        'start',
        'end',
        'loai',
        'trangthai',
    ];
}
