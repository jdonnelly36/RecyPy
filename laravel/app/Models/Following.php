<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model {
    use HasFactory;

    protected $table = 'following';

    public $primaryKey = 'id';

    protected $fillable = [
        'following_id',
        'followed_id',
    ];
}
