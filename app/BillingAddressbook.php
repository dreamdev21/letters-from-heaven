<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BillingAddressbook extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id','userid','billingfirstname','billinglastname','billingaddress1','billingaddress2','billingcity','billingcountry','billingpostalcode', 'billingaddressstate',    ];

    protected $table = "billingaddressbook";
}
