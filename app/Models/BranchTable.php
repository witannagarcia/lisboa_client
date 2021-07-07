<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchTable extends Model
{
    use HasFactory;
    public $table = 'branch_table';
    public $timestamps = false;
}
