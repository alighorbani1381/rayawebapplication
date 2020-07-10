<?php

namespace App;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public $repo;


    # Encapsolation Repository
    public function __construct()
    {
        $this->repo = resolve(CategoryRepository::class);
    }

    # Show Sub Description 
    public function getSubDescAttribute()
    {
        return mb_substr($this->description, 0, 50) . " ...";
    }


    # Get Main Category Name
    public function getMainGroupAttribute()
    {
        if ($this->child == 0)
            return "ندارد";

        $mainCategory = Category::where('id', $this->child)->first()->title;
        return $mainCategory;
    }

    # Get Sub Categories
    public function getSubCatsAttribute()
    {
        $subCategory = ($this->child == 0) ? Category::where('child', $this->id)->get() : collect([]);
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

    # return Count of categories Project
    public function getProjectCount()
    {
        $this->repo->categoryId = $this->id;
        return $this->repo->getProjectsCount();
    }

    # Check This Category has a Project
    public function hasProjects()
    {
        return ($this->getProjectCount() != 0) ? true : false;
    }
}
