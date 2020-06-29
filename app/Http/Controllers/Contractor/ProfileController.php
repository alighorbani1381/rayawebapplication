<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    private $user;

    private $password;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            $this->password = $this->user->password;
            return $next($request);
        });
    }

    public function info()
    {
        $user = User::where('id', $this->user->id)->first();
        return view('Contractor.Profile.index', compact('user'));
    }

    public function changePassword(Request $request)
    {
        // return $request->all();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'repeat_password' => 'required',
        ]);

        if (!$this->isValidPassword($request->old_password, $this->password)) {
            return back();
        }

        return $this->isValidNewPassword($request->old_password, $request->new_password, $request->repeat_password);
    }

    public function isValidNewPassword($oldPass, $newPass, $repeatPass)
    {
        $isValid =  ($newPass == $repeatPass) ? true : false;
        if (! $isValid){
            session()->flash('newpass-Wrong', $oldPass);
            return back();    
        }
        User::where('id', $this->user->id)
            ->update(['password' =>  Hash::make($newPass)]);
            session()->flash('changed-password');
            return redirect()->route('contractor.dashbord');
    }

    public function isValidPassword($oldPass, $currentPass)
    {
        
        $isValid = true;

        if (! Hash::check($oldPass, $currentPass)){
            session()->flash('currentWrong');
            $isValid = false;
        }

        return $isValid;
    }
}
