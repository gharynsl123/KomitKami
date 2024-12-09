<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $table = 'formula';
    protected $guarded = [];

    function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
    function inventor() {
        return $this->belongsTo('App\Inventor', 'inventor_id');
    }
}
