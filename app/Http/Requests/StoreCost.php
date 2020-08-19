<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCost extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the Cost validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'storeType' => 'required'
        ];
    }
}
