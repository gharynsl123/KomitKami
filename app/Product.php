<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $table = 'product';
    protected $guarded = [];

    function brand() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }
}
