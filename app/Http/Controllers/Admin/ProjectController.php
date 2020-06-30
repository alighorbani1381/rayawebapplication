<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectRequest
{

    public static function projectValidate($request)
    {
        $fileds = [
            'name' => 'required',
            'lastname' => 'required',
            'father_name' => 'required',
            'meli_code' => 'required',
            'meli_image' => 'default',
            'phone' => 'required',
            'address' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'contract_image' => 'default',
            'contract_started' => 'required',
            'completed_at' => 'required',
            'date_start' => 'required',
            'complete_after' => 'required',
        ];

        $request->validate($fileds);
    }

    public static function percentValidate($request)
    {
        $fileds = ['progress.*' => 'required|numeric|min:1|max:100'];
        $request->validate($fileds);
    }
}


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
        $categories = $this->repo->getMainCategories();
        $contractors = $this->repo->getContractors();
        return view('Admin.Project.create', compact('categories', 'contractors'));
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
