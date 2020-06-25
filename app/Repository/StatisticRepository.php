<?php
namespace App\Repository;

use App\Project;

class StatisticRepository{

    public function getCountProjects()
    {
        return Project::count();
    }

}