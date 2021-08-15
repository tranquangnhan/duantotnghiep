<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucModel extends Model
{
    protected $table = 'danhmuc';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug'
    ];
}
