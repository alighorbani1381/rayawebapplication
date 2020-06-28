<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
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
      
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'repeat_password' => 'required'
            ]);

            $isValidCurrentPass = false;
            if(Hash::check($request->old_password, $this->password)){
                $isValidCurrentPass = true;

        if($isValidCurrentPass)
            return 'ok';
        else
        return back();
        // $this->checkNewPassword($request->new_password, $request->repeat_password);
    }

   

    private function checkNewPassword($newPass, $repeatPass)
    {
        if($newPass == $repeatPass)
            return true;
        else
            return false;
    }
}
