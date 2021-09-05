<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lichlamviec extends Model
{
    use HasFactory;
    protected $table='lich';
    protected $primaryKey='id';
    protected $fillable= [
        'idcoso', 'thu', 'soluongkhach', 'giobatdau', 'gioketthuc', 'type', 'ghichu'
    ];
}
