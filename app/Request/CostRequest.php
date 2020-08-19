<?php

namespace App\Request;

class CostRequest{

    public function update($request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'money_paid' => 'required',
        ]);
    }

   
}