<?php

namespace App\Request;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserRequest
{

    private $request;

    public function getRuleMessage()
    {
        return [
            'username.regex' => 'نام کاربری تنها می تواند دارای حروف انگلیسی باشد.',
            'username.unique' => 'این نام کاربری تکراری است یک نام کاربری دیگر انتخاب کنید .',
            'phone.numeric' => 'فرمت شماره موبایل وارد شده نا معتبر است.',
            'phone.unique' => 'این شماره موبایل در سامانه ثبت شده است از شماره دیگری استفاده کنید.',
        ];
    }
    public function setRequest($request)
    {
        $this->request = $request->all();
    }

    public function setRule($filed)
    {
        return [$filed => 'unique:App\User,' . $filed];
    }

    public function makeUniqueValidator($filed)
    {
        return Validator::make($this->request, $this->setRule($filed), $this->getRuleMessage())->validate();
    }

    public function checkUniqueItem(User $user, $request)
    {
        $this->setRequest($request);

        $userPhone = User::where('phone', $request->phone);
        $userUsername = User::where('username', $request->username);

        if ($userPhone->exists() && $userPhone->first()->id != $user->id)
            return $this->makeUniqueValidator('phone');

        if ($userUsername->exists() && $userUsername->first()->id != $user->id)
            return $this->makeUniqueValidator('username');
    }

    public function userValidation(Request $request, $username = null)
    {

        $fileds = [
            'name' => 'required|max:20',
            'lastname' => 'required|max:30',
            'address' => 'required',
        ];

        if ($username == null) {
            $fileds['phone'] = 'required|unique:App\User,phone|numeric|min:11';
            $fileds['username'] = 'required|unique:App\User,username|regex:/[a-z A-Z0-9\\_\\"]+$/|min:8';
        } else {

            $fileds['phone'] = 'required|numeric|min:11';
            $fileds['username'] = 'required|regex:/[a-z A-Z0-9\\_\\"]+$/|min:8';
        }


        $request->validate($fileds, $this->getRuleMessage());
    }
}
