<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;

class UserRequest
{

    public static function userValidation(Request $request)
    {

        $fileds = [
            'name' => 'required|max:20',
            'lastname' => 'required|max:30',
            'phone' => 'required|unique:App\User,phone|numeric|min:11',
            'address' => 'required',
            'username' => 'required|unique:App\User,username|regex:/^[a-zA-Z]+$/u|min:8',
        ];

        $messages = [
            'username.regex' => 'نام کاربری تنها می تواند دارای حروف انگلیسی باشد.',
            'username.unique' => 'این نام کاربری تکراری است یک نام کاربری دیگر انتخاب کنید .',
            'phone.numeric' => 'فرمت شماره موبایل وارد شده نا معتبر است.',
            'phone.unique' => 'این شماره موبایل در سامانه ثبت شده است از شماره دیگری استفاده کنید.',
        ];
        $request->validate($fileds, $messages);
    }


}

class UserController extends AdminController
{

    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('Admin.User.index', compact('users'));
    }

    public function login(Request $request)
    {
        return $request->all();
    }


    public function create()
    {
        return view('Admin.User.create');
    }


    public function store(Request $request)
    {
        UserRequest::userValidation($request);
        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'address' => $request->address,
            'type' => $request->type,
            'username' => $request->username,
            'password' => 'raya-px724',
        ]);
        return redirect()->route('users.index');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('deleteUser');
        return redirect()->route('users.index');
    }

    public function getContractors(Request $request)
    {
        if(! $request->ajax())
        return null;

        $contractors = User::where('type', 'contractor')->get();
        $admins = User::where('type', 'admin')->get();
        return response()->json(['contractors' => $contractors, 'admins' => $admins]);
    }
}
