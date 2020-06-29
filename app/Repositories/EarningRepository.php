<?php

namespace App\Repositories;

use App\Cost;
use App\Earning;
use App\Project;

class EarningRepository
{

    public function createEarning($request, $userId)
    {
        foreach ($request->title as $index => $title) {
            $fileds = [
                'generator' => $userId,
                'project_id' => $request->project,
                'title' => $title,
                'description' => $request->description[$index],
                'received_money' => $request->received_money[$index],
                'status' => $request->status[$index],
            ];
            return Earning::create($fileds);
        }
    }

    public function getEarning($earning)
    {
        Earning::findOrFail($earning);
        return Earning::join('projects', 'earnings.project_id', '=', 'projects.id')
            ->select('projects.id AS project_id', 'projects.title AS project_title', 'projects.unique_id', 'projects.created_at AS project_start', 'projects.price', 'earnings.*')
            ->where('earnings.id', $earning)
            ->first();
    }

    public function getEarningsList()
    {
        return Earning::join('projects', 'earnings.project_id', '=', 'projects.id')
            ->select('projects.title AS project_title', 'projects.unique_id', 'projects.price', 'earnings.*')
            ->orderBy('earnings.id', 'desc')
            ->paginate(15);
    }

    public function getProjectWant($earning)
    {
        if ($earning != null)
            $projects = Project::where('id', $earning)->get();
        else
            $projects  = Project::where('status', '!=', 'finished')->get();

            return $projects;
    }


    /*************** Earning Method For Contractor ************ */

    public function getContractorEarning($userId)
    {
        return Cost::join('users', 'costs.generator', '=', 'users.id')
        ->join('projects', 'costs.project_id', '=', 'projects.id')
        ->select('costs.*', 'projects.title AS project_title', 'users.name', 'users.lastname')
        ->where('costs.contractor_id', $userId)
        ->where('costs.status', 'paid')
        ->where('costs.project_id', '!=', null)
        ->paginate(15);
    }



}
