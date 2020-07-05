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

    public function hasDependency($userId)
    {
        $this->setUserId($userId);
        return ($this->hasProject() || $this->isCreateProject() || $this->hasEarning() || $this->hasCost());
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
}
