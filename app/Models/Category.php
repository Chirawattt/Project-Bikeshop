<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category'; // กำหนดชื่อตาราง category ให้กับโมเดล Category

    public function product() {
        return $this->hasMany('App\Models\Product');
    }

}
