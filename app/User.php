<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Symfony\Component\CssSelector\Node\FunctionNode;

class User extends Authenticatable
{
    public $table = 'users';
    protected $guarded = [];
    
    public function getFullNameAttribute()
    {
        $fullName = $this->name . " " . $this->lastname;
        return $fullName;
    }

}
