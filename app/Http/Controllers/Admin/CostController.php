<?php

namespace App\Http\Controllers\Admin;

use App\Cost;
use App\CostStatic;
use App\Project;
use Illuminate\Http\Request;


class CostController extends AdminController
{

    private $repo;

    public function __construct()
    {
        $this->repo =  resolve(CostRepository::class);
    }

    public function index()
    {

        $costs = $this->repo->getCosts();
        //   dd($costs);
        return view('Admin.Cost.index', compact('costs'));
    }

    public function create()
    {
        $types = $this->repo->getCostTypes();
        $projects = Project::where('status', '!=', 'finished')->get();
        return view('Admin.Cost.create', compact('projects', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate(['storeType' => 'required'], ['storeType.required' => 'Error in the Form You Must Refresh This Page!']);
        $type = $request->get('storeType');
        $userId = auth()->user()->id;
        if ($type == 'project')
            $this->repo->projectStore($request, $userId);
        else
            $this->repo->externalStore($request, $userId);


        return redirect()->route('costs.index');
    }

    public function show(Cost $cost)
    {
        $cost = $this->repo->getCost($cost->id);
        return view('Admin.Cost.show', compact('cost'));
    }

    public function edit(Cost $cost)
    {
        $types = $this->repo->getCostTypes();
        $cost = $this->repo->getCost($cost->id);
        return view('Admin.Cost.edit', compact('cost', 'types'));
    }

    public function update(Request $request, Cost $cost)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'money_paid' => 'required',
        ]);
        $cost->update($request->all());
        session()->flash('UpdateCost');
        if (session()->has('SendWithProject') || session()->has('SendWithShow'))
            return back();
        else
            return redirect()->route('costs.show', $cost->id);
    }

    public function destroy(Cost $cost)
    {
        //$cost->delete();
        session()->flash('DeleteCost');
        return back();
    }
}
