<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $guarded = [];

    public function getSubDescAttribute()
    {
        return mb_substr($this->description, 0, 50) . " ...";
    }
}
