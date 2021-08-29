<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CosoModel extends Model
{
    protected $table = 'coso';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'tinh',
        'quanhuyen',
        'diachi'
    ];
    public function city()
    {
      return $this->hasOne(City::class, 'matp','tinh');
    }
    public function province()
    {
      return $this->hasOne(Province::class, 'maqh','quanhuyen');
    }
    public function wards()
    {
      return $this->hasOne(Wards::class, 'xaid','diachi');
    }

    // public function city(){
    //     return $this->hasOne('App\Models\Admin\City');
    // }
    // public function province(){
    //     return $this->belongsTo('App\Models\Admin\Province', 'quanhuyen');
    // }
    // public function wards(){
    //     return $this->belongsTo('App\Models\Admin\Wards', 'diachi');
    // }
    public $timestamps = false;
}
