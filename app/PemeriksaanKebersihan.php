<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanKebersihan extends Model
{
    protected $table = 'pemeriksaan_kebersihan';
    protected $guarded = [];

    public function produksi() {
        return $this->belongsTo('App\Produksi', 'produksi_id');
    }
    
    public function bagianKebersihan() {
        return $this->belongsTo('App\BagianKebersihan', 'bagian_kebersihan_id');
    }

}
