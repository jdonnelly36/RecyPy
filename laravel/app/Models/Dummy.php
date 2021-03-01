<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

///
/// SEE: https://laravel.com/docs/8.x/eloquent#eloquent-model-conventions
///

class Dummy extends Model {
    use HasFactory;
    protected $table = 'dummy'; // override default table connection with the correct table name
    protected $fillable = ['an_integer']; // put all of the column names in this array (not including default columns)

    // add eloquent functions here
    // this will search specified model (SomeOtherModel) for the dummy_id field and match it with the id field from
    // this model in order to return all of the connected entries
    public function exampleEloquent() {
        return $this->belongsTo('App\SomeOtherModel', 'dummy_id', 'id');
    }
}
