<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ProfileRepository;
use App\User;
use Illuminate\Http\Request;

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
        $user = User::where('id', $this->user->id)->first();
        return view('Admin.User.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {
        // return $request->all();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'repeat_password' => 'required',
        ]);

        if (!$this->repo->isValidPassword($request->old_password, $this->user->password)) {
            return back();
        }

        $oldPass = $request->old_password;
        $newPass = $request->new_password;
        $reaptPass = $request->repeat_password;
        return $this->repo->isValidNewPassword($oldPass, $newPass, $reaptPass, $this->user->id);
    }

    public function changeImage(Request $request)
    {
        $request->validate(['profile' => 'required|image']);

        if ($this->user->profile != 'default')
            parent::imageDelete(self::ADMIN_PROFILE_FOLDER . $this->user->profile);

        $image = parent::imageUploade($request->profile, self::ADMIN_PROFILE_FOLDER);

        User::where('id', $this->user->id)
            ->update(['profile' => $image]);

        session()->flash('profile-changed');
        return redirect()->route('admin.dashboard');
    }
}
