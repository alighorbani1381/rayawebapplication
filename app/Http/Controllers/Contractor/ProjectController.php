<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;


class ProjectController extends Controller
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

    }

    public function show($project)
    {
        $this->repo->contractorGate($project, $this->user->id);
        $project = $this->repo->getProjectFull($project);
        return view('Contractor.Project.show', compact('project'));
    }
    
    public function showProgress($project)
    {
        $progressInfo = $this->repo->getProgressInfo($project, $this->user->id);
        return view('Contractor.Project.progress', compact('progressInfo'));
    }

    public function storeProgress(Request $request)
    {
        $this->repo->updateProgress($request->id, $request->progress);
        session()->flash('ProgressChange');
        return redirect()->route('contractor.projects.index');
    }

}
