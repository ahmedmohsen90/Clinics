<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $guarded = [];

    public function reportable()
    {
        return $this->morphTo();
    }

}
