<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table   = 'posts';
    protected $guarded = [];
    public $timestamps = true;
    protected $casts   = [
        'extra' => 'array',
    ];

    public function relatedTo() {
      return $this->belongsToMany('Post', 'post_post', 'post_id', 'relatedto_id');
    }

    public function relatedBy() {
      return $this->belongsToMany('Post', 'post_post', 'relatedto_id', 'post_id');
    }

    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }


}
