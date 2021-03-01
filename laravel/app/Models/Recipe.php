<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model {
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'creator_id',
        'created_at',
        'type_id',
    ];

    public function creator() {
        return $this->hasOne('App\Models\User', 'id', 'creator_id');
    }

    public function type() {
        return $this->hasOne('App\Models\RecipeType', 'id','type_id');
    }
}
