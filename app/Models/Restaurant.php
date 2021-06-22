<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function QrSetting()
    {
        return $this->hasOne('App\Models\QrSetting');
    }

    public function setting()
    {
        return $this->hasOne('App\Models\Setting');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }
}
