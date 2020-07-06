<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ACLController extends Controller
{

    public function indexPermission()
    {
        $permissions = Permission::get();
        return view('Admin.ACL.Permission.index', compact('permissions'));
    }

    public function createPermission()
    {
        return view('Admin.ACL.Permission.create');
    }

    public function storePermission(Request $request)
    {
        $request->validate(['name' => 'required', 'title' => 'required']);
        Permission::create($request->all());
        return redirect()->route('per.index');
    }


    public function indexRole()
    {
        $roles = Role::get();
        return view('Admin.ACL.Role.index', compact('roles'));
    }

    public function createRole()
    {
        $permissions = Permission::get();
        return view('Admin.ACL.Role.create', compact('permissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required', 'title' => 'required', 'permission_id' => 'array']);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permission_id'));
        return redirect()->route('roles.index');
    }

    public function userRole(User $user)
    {
        if (!$user->isAdmin())
            abort(404);

        $roles = Role::get();
        return view('Admin.ACL.Role.user', compact('roles', 'user'));
    }

    public function userRoleStore(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        if (!$user->isAdmin())
            abort(404);

        $user->roles()->sync($request->input('role_id'));

        return redirect()->route('users.index');
    }

}
