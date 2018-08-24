<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentCard extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
}
