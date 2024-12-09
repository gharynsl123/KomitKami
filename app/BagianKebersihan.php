<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BagianKebersihan extends Model
{
    protected $table = 'bagian_kebersihan';
    protected $guarded = [];

    public function ruangProduksi() {
        return $this->belongsTo('App\RuangProduksi', 'ruang_produksi_id');
    }
}
