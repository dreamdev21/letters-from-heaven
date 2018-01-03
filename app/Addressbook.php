<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Addressbook extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userid','title','extendedinfo','firstname','lastname','deliveryadd1','deliveryadd2','city','state','postalcode','country','rephone','reemail',    ];

    protected $table = "addressbook";
}
