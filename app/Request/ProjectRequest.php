<?php

namespace App\Request;

class ProjectRequest
{
    public static function projectValidate($request)
    {
        $fileds = [
            'name'             => 'required',
            'lastname'         => 'required',
            'father_name'      => 'required',
            'meli_code'        => 'required',
            'meli_image'       => 'default',
            'phone'            => 'required',
            'address'          => 'required',
            'title'            => 'required',
            'description'      => 'required',
            'price'            => 'required',
            'contract_image'   => 'default',
            'contract_started' => 'required',
            'completed_at'     => 'required',
            'date_start'       => 'required',
            'complete_after'   => 'required|numeric|min:1',
        ];

        $request->validate($fileds);
    }

    public static function percentValidate($request)
    {
        $fileds = ['progress.*' => 'required|numeric|min:1|max:100'];
        $request->validate($fileds);
    }
}