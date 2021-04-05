<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model {
    use HasFactory;

    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'created_at',
        'active_time', // in minutes
        'total_time'// in minutes
    ];

    public function steps() {
        return $this->hasMany('App\Models\RecipeStep');
    }

    public function ingredients() {
        return $this->hasMany('App\Models\Ingredient');
    }

    public function author() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\RecipeTag', 'recipe_tag_pivot', 'recipe_id', 'tag_id');
    }
}
