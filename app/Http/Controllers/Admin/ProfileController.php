<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Request\ProfileRequest;
use App\Repositories\ProfileRepository;

class ProfileController extends AdminController
{

    # Define Profile Path
    const ADMIN_PROFILE_FOLDER = 'profiles\admins\\';

    private $user;

    private $repo;

    public function __construct()
    {

        # Encapsolation Repository 
        $this->repo = resolve(ProfileRepository::class);

        # Set User into This Class
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    # Show User Profile (Edit Profile Page)
    public function index()
    {
        $user = $this->repo->getUserProfile($this->user->id);
        return view('Admin.User.profile', compact('user'));
    }

    # Change Password Method
    public function changePassword(Request $request)
    {
        ProfileRequest::adminCheckParam($request);

        if (!$this->repo->isValidPassword($request->old_password, $this->user->password)) {
            return back();
        }

        return $this->repo->isValidNewPassword($request->old_password, $request->new_password, $request->repeat_password, $this->user->id);
    }

    # Change Profile Image 
    public function changeImage(Request $request)
    {
        ProfileRequest::CheckProfile($request);

        if ($this->user->profile != 'default')
            parent::imageDelete(self::ADMIN_PROFILE_FOLDER . $this->user->profile);

        $image = parent::imageUploade($request->profile, self::ADMIN_PROFILE_FOLDER);

        $this->repo->updateProfile($this->user->id, $image);

        session()->flash('profile-changed');
        return redirect()->route('admin.dashboard');
    }
}
