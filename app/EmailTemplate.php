<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EmailTemplate extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "email_templates";
    protected $fillable = [
        'name','price','image','state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


}
