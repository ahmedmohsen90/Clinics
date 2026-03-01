<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function specializations()
    {
        return $this->hasMany(SpecializationWallet::class, 'wallet_id');
    }
}
