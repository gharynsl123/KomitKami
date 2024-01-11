<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = 'product';
    protected $guarded = [];

    function brand() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
    
    function formula() {
        return $this->belongsTo('App\Formula', 'formula_id');
    }
}
