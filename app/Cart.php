<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cart extends Model
{
    //
    use Notifiable;

    protected $table = "Cart";
    public $timestamps = true;

    protected $fillable = [
        'userId', 'productId', 'quantity', 'price'
    ];
}
