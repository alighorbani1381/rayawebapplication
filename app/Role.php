<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    # Fixed Fillalbe
    protected $fillable = [
        'name', 'title',
    ];

    # Set Relation to User Model
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    # Set Relation to Permission Model
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
