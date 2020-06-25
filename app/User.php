<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
