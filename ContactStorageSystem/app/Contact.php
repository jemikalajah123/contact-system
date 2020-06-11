<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status_id',
        'name', 
        'email',
        'gender',
        'phone_number',
        'house_address',
    ];

}
