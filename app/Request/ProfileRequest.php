<?php

namespace App\Request;

class ProfileRequest
{
    static function adminCheckParam($request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'repeat_password' => 'required',
        ]);
    }

    static function CheckProfile($request)
    {
        return $request->validate(['profile' => 'required|image']);
    }
}
