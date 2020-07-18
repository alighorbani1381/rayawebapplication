<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserRepository
{

    private $id;

    public function setUserId($userId)
    {
        $this->id = $userId;
    }

    private function hasProject()
    {
        return DB::table('project_contractor')
            ->where('contractor_id', $this->id)
            ->exists();
    }

    private function isCreateProject()
    {
        return DB::table('projects')
            ->where('project_creator', $this->id)
            ->exists();
    }

    private function hasEarning()
    {
        return DB::table('earnings')
            ->where('generator', $this->id)
            ->exists();
    }

    private function hasCost()
    {
        return DB::table('costs')
            ->where('generator', $this->id)
            ->exists();
    }

    private function hasContractorCost()
    {
        return DB::table('costs')
            ->where('contractor_id', $this->id)
            ->exists();
    }

    private function hasContractorDependency()
    {
        return $this->hasContractorCost();
    }

    private function hasAdminDependency()
    {
        return ($this->hasProject() || $this->isCreateProject() || $this->hasEarning() || $this->hasCost());
    }

    public function hasDependency($userId)
    {
        $this->setUserId($userId);
        return ($this->hasAdminDependency() || $this->hasContractorDependency());
    }

    public function userUpdate(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'username' => $request->username,
        ]);
    }

    public function getUsers($userId)
    {
        return User::where('id', "!=", $userId)
            ->orderBy('type', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(15);
    }

    private function generatePassword()
    {
        return bcrypt("raya-px724");
    }

    public function createUser(Request $request)
    {
        $time = date("Y-m-d H:m:s");
        return DB::table('users')
            ->insertGetId([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'address' => $request->address,
                'type' => $request->type,
                'username' => $request->username,
                'profile' => 'default',
                'password' => $this->generatePassword(),
                'created_at' => $time,
                'updated_at' => $time,
            ]);
    }

    public function getProjectContractors($projectId)
    {
        return DB::table('project_contractor')
            ->select('users.id', 'users.name', 'users.lastname')
            ->join('users', 'project_contractor.contractor_id', '=', 'users.id')
            ->where('project_contractor.project_id', $projectId)
            ->orderBy('project_contractor.progress', 'desc')
            ->get();
    }

    public function getContractors()
    {
        return User::where('type', 'contractor')->select('id', 'name', 'lastname')->get();
    }

    public function getAdmins()
    {
        return User::where('type', 'admin')->select('id', 'name', 'lastname')->get();
    }

    public function getUserRoles(User $user)
    {
        return $user->roles()->get();
    }

    public function getPermissions($roles)
    {
        $permissions = collect([]);
        foreach ($roles as $role)
            $permissions = $role->permissions()->get();

        return $permissions;
    }

    public function getUnique($titles)
    {
        $col = collect($titles);
        return $col->unique();
    }

    public function getPermissionsName(User $user)
    {
        $roles = $this->getUserRoles($user);
        $permissions = $this->getPermissions($roles);
        return $this->getUnique($permissions);
    }

    public function empty()
    {
        return collect([]);
    }

    public function getUserProfile(User $user)
    {
        $rootFolder = ($user->isAdmin()) ?  "profiles\admins\\" : "profiles\users\\";
        $fullPath = public_path($rootFolder . $user->profile);
        return $fullPath;
    }

    public function removeProfile(User $user)
    {
        $fullPath = $this->getUserProfile($user);
        if (file_exists($fullPath))
            unlink($fullPath);
    }

    public function fullDelete(User $user)
    {
        $this->removeProfile($user);
        $user->delete();
    }
}
