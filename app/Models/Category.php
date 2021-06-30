<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function dishes()
    {
        return $this->hasMany('App\Models\Dish');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
