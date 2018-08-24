<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table   = 'pages';
    protected $guarded = [];
    public $timestamps = true;

    public function fields() {
        return $this->morphMany('App\CustomField', 'customizable');
    }

    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
