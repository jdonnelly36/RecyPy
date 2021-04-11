<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeTag extends Model {
    use HasFactory;

    protected $table = 'recipe_tags';

    public function recipes() {
        return $this->belongsToMany('App\Models\Recipe', 'recipe_tag_pivot', 'tag_id', 'recipe_id');
    }
}
