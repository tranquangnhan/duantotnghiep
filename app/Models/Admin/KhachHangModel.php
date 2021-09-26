<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHangModel extends Model
{
    protected $table = 'khachhang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'sdt'
    ];
}
