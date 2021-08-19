<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhansuModel extends Model
{
    use HasFactory;
    protected $table ='nhansu';
    protected $primaryKey= 'id';
    protected $fillable= [
        'name', 'email', 'namsinh', 'chucvu', 'password', 'luong', 'gioitinh', 'role', 'iddv', 'img', 'danhgia'
    ];
}
