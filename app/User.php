<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',  'password', 'verifyToken'
    ];
    protected $casts   = [
        'extra' => 'array',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function routeNotificationForMail() {
        return $this->email;
    }
    public function routeNotificationForSlack() {
        return config('keys.slack-dev');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function wishList(){
        return $this->hasMany('App\WishList');
    }

    public function payment_card(){
        return $this->hasOne('App\UserPaymentCard');
    }

}
