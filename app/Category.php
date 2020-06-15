<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    
    public function getSubDescAttribute()
    {
        return mb_substr($this->description, 0, 50) . " ...";
    }
        
    public function getMainGroupAttribute()
    {
        if ($this->child != 0){
            $subCategory = Category::where('id', $this->child)->first();
            $subCategory = $subCategory->title;
        }
        else
            $subCategory = "ندارد";

            return $subCategory;
    }
}
