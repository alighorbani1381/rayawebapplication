<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    # Fixed Fillalbe (Guarded)
    protected $guarded = [];

    # Set Relation to User Model
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
