<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;


class ProfileRepository{

    public function isValidPassword($oldPass, $currentPass)
    {
        
        $isValid = true;

        if (! Hash::check($oldPass, $currentPass)){
            session()->flash('currentWrong');
            $isValid = false;
        }

        return $isValid;
    }

    public function isValidNewPassword($oldPass, $newPass, $repeatPass, $userId)
    {
        $user = User::where('id', $userId)->first();
        $isValid =  ($newPass == $repeatPass) ? true : false;
        if (!$isValid) {
            session()->flash('newpass-Wrong', $oldPass);
            return back();
        }
        User::where('id', $userId)
            ->update(['password' =>  Hash::make($newPass)]);
        session()->flash('changed-password');

        if ($user == 'admin')
            return redirect()->route('admin.dashbord');
        else
            return redirect()->route('contractor.dashbord');
    }

    public function getUserProfile($id)
    {
        return User::where('id', $id)->first();
    }

    public function updateAdminProfile($id, $profile)
    {
        User::where('id', $id)
            ->update(['profile' => $profile]);
    }

}