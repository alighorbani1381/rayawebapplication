<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEarning extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    /**
     * Get the Earning validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title.*' => 'required',
            'received_money.*' => 'required|numeric|min:1',
            'status.*' => 'required',
        ];
    }
}
