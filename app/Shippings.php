<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Shippings extends Model
{
    //
    use Notifiable;
    //
    protected $table = "shippings";
    // public $timestamps = true;

    protected $fillable = [
        'userId', 'billingId', 'firstName', 'lastName', 'email', 'address', 'city', 'state',
        'mobile', 'zip', 'fax', 'status'
    ];
}
