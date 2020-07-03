<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::where('id', "!=", $this->user->id)
            ->orderBy('type', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(15);
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
        return view('Admin.User.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('Admin.User.edit', compact('user'));
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
        // if (!$request->ajax())
        //     return abort(404);


        $projectId = $request->get('project_id');
        if ($projectId != null) {
            $projectContractors =  DB::table('project_contractor')
                ->where('project_contractor.project_id', $projectId)
                ->join('users', 'project_contractor.contractor_id', '=', 'users.id')
                ->select('users.id', 'users.name', 'users.lastname')
                ->orderBy('project_contractor.progress', 'desc')
                ->get();
            return response()->json(['contractors' => $projectContractors]);
        }

        $contractors = User::where('type', 'contractor')->select('id', 'name', 'lastname')->get();
        $admins = User::where('type', 'admin')->select('id', 'name', 'lastname')->get();
        return response()->json(['contractors' => $contractors, 'admins' => $admins]);
    }

    public function showLogin()
    {
        if (Auth::check())
            return redirect()->route('admin.dashboard');
        else
            return view('Admin.Auth.login');
    }

    public function checkLogin(Request $request)
    {
        $loginInfo = $this->getLoginInfo($request);
        return $this->checkInfo($loginInfo);
    }

    private function checkInfo($loginInfo)
    {
        if (Auth::attempt($loginInfo)) {
            return redirect()->route('admin.dashboard');
            return null;
        }

        session()->flash('LoginFail');
        return redirect()->route('login.show');
    }

    private function getLoginInfo($request)
    {
        return  [
            'username' => $request->username,
            'password' => $request->password
        ];
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('logoutSuccess');
        return redirect()->route('login.show');
    }
}
