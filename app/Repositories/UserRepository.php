<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;

class UserRepository
{


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
