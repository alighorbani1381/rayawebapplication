<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Request\ProfileRequest;
use App\Repositories\ProfileRepository;

class ProfileController extends AdminController
{

    const ADMIN_PROFILE_FOLDER = 'profiles\admins\\';

    private $user;

    private $repo;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });

        $this->repo = resolve(ProfileRepository::class);
    }

    public function index()
    {
        $user = $this->repo->getUserProfile($this->user->id);
        return view('Admin.User.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {
        ProfileRequest::adminCheckParam($request);

        if (!$this->repo->isValidPassword($request->old_password, $this->user->password)) {
            return back();
        }
        
        return $this->repo->isValidNewPassword($request->old_password, $request->new_password, $request->repeat_password, $this->user->id);
    }

    public function changeImage(Request $request)
    {
        ProfileRequest::adminCheckProfile($request);

        if ($this->user->profile != 'default')
            parent::imageDelete(self::ADMIN_PROFILE_FOLDER . $this->user->profile);

        $image = parent::imageUploade($request->profile, self::ADMIN_PROFILE_FOLDER);

        $this->repo->updateAdminProfile($this->user->id, $image);

        session()->flash('profile-changed');
        return redirect()->route('admin.dashboard');
    }
}
