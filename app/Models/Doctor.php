<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function specializations()
    {
        return $this->hasMany(SpecializationDoctor::class, 'doctor_id');
    }
}
