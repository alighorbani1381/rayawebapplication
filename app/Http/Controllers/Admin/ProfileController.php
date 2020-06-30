<?php

namespace App\Http\Controllers\Admin;

use App\User;

class ProfileController extends AdminController
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
        $user = User::where('id', $this->user->id)->first();
        return view('Admin.User.profile', compact('user'));
    }
}
