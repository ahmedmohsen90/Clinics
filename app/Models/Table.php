<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $guarded = [];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'table_id');
    }
}
