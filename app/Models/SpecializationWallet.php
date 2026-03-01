<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecializationWallet extends Model
{
    protected $guarded = [];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }
}
