<?php

namespace App\Http\Controllers\Admin;

use App\Cost;
use App\CostStatic;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;


class CostRepository
{
    public function isContractPay($request)
    {
        return ($request->contractor_pay == "true") || ($request->contractor_pay == "without-project");
    }

    public function projectStore($request)
    {
        session()->flash('ProjectStore');
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
            ->select('projects.title AS project_title', 'costs.*')
            ->where('project_id', '!=', null)
            ->where('contractor_id', null)
            ->get();
    }

    /* public function getContractorCosts()
    {
        return Cost::join('projects', 'costs.project_id', '=', 'projects.id')
        ->select('projects.title AS project_title', 'costs.*')
        ->where('contractor_id', '!=', null)
        ->where('project_id', '!=', null)
        ->get();
    } */

    public function getExtraCosts()
    {
        return Cost::where('project_id', null)
            ->where('contractor_id', null)
            ->get();
    }

    public function getCosts()
    {
        $costs['extra'] = $this->getExtraCosts();
        $costs['project_base'] = $this->getProjectBaseCosts();
        return $costs;
    }
}
class CostController extends Controller
{

    public function __construct()
    {
        $this->repo = new CostRepository();
    }

    public function index()
    {

        $costs = $this->repo->getCosts();
        // dd($costs);
        return view('Admin.Cost.index', compact('costs'));
    }

    public function create()
    {
        $types = CostStatic::where('child', '0')->get();
        $projects = Project::where('status', '!=', 'finished')->get();
        return view('Admin.Cost.create', compact('projects', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate(['storeType' => 'required', 'contractor_pay' => 'required'], ['storeType.required' => 'Error in the Form You Must Refresh This Page!']);
        $type = $request->get('storeType');

        if ($type == 'project')
            $this->repo->projectStore($request);
        else
            $this->repo->externalStore($request);


        return redirect()->route('costs.index');
    }

    public function show(Cost $cost)
    {
        //
    }

    public function edit(Cost $cost)
    {
        //
    }

    public function update(Request $request, Cost $cost)
    {
        //
    }

    public function destroy(Cost $cost)
    {
        $cost->delete();
        session()->flash('DeleteCost');
        return back();
    }
}
