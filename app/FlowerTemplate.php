<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FlowerTemplate extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "flower_templates";
    protected $fillable = [
        'name','price','image','image1','image2','image3','image4','image5','image6','image7','image8','image9','image10','image11','image12','image13','image14','image15','image16','image17','image18','image19','state','detail',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


}
