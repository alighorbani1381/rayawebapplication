<?php

namespace App\Http\Controllers\Admin;

use App\Cost;
use App\User;
use Illuminate\Http\Request;
use App\Request\CostRequest;
use App\Repositories\CostRepository;


class CostController extends AdminController
{

    # Define Acess Gate
    const INDEX = "Index-Cost";

    const CREATE = "Create-Cost";

    const SHOW = "Show-Cost";

    const EDIT = "Edit-Cost";

    const DELETE = "Delete-Cost";

    const MULTI_ACCESS = [self::INDEX, self::CREATE, self::SHOW, self::EDIT, self::DELETE];
    

    private $repo;

    private $requ;

    public function __construct()
    {
        # Encapsolation Repository & Request 
        $this->repo =  resolve(CostRepository::class);
        $this->requ =  resolve(CostRequest::class);

        # Set User into This Class
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }


    # Show List of Costs
    public function index()
    {
        $this->checkMultiAccess(self::MULTI_ACCESS);
        $costs = $this->repo->getCosts();
        return view('Admin.Cost.index', compact('costs'));
    }


    # Create Cost
    public function create()
    {
        $this->checkAccess(self::CREATE);
        $types = $this->repo->getCostTypes();
        $projects = $this->repo->getActiveProjects();
        $contractors = User::count();
        return view('Admin.Cost.create', compact('projects', 'types', 'contractors'));
    }

    # Store Cost
    public function store(Request $request)
    {
        $this->checkAccess(self::CREATE);
        $request->validate(['storeType' => 'required']);
        $this->repo->costStore($request->get('storeType'), $request, $this->user->id);
        return redirect()->route('costs.index');
    }

    # Show Cost Detail
    public function show(Cost $cost)
    {
        $this->checkAccess(self::SHOW);
        $cost = $this->repo->getCost($cost->id);
        return view('Admin.Cost.show', compact('cost'));
    }

    # Edit Cost
    public function edit(Cost $cost)
    {
        $this->checkAccess(self::EDIT);
        $types = $this->repo->getCostTypes();
        $cost = $this->repo->getCost($cost->id);
        return view('Admin.Cost.edit', compact('cost', 'types'));
    }

    # Update Cost
    public function update(Request $request, Cost $cost)
    {
        $this->checkAccess(self::EDIT);
        $this->requ->update($request);
        $cost->update($request->all());
        return $this->requ->redirectUpdate($cost);
    }

    # Remove Cost
    public function destroy(Cost $cost)
    {
        $this->checkAccess(self::DELETE);
        $cost->delete();
        session()->flash('DeleteCost');
        return back();
    }
}
