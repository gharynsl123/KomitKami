<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $table = 'formulir';
    protected $guarded = [];

    function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
