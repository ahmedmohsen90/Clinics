<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceCustomer extends Model
{
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(InsuranceCompany::class, 'insurance_company_id');
    }
}
