<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Orders extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userid','order_id', 'pro_type','pro_id','pro_price','pro_text','pro_image','pro_qty','pro_name','title','extendedinfo','firstname','lastname','deliveryadd1','deliveryadd2','city','state','postalcode','country','rephone','reemail','deliverydate','deliverytype','cardmessage','signature','orderstate','adminnote', 'draftstate',   ];

    protected $table = "orders";
}
