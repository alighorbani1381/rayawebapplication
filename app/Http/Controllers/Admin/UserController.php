<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

        if ($username == null)
            $fileds = [
                'name' => 'required|max:20',
                'lastname' => 'required|max:30',
                'phone' => 'required|unique:App\User,phone|numeric|min:11',
                'address' => 'required',
                'username' => 'required|unique:App\User,username|regex:/^[a-zA-Z]+$/u|min:8',
            ];
        else
            $fileds = [
                'name' => 'required|max:20',
                'lastname' => 'required|max:30',
                'phone' => 'required|numeric|min:11',
                'address' => 'required',
                'username' => 'required|regex:/^[a-zA-Z]+$/u|min:8',
            ];


        $request->validate($fileds, $this->getRuleMessage());
    }
}

class UserController extends AdminController
{

    private $user;

    private $requ;

    private $repo;

    public function __construct()
    {
        # Connect Repository
        $this->repo = resolve(UserRepository::class);

        # Connect Request Handler
        $this->requ = resolve(UserRequest::class);

        # Encapsulation User in this Controller
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    # Show List of Users
    public function index()
    {
        $users = $this->repo->getUsers($this->user->id);
        return view('Admin.User.index', compact('users'));
    }

    # User Create View
    public function create()
    {
        return view('Admin.User.create');
    }

    # User Store Data & Validate
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

    # Show User Detail
    public function show(User $user)
    {
        return view('Admin.User.show', compact('user'));
    }

    # User Edit View
    public function edit(User $user)
    {
        return view('Admin.User.edit', compact('user'));
    }

    # User Update Method
    public function update(Request $request, User $user)
    {
        $this->requ->userValidation($request, 'updateValidation');
        $this->requ->checkUniqueItem($user, $request);
        $this->repo->userUpdate($request, $user);

        session()->flash('UserUpdate');
        return redirect()->route('users.index');
    }


    # Remove User From System
    public function destroy(User $user)
    {
        if ($user->hasDependency()) {
            Session::flash('NotDeleteUser');
        } else {
            $user->delete();
            Session::flash('deleteUser');
        }

        return redirect()->route('users.index');
    }

    # Get Contractors from Ajax Request
    public function getContractors(Request $request)
    {
        if (!$request->ajax())
            return abort(404);

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

    # is Valid date to Login
    public function checkLogin(Request $request)
    {
        $loginInfo = $this->getLoginInfo($request);
        return $this->checkInfo($loginInfo);
    }

    # Check User info access to Login or No
    private function checkInfo($loginInfo)
    {
        if (Auth::attempt($loginInfo)) {
            return redirect()->route('admin.dashboard');
        }

        session()->flash('LoginFail');

        return redirect()->route('login.show');
    }

    # Get User Info from Request
    private function getLoginInfo($request)
    {
        return  [
            'username' => $request->username,
            'password' => $request->password
        ];
    }

    # Logout User
    public function logout()
    {
        Auth::logout();
        Session::flash('logoutSuccess');
        return redirect()->route('login.show');
    }
}
