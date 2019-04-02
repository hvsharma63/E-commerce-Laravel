<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //    use Notifiable;

    protected $table = "products";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoryId', 'thumbnail', 'name', 'upc', 'colorId', 'ram', 'battery', 'processor', 'price', 'stock'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'status'
    ];
}
