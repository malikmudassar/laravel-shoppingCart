<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingZones extends Model
{
    public function classes(){
        return $this->hasMany('App\ShippingClasses');
    }
}
