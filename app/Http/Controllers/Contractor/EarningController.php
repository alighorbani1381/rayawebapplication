<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\Project;
use App\Repositories\EarningRepository;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    private $repo;

    public function __construct()
    {
        # Encapsulation Repository
        $this->repo = resolve(EarningRepository::class);

        # Encapsulation User
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    public function index()
    {
        $earnings = $this->repo->getContractorEarnings($this->user->id);
        return view('Contractor.Earning.index', compact('earnings'));
    }

    public function show($earning)
    {
        $earning = $this->repo->getContractorEarning($earning);
        return view('Contractor.Earning.show', compact('earning'));
    }

    public function credit()
    {
        $credits = $this->repo->getContractorCredits($this->user->id);
        return view('Contractor.Earning.credit', compact('credits'));
    }

    public function project(Project $project)
    {
        $earnings = $this->repo->getContractorProjectEarnings($project->id, $this->user->id);
        return view('Contractor.Earning.project', compact('project', 'earnings'));
    }
}
