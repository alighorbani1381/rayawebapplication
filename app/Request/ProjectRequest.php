<?php

namespace App\Request;

use Illuminate\Support\Facades\Validator;

class ProjectRequest
{

    private $request;

    # Get All Request to use in class method
    private  function setRequest($request)
    {
        $this->$request = $request;
    }

    private function getRules()
    {
        return [
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
    }


    # Percent Divide Between Contractors
    public static function percentValidate($request)
    {
        $fileds = ['progress.*' => 'required|numeric|min:1|max:100'];
        $request->validate($fileds);
    }

    private  function getInputs()
    {
        # code...
    }
    public function validate($request)
    {
        $this->setRequest($request);
        $inputs = $this->getInputs();
        $rules = $this->getRules();
        return Validator::make($inputs, $rules);
    }
}
