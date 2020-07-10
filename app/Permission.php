<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    # Fixed Fillable
    protected $fillable = [
        'name', 'title',
    ];
    
    # Set Relation to Roles Model
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
}
