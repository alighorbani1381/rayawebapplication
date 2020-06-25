<?php
namespace App\Repository;

use App\Category;
use App\Project;
use App\User;

class StatisticRepository{

    public function getCountProjects()
    {
        return Project::count();
    }
    
    public function getCountActiveProjects()
    {
        return Project::where('status', '!=', 'finished')->count();
    }

    public function getCountUsers()
    {
        return User::count() - 1;
    }

    public function getCountCategories()
    {
        return Category::where('child', '!=', '0')->count();
    }

}