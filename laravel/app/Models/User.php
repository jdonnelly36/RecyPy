<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function recipes() {
        return $this->hasMany('App\Models\Recipe', 'creator_id', 'id');
    }

    public function favorites() {
        return $this->belongsToMany('App\Models\Recipe', 'user_favorites', 'user_id', 'recipe_id');
    }

    // returns "one way friendships" i.e following
    public function following() {
        return $this->belongsToMany('App\Models\User', 'friends_pivot', 'user_id', 'friend_id')->wherePivot('mutual', 0);
    }

    // returns mutual friendhips
    public function friends() {
        return $this->belongsToMany('App\Models\User', 'friends_pivot', 'user_id', 'friend_id')->wherePivot('mutual', 1);
    }
}
