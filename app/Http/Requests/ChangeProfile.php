<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProfile extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the  Change Profile validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required',
            'repeat_password' => 'required',
        ];
    }
}
