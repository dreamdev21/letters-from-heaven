<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Creditcard extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id','userid','cardfirstname','cardlastname','card-number','expiredatemonth','expiredateyear','cvv',   ];

    protected $table = "creditcard";
}
