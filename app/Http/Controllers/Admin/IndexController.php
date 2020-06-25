<?php

namespace App\Http\Controllers\Admin;

use App\Repository\ProjectRepository;

class IndexController extends AdminController
{

    public function __construct()
    {
        $this->project = resolve(ProjectRepository::class);
    }


    public function index()
    {
        $projectStatistic = $this->project->getStatisticProject();
        return view('Admin.Index.dashbord', compact('projectStatistic'));
    }
}
