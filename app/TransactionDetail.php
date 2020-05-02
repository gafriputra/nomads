<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    //mengaktifkan softdelete
    use SoftDeletes;

    // tambahkan fillable,menyimpan seacara langsung
    protected $fillable = [
        'transactions_id', 'username', 'nationality',
        'is_visa', 'doe_passport'
    ];

    protected $hidden = [];

    public function transaction()
    {
        // belongsto itu punyanya siapa, nyambungin
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }
}
