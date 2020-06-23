<?php

namespace App\Repository;

use App\Earning;

class EarningRepository
{

    public function createEarning($request)
    {
        foreach ($request->title as $index => $title) {
            $fileds = [
                'generator' => '1',
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
}
