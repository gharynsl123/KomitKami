<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckSerahTerimaBarang extends Model
{
    protected $table = 'check_serah_terima_produkjadi';
    protected $guarded = [];

    public function produksi() {
        return $this->belongsTo('App\Produksi', 'produksi_id');
    }

    public function serahTerima() {
        return $this->belongsTo('App\SerahTerimaBarang', 'serah_terima_id');
    }
}
