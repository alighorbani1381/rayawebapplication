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
}
