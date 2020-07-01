<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Repositories\ProjectRepository;
use App\Request\ProjectRequest;
use Illuminate\Http\Request;




class ProjectController extends AdminController
{

    private $repo;

    public function __construct()
    {
        $this->repo = resolve(ProjectRepository::class);
    }

    public function index()
    {
        $projects = $this->repo->getProjects();
        return view('Admin.Project.index', compact('projects'));
    }


    public function create()
    {
        $mainCategories = $this->repo->getMainCategories();
        $contractors = $this->repo->getContractors();
        return view('Admin.Project.create', compact('mainCategories', 'contractors'));
    }


    public function store(Request $request)
    {
        ProjectRequest::projectValidate($request);
        $this->repo->projectCreateFull($request);
        return redirect()->route('projects.index');
    }


    public function show($project)
    {
        $project = $this->repo->getProjectFull($project);
        $allProgress = $this->repo->getProgress($project);
        return view('Admin.Project.show', compact('project', 'allProgress'));
    }


    public function edit($project)
    {
        $project = $this->repo->getProjectFull($project);
        return view('Admin.Project.edit', compact('project'));
    }


    public function update(Request $request, $project)
    {
        $this->repo->updateProjectFull($project, $request);
        session()->flash('ProjectUpdate');
        return redirect()->route('projects.index');
    }


    public function destroy($project)
    {
        Project::findOrFail($project);
        $this->repo->deleteFullProject($project);
        session()->flash('ProjectDelete');
        return back();
    }

    public function percentDivide(Request $request)
    {
        ProjectRequest::percentValidate($request);
        $this->repo->dividePercnets($request);
        session()->flash('ActiveProject');
        return back();
    }
}
