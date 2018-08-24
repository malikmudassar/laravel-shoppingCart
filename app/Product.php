<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function offer(){
        return $this->has('App\Offer');
    }
}
