<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCase extends Model
{
    protected $guarded = [];

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function status()
    {
        return $this->hasOne(CustomerCaseStatus::class, 'customer_case_id')->latest();
    }

    public function statuses()
    {
        return $this->hasMany(CustomerCaseStatus::class, 'customer_case_id');
    }
}
