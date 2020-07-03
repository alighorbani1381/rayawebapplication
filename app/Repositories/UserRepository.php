<?php
namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;

class UserRepository{


    public function userUpdate(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'username' => $request->username,
        ]);
    }

}
