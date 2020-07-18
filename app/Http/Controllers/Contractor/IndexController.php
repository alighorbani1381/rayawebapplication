<?php

namespace App\Http\Controllers\Contractor;

use App\Cost;
use App\Project;
use Exception;
use Illuminate\Support\Facades\DB;

class IndexController extends MainController
{

    private $user;

    public function __construct()
    {
        # Encapsulation User
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    private function getEarning($type)
    {

        switch ($type) {
            case 'earning':
                $status = 'paid';
                break;

            case 'credit':
                $status = 'unpaid';
                break;

            default:
                throw new Exception(" <<{$type}>> is Invalid input Parameter !😑 You must enter {earning, credit}");
                break;
        }

        $earning = Cost::where('contractor_id', $this->user->id)->where('status', $status);
        return ['sum' => $earning->sum('money_paid'), 'items' => $earning->get()];
    }

    private function getAllProjects($userId)
    {
        $firstTable = "project_contractor";
        return DB::table($firstTable)
            ->join('projects', $firstTable . ".project_id", '=', 'projects.id')
            ->where($firstTable . '.contractor_id', $userId)
            ->get();
    }

    private function combineProject($userId)
    {

        $combined['ongoing'] = collect([]);
        $combined['finished'] = collect([]);
        $combined['waiting'] = collect([]);

        $projects = $this->getAllProjects($userId);

        foreach ($projects as $project) {
            if ($project->status == 'ongoing')
                $combined['ongoing'][] = $project;

            if ($project->status == 'finished')
                $combined['finished'][] = $project;

            if ($project->status == 'waiting')
                $combined['waiting'][] = $project;
        }

        return collect($combined);
    }

    public function index()
    {
        $projects = $this->combineProject($this->user->id);
        $earnings = $this->getEarning('earning');
        $credits = $this->getEarning('credit');
        return view('Contractor.Index.dashbord', compact('projects', 'earnings', 'credits'));
    }
}
