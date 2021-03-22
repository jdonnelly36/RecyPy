<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {
    use HasFactory;

    protected $table = 'ingredients';

    public $primaryKey = 'id';

    protected $fillable = [
        'recipe_id',
        'name',
        'quantity',
        'notes'
    ];

    public function recipe() {
        return $this->belongsTo('App\Models\Recipe');
    }
}
