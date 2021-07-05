<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;



    public function categories()
    {
        return $this->hasMany('App\Models\Category')->where('category_id', NULL)->orderBy('order','ASC');
    }

    public function QrSetting()
    {
        return $this->hasOne('App\Models\QrSetting');
    }

    public function setting()
    {
        return $this->hasOne('App\Models\Setting');
    }

    public function elements()
    {
        return $this->hasMany('App\Models\Element');
    }
}
