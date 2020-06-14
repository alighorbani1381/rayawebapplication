<?php

namespace App\Http\Controllers\Admin;
use App\User;
use Illuminate\Http\Request;

class UserController extends AdminController
{

    public function index(){

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
        //
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
        //
    }
}
