<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    //
    protected $guarded = [];
    protected $appends = ['age'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->age;
    }

    public function company()
    {
        return $this->hasOne(InsuranceCustomer::class, 'customer_id');
    }
}
