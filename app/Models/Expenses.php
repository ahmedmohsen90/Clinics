<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    public $guarded = [];

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
