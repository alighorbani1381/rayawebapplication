<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    /**
     * Get the Categories rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'child' => 'required',
        ];
    }
}
