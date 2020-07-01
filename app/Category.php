<?php

namespace App;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public $repo;


    public function __construct()
    {
        $this->repo = resolve(CategoryRepository::class);
    }

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



    #return it has Sub Category
    public function hasSubCategory()
    {
        return (count($this->sub_cats) != 0) ? true : false;
    }

    # return Count Sub Category    
    public function getCountSub()
    {
        return count($this->sub_cats);
    }

    public function getProjectCount()
    {
        $this->repo->categoryId = $this->id;
        return $this->repo->getProjectsCount();
    }

    public function hasProjects()
    {
        return ($this->getProjectCount() != 0) ? true : false;
    }
}
