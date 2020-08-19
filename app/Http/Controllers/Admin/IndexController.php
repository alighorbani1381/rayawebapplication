<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ProjectRepository;
use App\Repositories\StatisticRepository;

class IndexController extends AdminController
{

    private $project;

    private $statistic;

    public function __construct(ProjectRepository $project, StatisticRepository $statistic)
    {
        # Encapsolation Repositories
        $this->project = $project;
        $this->statistic = $statistic;
    }

    # Show Index View With All Statistics
    public function index()
    {
        $projectStatistic = $this->project->getStatisticProject();
        $latestProject = $this->project->getLatestExecutedProject();
        $adminsStatistic = $this->statistic->getAdminStatistic();
        $globalStatistic = $this->statistic->getGlobalStatistic();
        return view('Admin.Index.dashbord', compact('projectStatistic', 'adminsStatistic', 'globalStatistic', 'latestProject'));
    }
}
