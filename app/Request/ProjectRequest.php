<?php

namespace App\Request;

class ProjectRequest
{

    public function checkDateFormat($date)
    {
        $params = explode('/', $date);
        $isValid = (count($params) < 3) ? true : false;
        if (!$isValid)
            return false;

        foreach ($params as $param)
            if (is_numeric($param))
                return false;
    }

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
        dd($request->contract_started);
    }

    public static function percentValidate($request)
    {
        $fileds = ['progress.*' => 'required|numeric|min:1|max:100'];
        $request->validate($fileds);
    }
}