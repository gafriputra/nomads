<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPackage extends Model
{
    //mengaktifkan softdelete
    use SoftDeletes;

    // tambahkan fillable,menyimpan seacara langsung
    protected $fillable = [
        'title', 'slug', 'location', 'about', 'featured_event',
        'language', 'foods', 'departure_date', 'duration',
        'type', 'price'
    ];

    protected $hidden = [];

    // bikin relasiuntuk gambar

    public function galleries()
    {
        // menginformasikan bahwa travel packages memiliki banyak gallery
        return $this->hasMany(Gallery::class, 'travel_packages_id', 'id');
    }
}
