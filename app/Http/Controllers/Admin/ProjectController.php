<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Request\ProjectRequest;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\ProjectRepository;


class ProjectController extends AdminController
{

    private $repo;

    private $request;

    public function __construct()
    {
        # Configuration of Repositories
        $this->repo = resolve(ProjectRepository::class);
        $this->request = resolve(ProjectRequest::class);
        $this->categories = resolve(CategoryRepository::class);
    }

    # Show Latest 15th Project
    public function index()
    {
        $projects = $this->repo->getProjects();
        return view('Admin.Project.index', compact('projects'));
    }

    # Create Project Page
    public function create()
    {
        $mainCategories = $this->repo->getMainCategories();
        $anyCategory = $this->categories->hasCategories();
        $contractors = $this->repo->getContractors();
        return view('Admin.Project.create', compact('mainCategories', 'contractors', 'anyCategory'));
    }

    # Store Project
    public function store(Request $request)
    {
        $this->request->validate($request);
        $this->repo->projectCreateFull($request);
        return redirect()->route('projects.index');
    }

    # Show Detail & Progress Project
    public function show($project)
    {
        $project = $this->repo->getProjectFull($project);
        $allProgress = $this->repo->getProgress($project);
        return view('Admin.Project.show', compact('project', 'allProgress'));
    }

    # Edit Project
    public function edit($project)
    {
        $project = $this->repo->getProjectFull($project);
        return view('Admin.Project.edit', compact('project'));
    }

    # Update Project Info
    public function update(Request $request, $project)
    {
        $this->repo->updateProjectFull($project, $request);
        session()->flash('ProjectUpdate');
        return redirect()->route('projects.index');
    }

    # Remove Project With Dependencies
    public function destroy($project)
    {
        $this->repo->deleteFullProject($project);
        session()->flash('ProjectDelete');
        return back();
    }

    # Percent Divide Between Contractors
    public function percentDivide(Request $request)
    {
        $this->request->percentValidate($request);
        $this->repo->dividePercnets($request);
        session()->flash('ActiveProject');
        return back();
    }

    # Change Project Status to Completed => LOG
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
