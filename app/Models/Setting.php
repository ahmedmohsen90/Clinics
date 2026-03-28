<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $guarded = [];

    protected $hidden = [
        'name_ar',
        'name_en',
    ];

    protected $appends = ['name'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function getNameAttribute()
    {
        if (Lang() == "ar") {
            return $this->name_ar;
        }
        return $this->name_en;
    }

}
