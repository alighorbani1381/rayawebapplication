<?php

namespace App\Http\Controllers\Contractor;

use App\Repositories\ProfileRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class ProfileController extends MainController
{

    const USERS_PROFILE_FOLDER = 'profiles\users\\';

    private $user;

    private $password;

    private $repo;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            $this->password = $this->user->password;
            return $next($request);
        });
        $this->repo = resolve(ProfileRepository::class);
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

        if (!$this->repo->isValidPassword($request->old_password, $this->password)) {
            return back();
        }

        return $this->repo->isValidNewPassword($request->old_password, $request->new_password, $request->repeat_password);
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

   

    public function changeImage(Request $request)
    {
        $request->validate(['profile' => 'required|image']);

        if($this->user->profile != 'default')
        parent::imageDelete(self::USERS_PROFILE_FOLDER . $this->user->profile);

        $image = parent::imageUploade($request->profile, self::USERS_PROFILE_FOLDER);
        
        User::where('id', $this->user->id)
        ->update(['profile' => $image]);

        session()->flash('profile-changed');
        return redirect()->route('contractor.dashbord');
    }
}
