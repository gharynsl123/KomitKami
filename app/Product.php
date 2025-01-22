<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $table = 'product';
    protected $guarded = [];

    public function formula()
    {
        return $this->hasMany(Formula::class);
    }
    public function tahapanProses()
    {
        return $this->hasMany(TahapanProses::class);
    }
    public function qualityControl()
    {
        return $this->hasMany(QualityControl::class);
    }

    public function produkjadi()
    {
        return $this->hasMany(SerahTerimaBarang::class);
    }

    function brand() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }
}
