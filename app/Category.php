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
        if ($this->child != 0) {
            $mainCategory = Category::where('id', $this->child)->first();
            $mainCategory = $mainCategory->title;
        } else
            $mainCategory = "ندارد";

        return $mainCategory;
    }

    public function getSubCatsAttribute()
    {
        $subCategory = ($this->child == 0) ? Category::where('child', $this->id)->get() : [];
        return $subCategory;
    }

    public function hasSubCategory()
    {
        return ($this->sub_cats->count() != 0) ? true : false;
    }

    public function getCountSub()
    {
        return $this->sub_cats->count();
    }
}
