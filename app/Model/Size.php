<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
