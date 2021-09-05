<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonhangModel extends Model
{
    protected $table = 'donhang';
    protected $primaryKey = 'iddh';
    protected $fillable = [
        'idkh',
        'idcs',
        'nhanvien',
        'tongtien',
        'magg',
        'tongtiengg',
        'ghichu'
    ];
}
