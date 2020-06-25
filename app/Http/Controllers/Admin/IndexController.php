<?php

namespace App\Http\Controllers\Admin;

use App\Repository\ProjectRepository;
use App\Repository\StatisticRepository;

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
        $latestProject = $this->project->getLatestExecutedProject();
        $adminsStatistic = $this->statistic->getAdminStatistic();
        $globalStatistic = $this->statistic->getGlobalStatistic();
        return view('Admin.Index.dashbord', compact('projectStatistic', 'adminsStatistic', 'globalStatistic', 'latestProject'));
    }
}
