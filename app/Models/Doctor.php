<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $guarded = [];

    public function specializations()
    {
        return $this->hasMany(SpecializationDoctor::class, 'doctor_id');
    }
}
