<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ProjectRepository;
use App\Repositories\StatisticRepository;

class IndexController extends AdminController
{

    private $project;

    private $statistic;

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
