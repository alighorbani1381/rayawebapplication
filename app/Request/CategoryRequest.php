<?php

namespace App\Request;

class CategoryRequest
{

    public static function store($request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'child' => 'required',
        ]);
    }
}