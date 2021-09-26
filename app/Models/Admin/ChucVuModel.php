<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ChucVuModel extends Model
{
    protected $table = 'chucvu';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'role'
    ];
}
