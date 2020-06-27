<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\Repository\ProjectRepository;


class ProjectController extends Controller
{
   
    private $repo;

    public function __construct()
    {
        $this->repo = resolve(ProjectRepository::class);
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $projects = $this->repo->getContractorProject($userId);
        return view('Contractor.Project.index', compact('projects'));
    }


    public function show($project)
    {
      $project = $this->repo->getProjectFull($project);
      return view('Contractor.Project.show', compact('project'));
    }

    public function showProgress($project)
    {
        // dd($project);
        return view('Contractor.Project.progress');
    }


}
