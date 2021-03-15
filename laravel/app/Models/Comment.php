<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;

    protected $table = 'comments';

    public $primaryKey = 'id';

    protected $fillable = [
        'recipe_id',
        'user_id',
        'comment'
    ];

    public function recipe() {
        return $this->belongsTo('App\Models\Recipe')
    }
    public function user() {
        return $this->belongsTo('App\Models\User')
    }
}
