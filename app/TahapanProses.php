<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahapanProses extends Model
{
    protected $table = 'tahapan_proses';
    protected $guarded = [];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
