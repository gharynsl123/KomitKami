<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $guarded = [];


    function users() {
        return $this->belongsTo('App\User', 'id_user');
    }
}
