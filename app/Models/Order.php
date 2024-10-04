<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;
    protected $table = 'orders';

    public function Order_Detail() {
        return $this->hasMany('App\Models\Order_Detail');
    }
}
