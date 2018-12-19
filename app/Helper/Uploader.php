<?php

namespace App\Helper;
use \Storage;
use Illuminate\Http\Request;

class Uploader
{

    /**
     * @param Request $request
     * @param array $data
     * @return false|string
     */
    public function upload(Request $request, array $data = [])
    {
        $name = isset($data['name']) ? $data['name'] : time() . rand(999, 9999);
        $name .= '.' . $request->file($data['file'])->getClientOriginalExtension();
        $path = $data['path'];
        $file = $request->file($data['file']);

        isset($data['delete']) ?
            (Storage::has($data['delete']) ? Storage::delete($data['delete']) : NULL) :
                NULL;

        return $file->storeAs($path, $name);

    }
}