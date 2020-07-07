<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Request\ProjectRequest;
use App\Repositories\ProjectRepository;


class ProjectController extends AdminController
{

    private $repo;

    private $request;

    public function __construct()
    {
        $this->repo = resolve(ProjectRepository::class);
        $this->request = resolve(ProjectRequest::class);
        $this->categories = resolve(CategoryRepository::class);
    }

    public function index()
    {
        $projects = $this->repo->getProjects();
        return view('Admin.Project.index', compact('projects'));
    }


    public function create()
    {
        $mainCategories = $this->repo->getMainCategories();
        $anyCategory = $this->categories->hasCategories();
        $contractors = $this->repo->getContractors();
        return view('Admin.Project.create', compact('mainCategories', 'contractors', 'anyCategory'));
    }


    public function store(Request $request)
    {
        $this->request->validate($request);
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
        $this->repo->deleteFullProject($project);
        session()->flash('ProjectDelete');
        return back();
    }

    public function percentDivide(Request $request)
    {
        $this->request->percentValidate($request);
        $this->repo->dividePercnets($request);
        session()->flash('ActiveProject');
        return back();
    }

    public function complete(Request $request)
    {
        $this->request->completeValidate($request);

        $project = $this->repo->getProjectFull($request->finished);
        $allProgress = $this->repo->getProgress($project);
        $project = Project::findOrFail($request->finished);

        if ($allProgress == 100)
            $project->update(['status' => 'finished']);
            
        return redirect()->route('projects.index');
    }
}
