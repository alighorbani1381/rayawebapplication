<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProfilePicture extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the Change Profile Picture validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profile' => 'required|image'
        ];
    }
}
