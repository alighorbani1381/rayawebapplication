<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{

    # Fixed Fillable (Guarded)
    protected $guarded = [];

    # Show Sub Description
    public function getSubDescAttribute()
    {
        return mb_substr($this->description, 0, 50) . " ...";
    }

    # Check This Cost Belongs To Project
    public function hasProject()
    {
        return ($this->project_id != null && $this->project_id != "");
    }

    # Get Project Title For This Cost 
    public function getProjectTitleAttribute()
    {
        if ($this->hasProject())
            $project = Project::where('id', $this->project_id)->first()->title;
        else
            $project = '-';
            
        return $project;
    }

    # Get Type of Cost
    public function getTypeTitleAttribute()
    {
        if ($this->type != null)
            $type = CostStatic::where('id', $this->type)->first()->title;
        else
            $type = "ندارد";
        return $type;
    }
}
