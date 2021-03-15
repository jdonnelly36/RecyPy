<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedRecipe extends Model {
    use HasFactory;

    protected $table = 'saved_recipes';

    public $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'recipe_id'
    ];
}
