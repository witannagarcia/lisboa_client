<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function image(){
        return $this->hasOne('App\Models\DishImage');
    }

    public function images(){
        return $this->hasMany('App\Models\DishImage');
    }
}
