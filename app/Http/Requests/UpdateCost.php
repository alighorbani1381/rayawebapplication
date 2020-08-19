<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCost extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the Update Cost validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'money_paid' => 'required',
        ];
    }
}
