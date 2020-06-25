<?php
namespace App\Repository;

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

}