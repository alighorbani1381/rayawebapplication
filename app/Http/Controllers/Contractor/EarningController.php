<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\Project;
use App\Repositories\EarningRepository;

class EarningController extends Controller
{
    private $repo;

    public function __construct(EarningRepository $repository)
    {
        # Encapsulation Repository
        $this->repo = $repository;

        # Encapsulation User
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    # Show List of Earnings
    public function index()
    {
        $earnings = $this->repo->getContractorEarnings($this->user->id);
        return view('Contractor.Earning.index', compact('earnings'));
    }

    # Show Detail Earnings
    public function show($earning)
    {
        $earning = $this->repo->getContractorEarning($earning, $this->user->id);
        return view('Contractor.Earning.show', compact('earning'));
    }

    # Show Credit Earnings
    public function credit()
    {
        $credits = $this->repo->getContractorCredits($this->user->id);
        return view('Contractor.Earning.credit', compact('credits'));
    }

    # Show Project Earnings
    public function project(Project $project)
    {
        $earnings = $this->repo->getContractorProjectEarnings($project->id, $this->user->id);
        return view('Contractor.Earning.project', compact('project', 'earnings'));
    }
}
