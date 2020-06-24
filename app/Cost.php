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

    public function getProjectTitleAttribute($key)
    {
        if ($this->project_id != null && $this->project_id != "") {
            $project = Project::where('id', $this->project_id)
                ->first();
            return $project->title;
        } else
            return '-';
    }

    public function getTypeTitleAttribute()
    {
        if ($this->type != null)
            $type = CostStatic::where('id', $this->type)->first()->title;
        else
            $type = "ندارد";
        return $type;
    }
}
