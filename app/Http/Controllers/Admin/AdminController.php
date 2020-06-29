<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        // auth()->loginUsingId(1);
    }

    public function standardPath()
    {
        $standard = str_replace('\\', '/', public_path());
        return $standard;
    }

    public function imageDelete($path)
    {
        if (file_exists($path))
            $delete = unlink($path);
        else
            $delete = false;

        return $delete;
    }

    public function imageUploade($file, $pubpath = null)
    {
        $filename = time() . "-" . rand(2, 512) . "." . $file->getClientOriginalExtension();
        $path = public_path('Uploads/' . $pubpath);
        $files = $file->move($path, $filename);
        return '/Uploads/' . $pubpath . $filename;
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
