<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restok extends Model
{
    protected $table = "restok";
    protected $guarded = [];

    function brand() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }
}
