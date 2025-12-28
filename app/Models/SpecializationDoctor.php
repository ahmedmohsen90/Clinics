<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecializationDoctor extends Model
{
    //
    protected $guarded = [];

    public function doctor(){
        return $this->belongsTo(Doctor::class ,'doctor_id');
    }

    public function specialization(){
        return $this->belongsTo(Specialization::class ,'specialization_id');
    }
}
