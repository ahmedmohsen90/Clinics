<?php

namespace App\Models;

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

    public function getNameAttribute()
    {
        if (Lang() == "ar") {
            return $this->name_ar;
        }
        return $this->name_en;
    }

}
