<?php

namespace App\Http\Controllers\Admin;

use App\Repository\ProjectRepository;
use App\Repository\StatisticRepository;

use App\User;

class IndexController extends AdminController
{

    public function __construct()
    {
        $this->project = resolve(ProjectRepository::class);
        $this->statistic = resolve(StatisticRepository::class);
    }

    

    public function index()
    {
        $projectStatistic = $this->project->getStatisticProject();
        $adminsStatistic = $this->statistic->getAdminStatistic();
        $globalStatistic = $this->statistic->getGlobalStatistic();
        return view('Admin.Index.dashbord', compact('projectStatistic', 'adminsStatistic', 'globalStatistic'));
    }
}
