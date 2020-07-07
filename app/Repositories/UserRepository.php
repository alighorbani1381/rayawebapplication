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
        $time = date("Y-m-d h:m:s");
        return DB::table('users')
            ->insert([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'address' => $request->address,
                'type' => $request->type,
                'username' => $request->username,
                'profile' => 'default',
                'password' => $this->generatePassword(),
                'created_at'=> $time,
            ]);
    }
}
