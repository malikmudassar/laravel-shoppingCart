<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingClasses extends Model
{
    public function zone() {
        return $this->belongsTo('App\ShippingZones');
    }
}
