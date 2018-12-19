<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $guarded = [];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
