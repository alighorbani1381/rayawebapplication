<?php
namespace App\Repository;

use App\Category;
use App\Project;
use App\User;

class StatisticRepository{

    public function getAdminStatistic()
    {
        return User::where('type', 'admin')->limit(4)->get();
    }

    private function getCountProjects()
    {
        return Project::count();
    }
    
    private function getCountActiveProjects()
    {
        return Project::where('status', '!=', 'finished')->count();
    }

    private function getCountUsers()
    {
        return User::count() - 1;
    }

    private function getCountCategories()
    {
        return Category::where('child', '!=', '0')->count();
    }

    public function getGlobalStatistic()
    {
     $statistic['projects'] = $this->getCountProjects();
     $statistic['active_projects'] = $this->getCountActiveProjects();
     $statistic['users'] = $this->getCountUsers();
     $statistic['categories'] = $this->getCountCategories();
    }

}