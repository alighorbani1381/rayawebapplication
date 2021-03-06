<?php

namespace App\Repositories;

use App\CostStatic;
use App\Cost;
use App\Project;

class CostRepository
{
    public function isContractPay($request)
    {
        return ($request->contractor_pay == "true") || ($request->contractor_pay == "without-project");
    }

    public function projectStore($request, $userId)
    {
        session()->flash('ProjectStore');
        $request->validate(['contractor_pay' => 'required']);
        return $pay =  ($this->isContractPay($request)) ? $this->projectContractorPay($request, $userId) : $this->projectStorePay($request, $userId);
    }

    public function projectStorePay($request, $userId)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'money_paid' => 'required|numeric',
            'project_id' => 'required',
            'status' => 'required',
        ]);
        $type =  ($request->type == "0") ? null : $request->type;


        Cost::create([
            'generator' => $userId,
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'money_paid' => $request->money_paid,
            'type' => $type,
            'status' => $request->status,
        ]);
    }

    public function externalStore($request, $userId)
    {
        session()->flash('ExtenalStore');
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'money_paid' => 'required|numeric',
            'status' => 'required',
        ]);
        $type =  ($request->type == 0) ? null : $request->type;
        Cost::create([
            'generator' => $userId,
            'title' => $request->title,
            'description' => $request->description,
            'money_paid' => $request->money_paid,
            'type' => $type,
            'status' => $request->status,

        ]);
    }

    public function projectContractorPay($request, $userId)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'money_paid' => 'required|numeric',
            'status' => 'required',
        ]);
        $type =  ($request->type == 0) ? null : $request->type;

        return Cost::create([
            'generator' => $userId,
            'project_id' => $request->project_id,
            'contractor_id' => $request->contractor_id,
            'title' => $request->title,
            'description' => $request->description,
            'money_paid' => $request->money_paid,
            'type' => $type,
            'status' => $request->status,
        ]);
    }

    public function getProjectBaseCosts()
    {
        return Cost::select('projects.title AS project_title', 'costs.*', 'cost_statics.title AS cost_type')
            ->leftJoin('projects', 'costs.project_id', '=', 'projects.id')
            ->leftJoin('cost_statics', 'cost_statics.id', '=', 'costs.type')
            ->whereNotNull('project_id')
            ->where('contractor_id', null)
            ->paginate(15);
    }

    public function getContractorCosts()
    {
        return Cost::join('users', 'costs.contractor_id', '=', 'users.id')
            ->select('costs.*', 'users.name as user_name', 'users.lastname as user_lastname')
            ->where('contractor_id', '!=', null)
            ->orderBy('costs.id', 'desc')
            ->orderBy('costs.project_id')
            ->orderBy('costs.created_at')
            ->paginate(15);
    }

    public function getExtraCosts()
    {
        return Cost::where('project_id', null)
            ->where('contractor_id', null)
            ->paginate(15);
    }

    public function getCosts()
    {
        $costs['extra'] = $this->getExtraCosts();
        $costs['contractor'] = $this->getContractorCosts();
        $costs['project_base'] = $this->getProjectBaseCosts();
        return $costs;
    }

    public function specifyCostType($costId)
    {

        $cost = Cost::findOrFail($costId);
        $projectId = $cost->project_id;
        $contractorId = $cost->contractor_id;

        if ($projectId == null && $contractorId == null)
            return 'extra';

        if ($projectId == null &&  $contractorId != null)
            return 'contract_without_project';

        if ($projectId != null && $contractorId != null)
            return 'contract_pay';

        if ($projectId != null && $contractorId == null)
            return 'project_base';
    }

    public function getCost($costId)
    {
        $cost['content'] = Cost::findOrFail($costId);
        $cost['type'] = $this->specifyCostType($costId);
        return $cost;
    }

    public function getCostTypes()
    {
        return CostStatic::where('child', '0')->get();
    }

    public function costStore($type, $request, $userId)
    {
        if ($type == 'project')
            $this->projectStore($request, $userId);
        else
            $this->externalStore($request, $userId);
    }

    public function getActiveProjects()
    {
        return Project::where('status', 'ongoing')->orderBy('id', 'desc')->get();
    }
}
