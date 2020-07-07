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
        # Encapsolation Repository
        $this->repo = resolve(ProjectRepository::class);

        # Set Users
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    # Show All Contractor Project 
    public function index()
    {
        $projects = $this->repo->getContractorProject($this->user->id);
        return view('Contractor.Project.index', compact('projects'));
    }

    # Show All Ongoing Contractor Project 
    public function ongoing()
    {
        $projects = $this->repo->getContractorOngoingProject($this->user->id);
        return view('Contractor.Project.ongoing', compact('projects'));
    }

    # Show All Finished Contractor Project 
    public function finished()
    {
        $projects = $this->repo->getContractorFinishedProject($this->user->id);
        return view('Contractor.Project.finished', compact('projects'));
    }

    # Show Project Detail 
    public function show($project)
    {
        $this->repo->contractorGate($project, $this->user->id);
        $project = $this->repo->getProjectFull($project);
        $allProgress = $this->repo->getProgress($project);
        $progressInfo = $this->repo->getProgressInfo($project['project']->id, $this->user->id);        
        return view('Contractor.Project.show', compact('project', 'allProgress', 'progressInfo'));
    }

    # Show Project Progress
    public function showProgress(Project $project)
    {
        $isValid = $this->repo->isAccessChangeProgress($project);

        if($isValid['isFuture']){
            session()->flash('dont-start', $isValid['diff']);
            return redirect()->route('contractor.projects.show', $project->id);
        }

        $progressInfo = $this->repo->getProgressInfo($project->id, $this->user->id);
        return view('Contractor.Project.progress', compact('progressInfo'));
    }

    # Update Project Progress
    public function storeProgress(Request $request)
    {
        $request->validate(['id' => 'required', 'project' => 'required']);
        $this->repo->updateProgress($request->id, $request->project, $request->progress, $this->user->id);
        session()->flash('ProgressChange');
        return redirect()->route('contractor.projects.ongoing');
    }
}
