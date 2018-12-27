<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    //
    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
