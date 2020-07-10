<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Request\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;


class UserController extends AdminController
{

    # Define Acess Gate
    const INDEX = "Index-User";
    
    const CREATE = "Create-User";
    
    const SHOW = "Show-User";
    
    const EDIT = "Edit-User";
    
    const DELETE = "Delete-User";

    const MULTI_ACCESS = [self::INDEX, self::CREATE, self::SHOW, self::EDIT, self::DELETE];

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
        $this->checkMultiAccess(self::MULTI_ACCESS);
        $users = $this->repo->getUsers($this->user->id);
        return view('Admin.User.index', compact('users'));
    }

    # User Create View
    public function create()
    {
        $this->checkAccess(self::CREATE);
        return view('Admin.User.create');
    }

    # User Store Data & Validate
    public function store(Request $request)
    {
        $this->checkAccess(self::CREATE);
        $this->requ->userValidation($request);
        $user = $this->repo->createUser($request);
        return redirect()->route('users.show', $user);
    }

    # Show User Detail
    public function show(User $user)
    {
        $this->checkAccess(self::SHOW);
        $permissions = $user->isAdmin() ? $this->repo->getPermissionsName($user) : $this->repo->empty();
        $roles = $user->isAdmin() ? $this->repo->getUserRoles($user) : $this->repo->empty();
        return view('Admin.User.show', compact('user', 'roles', 'permissions'));
    }

    # User Edit View
    public function edit(User $user)
    {
        $this->checkAccess(self::EDIT);
        return view('Admin.User.edit', compact('user'));
    }

    # User Update Method
    public function update(Request $request, User $user)
    {
        $this->checkAccess(self::EDIT);
        $this->requ->userValidation($request, 'updateValidation');
        $this->requ->checkUniqueItem($user, $request);
        $this->repo->userUpdate($request, $user);

        session()->flash('UserUpdate');
        return redirect()->route('users.index');
    }


    # Remove User From System
    public function destroy(User $user)
    {
        $this->checkAccess(self::EDIT);
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
        if (!$request->ajax()) {
            abort(404);
        }

        $projectId = $request->get('project_id');

        if ($projectId != null) {
            $projectContractors = $this->repo->getProjectContractors($projectId);
            return response()->json(['contractors' => $projectContractors]);
        }

        $contractors = $this->repo->getContractors();
        $admins = $this->repo->getAdmins();
        return response()->json(['contractors' => $contractors, 'admins' => $admins]);
    }

    # Show Login Form (Check)
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
