<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ACLController extends Controller
{

    private function isAccessChangeRole(User $user)
    {
        if (!$user->isAdmin() && $user->id == auth()->user()->id)
            abort(404);
    }

    public function indexPermission()
    {
        $permissions = Permission::orderBy('id', 'asc')->get();
        return view('Admin.ACL.Permission.index', compact('permissions'));
    }

    public function createPermission()
    {
        return view('Admin.ACL.Permission.create');
    }

    public function storePermission(Request $request)
    {
        $request->validate(['name' => 'required', 'title' => 'required', 'permission_id' => 'array']);
        Permission::create($request->all());
        return redirect()->route('per.create');
    }


    public function indexRole()
    {
        $roles = Role::get();        
        return view('Admin.ACL.Role.index', compact('roles'));
    }

    public function editRole(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = $role->permissions()->get();
        return view('Admin.ACL.Role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function createRole()
    {
        $permissions = Permission::get();
        return view('Admin.ACL.Role.create', compact('permissions'));
    }

    public function updateRole(Request $request, Role $role)
    {
        $request->validate(['name' => 'required', 'title' => 'required', 'permission_id' => 'array']);
        $role->update($request->all());
        $role->permissions()->sync($request->input('permission_id'));
        return redirect()->route('roles.index');
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
        $this->isAccessChangeRole($user);
        $userRoles = $user->roles()->get();
        $roles = Role::get();
        return view('Admin.ACL.Role.user', compact('roles', 'user', 'userRoles'));
    }

    public function userRoleStore(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $this->isAccessChangeRole($user);

        $user->roles()->sync($request->input('role_id'));

        return redirect()->route('users.show', $user->id);
    }
}
