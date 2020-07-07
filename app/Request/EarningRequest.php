<?php

namespace App\Request;

class EarningRequest
{

    public static function storeValidate($request)
    {
        $request->validate([
            'title.*' => 'required',
            'received_money.*' => 'required|numeric|min:1',
            'status.*' => 'required',
        ]);
    }
}