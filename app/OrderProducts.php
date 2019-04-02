<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    //
    protected $table = "orderproducts";

    protected $fillable = [
        'orderId', 'productId', 'productPrice', 'productQty', 'status'
    ];
}
