<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model 
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'name', 
        'email',
        'gender',
        'phone_number',
        'house_address',

    ];

}
