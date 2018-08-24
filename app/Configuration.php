<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table   = 'configurations';
    protected $guarded = [];
    public $timestamps = true;
    protected $casts   = [
        'value' => 'array',
    ];
}
