<?php

namespace App\Http\Controllers\Admin;

use App\Repository\ProjectRepository;
use App\User;

class IndexController extends AdminController
{

    public function __construct()
    {
        $this->project = resolve(ProjectRepository::class);
    }

    private function getAdminStatistic()
    {
        return User::where('type', 'admin')->limit(4)->get();
    }

    public function index()
    {
        $projectStatistic = $this->project->getStatisticProject();
        $adminsStatistic = $this->getAdminStatistic();
        return view('Admin.Index.dashbord', compact('projectStatistic', 'adminsStatistic'));
    }
}
