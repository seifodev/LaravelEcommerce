<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    // id, name, size, file, path, full_file, mime_type, fileable_type, fileable_id
    protected $guarded = [];

    public function fileable()
    {
        return $this->morphTo();
    }
}
