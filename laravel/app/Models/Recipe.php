<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model {
    use HasFactory;

    protected $table = 'users';

    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'user_id',
        'created_at',
        'active_time', // in minutes
        'total_time'// in minutes
    ];

    public function steps() {
        return $this->hasMany('App\Models\RecipeStep')
    }

    public function ingredients() {
        return $this->hasMany('App\Models\Ingredient')
    }

    public function author() {
        return $this->belongsTo('App\Models\User');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment')
    }
}
