<?php

namespace App;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const DEFAULT_PASSWORD = "raya-px724";

    public $table = 'users';

    protected $guarded = [];

    private $repo;


    # Encapsolation Repository
    public function __construct()
    {
        $this->repo = resolve(UserRepository::class);
    }


    # Set Relation Role Model
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    # Set Relation Project Model
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    # Mutator fullname Attribute
    public function getFullNameAttribute()
    {
        $fullName = $this->name . " " . $this->lastname;
        return $fullName;
    }

    # Get Profile Image or Get Default Profile Image
    public function getProfileImageAttribute()
    {
        if ($this->profile == 'default')
            $profile = asset('admin/images/users/default.png');
        else
            $profile = $this->profile;
        return $profile;
    }

    #Check User Has a Default Password => (raya-px724)
    public function getIsDefaultPasswordAttribute()
    {
        if (Hash::check(self::DEFAULT_PASSWORD, $this->password))
            $status = true;
        else
            $status = false;
        return $status;
    }

    # Check User Is Admin 
    public function isAdmin()
    {
        return ($this->type == 'admin') ? true : false;
    }

    # Check User Has Dependency (Project, Earning ,Cost and ...)
    public function hasDependency()
    {
        return $this->repo->hasDependency($this->id);
    }

    # Check User Has a Role
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        foreach ($role as $r) {
            if ($this->hasRole($r->name)) {
                return true;
            }
        }
        return false;
    }
}
