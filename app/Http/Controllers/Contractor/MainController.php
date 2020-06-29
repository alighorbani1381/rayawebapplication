<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function standardPath()
    {
        $standard = str_replace('\\', '/', public_path());
        return $standard;
    }

    public function imageDelete($path)
    {
        $path = public_path($path) ;

        if (file_exists($path))
            $delete = unlink($path);
    }

    public function imageUploade($file, $pubpath = null)
    {
        if($pubpath == null)
            return null;

        $filename = time() . "-" . rand(2, 512) . "." . $file->getClientOriginalExtension();
        $path = public_path($pubpath) ;
        $files = $file->move($path, $filename);
        return $filename;
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
