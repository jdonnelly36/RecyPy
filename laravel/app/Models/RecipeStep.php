<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model {
    use HasFactory;

    protected $table = 'recipe_steps';

    public $primaryKey = 'id';

    protected $fillable = [
        'recipe_id',
        'step_number',
        'instructions'
    ];

    public function recipe() {
        return $this->belongsTo('App\Models\Recipe')
    }
}