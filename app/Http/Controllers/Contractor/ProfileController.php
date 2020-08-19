<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Requests\ChangeProfile;
use Illuminate\Http\Request;
use App\Request\ProfileRequest;
use App\Repositories\ProfileRepository;

class ProfileController extends MainController
{

    const USERS_PROFILE_FOLDER = 'profiles\users\\';

    private $repo;

    private $user;

    private $password;

    public function __construct()
    {

        # Encapsolation Repository
        $this->repo = resolve(ProfileRepository::class);

        # Set User in this Controller
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            $this->password = $this->user->password;
            return $next($request);
        });
    }

    # Show User Info
    public function info()
    {
        $user = $this->repo->getUserProfile($this->user->id);
        return view('Contractor.Profile.index', compact('user'));
    }

    # Change Contractor Password
    public function changePassword(ChangeProfile $request)
    {        

        if (!$this->repo->isValidPassword($request->old_password, $this->password)) {
            return back();
        }

        return $this->repo->isValidNewPassword($request->old_password, $request->new_password, $request->repeat_password);
    }

    # Change Contractor Image Profile
    public function changeImage(Request $request)
    {
        ProfileRequest::CheckProfile($request);

        if ($this->user->profile != 'default') {
            parent::imageDelete(self::USERS_PROFILE_FOLDER . $this->user->profile);
        }

        $image = parent::imageUploade($request->profile, self::USERS_PROFILE_FOLDER);

        $this->repo->updateProfile($this->user->id, $image);

        session()->flash('profile-changed');
        return redirect()->route('contractor.dashbord');
    }
}
