<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table   = 'tags';
    protected $guarded = [];
    public $timestamps = true;

    public function posts() {
        return $this->morphedByMany('App\Post', 'taggable');
    }

    public function pages() {
        return $this->morphedByMany('App\Page', 'taggable');
    }


}
