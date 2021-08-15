<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChamCongModel extends Model
{
    use HasFactory;
    protected $table = 'chamcong';
    protected $primaryKey = 'id';
    protected $fillable = [
        'check_in',
        'check_out',
        'ngay',
        'idns',
        'trangthai',
    ];
}
