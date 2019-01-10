<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function trademark()
    {
        return $this->belongsTo(Trademark::class);
    }

    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function weight()
    {
        return $this->belongsTo(Weight::class);
    }

    public function currency()
    {
        return $this->belongsTo(Country::class);
    }

    public function files()
    {
        return $this->morphMany(\App\File::class, 'fileable');
    }
}
