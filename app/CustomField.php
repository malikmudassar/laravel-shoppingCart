<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $table   = 'custom_fields';
    protected $guarded = [];
    public $timestamps = true;
    protected $casts   = [
        'value' => 'array',
    ];

    public function customizable() {
        return $this->morphTo();
    }
}
