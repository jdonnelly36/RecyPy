<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeType extends Model {
    use HasFactory;

    protected $table = 'recipe_type';

    protected $fillable = [
        'name',
        'id'
    ];

    public function recipes() {
        return $this->hasMany('App\Recipe', 'type_id', 'id');
    }
}
