<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SerahTerimaBarang extends Model
{
    protected $table = 'serah_terima_produkjadi';
    protected $guarded = [];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
