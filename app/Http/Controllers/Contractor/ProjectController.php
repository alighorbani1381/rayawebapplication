<?php

namespace App\Http\Controllers\Contractor;

use App\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;


class ProjectController extends MainController
{

    private $repo;

    private $user;

    public function __construct()
    {
        $this->repo = resolve(ProjectRepository::class);

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    public function index()
    {
        $projects = $this->repo->getContractorProject($this->user->id);
        return view('Contractor.Project.index', compact('projects'));
    }

    public function ongoing()
    {
        $projects = $this->repo->getContractorOngoingProject($this->user->id);
        return view('Contractor.Project.ongoing', compact('projects'));
    }

    public function finished()
    {
        $projects = $this->repo->getContractorFinishedProject($this->user->id);
        return view('Contractor.Project.finished', compact('projects'));
    }

    public function show($project)
    {
        $this->repo->contractorGate($project, $this->user->id);
        $project = $this->repo->getProjectFull($project);
        return view('Contractor.Project.show', compact('project'));
    }

    public function showProgress(Project $project)
    {
        $isValid = $this->repo->isAccessChangeProgress($project);
        if($isValid){
            session()->flash('dont-start');
            return redirect()->route('contractor.projects.show', $project->id);
        }
        $progressInfo = $this->repo->getProgressInfo($project->id, $this->user->id);
        return view('Contractor.Project.progress', compact('progressInfo'));
    }

    public function storeProgress(Request $request)
    {
        $this->repo->updateProgress($request->id, $request->progress);
        session()->flash('ProgressChange');
        return redirect()->route('contractor.projects.ongoing');
    }
}
