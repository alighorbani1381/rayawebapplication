<?php
namespace App\Repository;

use App\CostStatic;
use App\Cost;

class CostRepository
{
    public function isContractPay($request)
    {
        return ($request->contractor_pay == "true") || ($request->contractor_pay == "without-project");
    }

    public function projectStore($request)
    {
        session()->flash('ProjectStore');
        $request->validate(['contractor_pay' => 'required']);
        return $pay =  ($this->isContractPay($request)) ? $this->projectContractorPay($request) : $this->projectStorePay($request);
    }

    public function projectStorePay($request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'money_paid' => 'required|numeric',
            'project_id' => 'required',
            'status' => 'required',
        ]);
        $type =  ($request->type == 0) ? null : $request->type;

        Cost::create([
            'generator' => '1',
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'money_paid' => $request->money_paid,
            'type' => $type,
            'status' => $request->status,

        ]);
    }

    public function externalStore($request)
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
            'generator' => '1',
            'title' => $request->title,
            'description' => $request->description,
            'money_paid' => $request->money_paid,
            'type' => $type,
            'status' => $request->status,

        ]);
    }

    public function projectContractorPay($request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'money_paid' => 'required|numeric',
            'status' => 'required',
        ]);
        $type =  ($request->type == 0) ? null : $request->type;
        Cost::create([
            'generator' => '1',
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
        return Cost::join('projects', 'costs.project_id', '=', 'projects.id')
            ->join('cost_statics', 'cost_statics.id', '=', 'costs.type')
            ->select('projects.title AS project_title', 'costs.*', 'cost_statics.title AS cost_type')
            ->where('project_id', '!=', null)
            ->where('contractor_id', null)
            ->get();
    }

    public function getContractorCosts()
    {
        return Cost::join('users', 'costs.contractor_id', '=', 'users.id')
            ->select('costs.*', 'users.name as user_name', 'users.lastname as user_lastname')
            ->where('contractor_id', '!=', null)
            ->orderBy('costs.project_id')
            ->orderBy('costs.created_at')
            ->get();
    }

    public function getExtraCosts()
    {
        return Cost::where('project_id', null)
            ->where('contractor_id', null)
            ->get();
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
}