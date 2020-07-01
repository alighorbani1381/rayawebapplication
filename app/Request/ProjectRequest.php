<?php

namespace App\Request;

use Illuminate\Support\Facades\Validator;

class ProjectRequest
{

    private $request;

    private $contractStart;

    private $completedAt;

    private $dateStart;

    # Get All Request to use in class method
    private  function setRequest($request)
    {
        $this->$request = $request;
    }

    private  function getInputs()
    {
        return [
            'name'             => $this->request->name,
            'lastname'         => $this->request->lastname,
            'father_name'      => $this->request->father_name,
            'meli_code'        => $this->request->meli_code,
            'meli_image'       => $this->request->name,
            'phone'            => $this->request->phone,
            'address'          => $this->request->address,
            'title'            => $this->request->title,
            'description'      => $this->request->description,
            'price'            => $this->request->price,
            'contract_image'   => $this->request->contract_image,
            'contract_started' => $this->contractStart,
            'completed_at'     => $this->completedAt,
            'date_start'       => $this->dateStart,
            'complete_after'   => $this->request->complete_after,
        ];
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

    public function validate($request)
    {
        $this->setRequest($request);
        $inputs = $this->getInputs();
        $rules = $this->getRules();
        return Validator::make($inputs, $rules);
    }


    # Percent Divide Between Contractors
    public static function percentValidate($request)
    {
        $fileds = ['progress.*' => 'required|numeric|min:1|max:100'];
        $request->validate($fileds);
    }
}
