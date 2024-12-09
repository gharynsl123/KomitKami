<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RuangProduksi extends Model
{
    protected $table = 'ruang_produksi';
    protected $guarded =  [];

    public function items()
    {
        return $this->hasMany(BagianKebersihan::class);
    }

}
