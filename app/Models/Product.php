<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product'; // กำหนดชื่อตาราง product ให้กับโมเดล Product
    protected $fillable = ['name', 'price', 'category_id', 'stock_qty']; // กำหนดให้สามารถเพิ่มข้อมูลในฟิลด์ดังกล่าวได้

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
}
