<?php

namespace App\Http\Controllers\Admin;

use App\Cost;
use App\Repositories\CostRepository;
use App\Request\CostRequest;
use App\User;
use Illuminate\Http\Request;


class CostController extends AdminController
{

    private $repo;

    private $requ;

    public function __construct()
    {
        $this->repo =  resolve(CostRepository::class);
        $this->requ =  resolve(CostRequest::class);
    }


    public function index()
    {
        $costs = $this->repo->getCosts();
        return view('Admin.Cost.index', compact('costs'));
    }


    public function create()
    {
        $types = $this->repo->getCostTypes();
        $projects = $this->repo->getActiveProjects();
        $contractors = User::count();
        return view('Admin.Cost.create', compact('projects', 'types', 'contractors'));
    }

    public function store(Request $request)
    {
        $request->validate(['storeType' => 'required']);
        $userId = auth()->user()->id;
        $this->repo->costStore($request->get('storeType'), $request, $userId);
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
        $this->requ->update($request);
        $cost->update($request->all());
        return $this->requ->redirectUpdate($cost);
    }

    public function destroy(Cost $cost)
    {
        $cost->delete();
        session()->flash('DeleteCost');
        return back();
    }
}
