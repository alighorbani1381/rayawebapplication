<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostStatic extends Model
{
    # Fixed Fillable (Guarded)
    protected $guarded = [];
    
    # Mutator Sub Description 
    public function getSubDescAttribute()
    {
        return mb_substr($this->description, 0, 50) . " ...";
    }
        
    # Get MainGroup Name
    public function getMainGroupAttribute()
    {
        if ($this->child != 0){
            $mainCategory = CostStatic::where('id', $this->child)->first();
            $mainCategory = $mainCategory->title;
        }
        else
            $mainCategory = "ندارد";

            return $mainCategory;
    }

    # Get Sub CostStatics
    public function getSubCatsAttribute()
    {
        if ($this->child == 0)
            $subCategory = CostStatic::where('child', $this->id)->get();        
        else
            $subCategory = [];

            return $subCategory;
    }
}
