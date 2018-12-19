<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $guarded = [];


    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
