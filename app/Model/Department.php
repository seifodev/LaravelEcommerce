<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model){

            $model->icon ? \Storage::delete($model->icon) : NULL;
            foreach($model->children as $child)
            {
                $child->icon ? \Storage::delete($child->icon) : NULL;
                $child->delete();
            }

        });
    }

    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }
}
