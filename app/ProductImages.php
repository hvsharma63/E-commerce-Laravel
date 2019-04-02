<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    //
    protected $table = "productImages";
    protected $primaryKey = 'id';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productId', 'image', 'sort'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
