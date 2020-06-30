<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ProfileRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends AdminController
{
    private $user;

    private $repo;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });

        $this->repo = resolve(ProfileRepository::class);
    }

    public function index()
    {
        $user = User::where('id', $this->user->id)->first();
        return view('Admin.User.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {
        // return $request->all();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'repeat_password' => 'required',
        ]);

        if (!$this->repo->isValidPassword($request->old_password, $this->user->password)) {
            return back();
        }

        $oldPass = $request->old_password;
        $newPass = $request->new_password;
        $reaptPass = $request->repeat_password;
        return $this->repo->isValidNewPassword($oldPass, $newPass, $reaptPass, $this->user->id);
    }

   
}
