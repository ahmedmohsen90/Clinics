<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    //
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function doctors()
    {
        return $this->hasMany(SpecializationDoctor::class, 'specialization_id');
    }
}
