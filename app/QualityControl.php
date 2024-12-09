<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualityControl extends Model
{
    protected $table = 'quality_control';
    protected $guarded = [];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
