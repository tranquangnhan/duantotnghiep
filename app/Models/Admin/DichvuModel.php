<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DichvuModel extends Model
{
    use HasFactory;
    protected $table='dichvu';
    protected $primaryKey='id';
    protected $fillable= [
        'name', 'slug', 'img', 'iddm', 'mota', 'gia', 'content'
    ];
}
