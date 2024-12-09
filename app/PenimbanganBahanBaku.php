<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenimbanganBahanBaku extends Model
{
    protected $table = 'penimbangan_bahan_baku';
    protected $guarded = [];
    
    public function produksi() {
        return $this->belongsTo('App\Produksi', 'produksi_id');
    }
}
