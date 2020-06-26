<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\Project;
use App\Repository\ProjectRepository;
use Illuminate\Http\Request;

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
        return view('Contractor.Project.index');
    }

   
    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        //
    }

  
    public function update(Request $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }
}
