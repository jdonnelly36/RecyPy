<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model {
    use HasFactory;

    protected $table = 'likes';

    public $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'recipe_id',
        'score'
    ];
}
