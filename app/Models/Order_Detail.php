<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model {
    use HasFactory;
    protected $table = 'order_details';

    public function Order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function Product() {
        return $this->belongsTo('App\Models\Product');
    }
}
