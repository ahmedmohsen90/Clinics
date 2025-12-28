<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    //
    protected $guarded = [];

    public function doctors()
    {
        return $this->hasMany(SpecializationDoctor::class, 'specialization_id');
    }
}
