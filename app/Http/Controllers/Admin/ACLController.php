<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;

class ACLController extends Controller
{

    public function createPermission()
    {
        return view('Admin.ACL.Permission.create');
    }

    public function storePermission(Request $request)
    {
        $request->validate(['name' => 'required', 'title' => 'required']);
        Permission::create($request->all());
    }

    public function createRole()
    {
        $permissions = Permission::get();
        return view('Admin.ACL.Role.create', compact('permissions'));
    }

    public function storeRole(Request $request)
    {
        # code...
    }

}
