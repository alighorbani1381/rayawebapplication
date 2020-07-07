<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    # Check Access With Gates
    protected function checkAccess($gateName)
    {
        if (Gate::denies($gateName))
            abort(404);
    }

    # Create Absolute Standard Path
    public function standardPath()
    {
        $standard = str_replace('\\', '/', public_path());
        return $standard;
    }

    # Delete Image if Exists
    public function imageDelete($path)
    {
        $path = public_path($path);

        if (file_exists($path))
            $delete = unlink($path);
    }

    # Profile Uploade Image & Resize it
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

    # Uploade Any Image
    public function uplodeImage($file, $pubpath = null, $prefix)
    {
        $filename = $prefix . '-' . time() . "-" . rand(2, 512) . "." . $file->getClientOriginalExtension();
        $path = public_path($pubpath);
        $files = $file->move($path, $filename);
        return $filename;
    }

}
