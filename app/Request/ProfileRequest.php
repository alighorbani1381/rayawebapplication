<?php

namespace App\Request;

class ProfileRequest
{

    static function CheckProfile($request)
    {
        return $request->validate(['profile' => 'required|image']);
    }
}
