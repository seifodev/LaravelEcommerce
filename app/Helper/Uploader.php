<?php

namespace App\Helper;
use \Storage;
use Illuminate\Http\Request;
use App\File;

class Uploader
{

    /**
     * @param Request $request
     * @param array $data
     * @return false|string
     */
    public function upload(Request $request, array $data = [], $multiple = false)
    {
        if($multiple === false)
        {
            $name = isset($data['name']) ? $data['name'] : time() . rand(999, 9999);
            $name .= '.' . $request->file($data['file'])->getClientOriginalExtension();
            $path = $data['path'];
            $file = $request->file($data['file']);

            isset($data['delete']) ?
                (Storage::has($data['delete']) ? Storage::delete($data['delete']) : NULL) :
                NULL;

            return $file->storeAs($path, $name);

        } else
        {
            $files = $request->file($data['file']);

            $files_array = [];

            foreach($files as $file)
            {
                $name = time() . rand(999, 9999);
                $name .= '.' . $file->getClientOriginalExtension();
                $file_original_name = $file->getClientOriginalName();
                $file_size = $file->getClientSize();
                $file_file = $name;
                $file_path = $data['path'];
                $file_mime_type = $file->getClientMimeType();
                $full_file = $file->storeAs($file_path, $name);
                //name, size, file, path, full_file, mime_type, fileable_type, fileable_id
                $files_array[] = [
                    'name' => $file_original_name,
                    'size' => $file_size,
                    'file' => $file_file,
                    'path' => $file_path,
                    'full_file' => $full_file,
                    'mime_type' => $file_mime_type,
                ];
            }

            return $data['model']->files()->createMany($files_array);

        }

    }
}