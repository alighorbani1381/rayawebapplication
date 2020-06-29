<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class MainController extends Controller
{
    public function standardPath()
    {
        $standard = str_replace('\\', '/', public_path());
        return $standard;
    }

    public function imageDelete($path)
    {
        $path = public_path($path);

        if (file_exists($path))
            $delete = unlink($path);
    }

    public function imageUploade($file, $pubpath = null)
    {
        if ($pubpath == null)
            return null;

        $filename = time() . "-" . rand(2, 512) . "." . $file->getClientOriginalExtension();
        $path = public_path($pubpath);
        $files = $file->move($path, $filename);

        $img = Image::make($files->getRealPath());
        $img->resize("512", "512");
        $img->save($path . "/Profile-" . $filename);

        unlink($files->getRealPath());

        return "/Profile-" . $filename;
    }


    public function search($class = User::class, $field, $data, $pagin = 10)
    {
        $results = $class::latest()->orderBy($field[0], $field[1])->paginate($pagin);
        if (sizeof($data) > 0 && array_key_exists('search', $data))
            $results = $class::where($field, 'like', '%' . $data['search'] . '%')
                ->orderBy($field)
                ->paginate($pagin);


        return $results;
    }
}
