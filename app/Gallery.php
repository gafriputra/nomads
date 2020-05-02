<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    //mengaktifkan softdelete
    use SoftDeletes;

    // tambahkan fillable,menyimpan seacara langsung
    protected $fillable = [
        'travel_packages_id', 'image'
    ];

    protected $hidden = [];

    // membuat relasi gallery dengan travel_packages
    public function travel_package()
    {
        // belongsto itu punyanya siapa
        return $this->belongsTo(TravelPackage::class, 'travel_packages_id', 'id');
    }
}
