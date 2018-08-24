<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table   = 'comments';
    protected $guarded = [];
    public $timestamps = true;
    protected $casts   = [
        'extra' => 'array',
    ];

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function commentable() {
        return $this->morphTo();
    }
}
