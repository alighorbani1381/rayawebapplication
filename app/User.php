<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    public $table = 'users';
    protected $guarded = [];

    public function getFullNameAttribute()
    {
        $fullName = $this->name . " " . $this->lastname;
        return $fullName;
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function getProfileImageAttribute()
    {
        if ($this->profile == 'default')
            $profile = asset('admin/images/users/default.png');
        else
            $profile = $this->profile;
        return $profile;
    }

    public function getIsDefaultPasswordAttribute()
    {
        if (Hash::check('raya-px724', $this->password))
            $status = true;
        else
            $status = false;
        return $status;
    }
}
