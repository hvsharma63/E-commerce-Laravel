<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Billings extends Model
{
    use Notifiable;
    //
    protected $table = "billings";
    // public $timestamps = true;

    protected $fillable = [
        'userId', 'firstName', 'lastName', 'email', 'address', 'city', 'state',
        'mobile', 'zip', 'fax', 'status'
    ];
}
