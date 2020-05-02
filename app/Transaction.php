<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    //mengaktifkan softdelete
    use SoftDeletes;

    // tambahkan fillable,menyimpan seacara langsung
    protected $fillable = [
        'travel_packages_id', 'users_id', 'additional_visa',
        'transaction_total', 'transaction_status'
    ];

    protected $hidden = [];

    // bikin relasiuntuk detail

    public function details()
    {
        // menginformasikan bahwa transaction memiliki banyak TransactionDetail

        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    }

    public function travel_package()
    {

        // belongsto itu punyanya siapa

        return $this->belongsTo(TravelPackage::class, 'travel_packages_id', 'id');
    }

    public function user()
    {
        // belongsto itu punyanya siapa

        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
