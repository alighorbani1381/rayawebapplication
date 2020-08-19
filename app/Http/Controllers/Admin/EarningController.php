<?php

namespace App\Http\Controllers\Admin;

use App\Earning;
use App\Http\Requests\StoreEarning;
use Illuminate\Http\Request;
use App\Repositories\EarningRepository;


class EarningController extends AdminController
{
    # Define Acess Gate
    const INDEX = "Index-Earning";

    const CREATE = "Create-Earning";

    const SHOW = "Show-Earning";

    const EDIT = "Edit-Earning";

    const DELETE = "Delete-Earning";

    const MULTI_ACCESS = [self::INDEX, self::CREATE, self::SHOW, self::EDIT, self::DELETE];


    private $repo;

    public function __construct(EarningRepository $repository)
    {
        # Configuration of Repository
        $this->repo =  $repository;

        # Set User into This Class
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    # Show List of Earnings
    public function index()
    {
        $this->checkMultiAccess(self::MULTI_ACCESS);
        $earnings = $this->repo->getEarningsList();
        return view('Admin.Earning.index', compact('earnings'));
    }

    # Create Earning 
    public function create($earning = null)
    {
        $this->checkAccess(self::CREATE);

        $projects = $this->repo->getProjectWant($earning);

        if ($projects->count() != 0)
            return view('Admin.Earning.create', compact('projects'));

        session()->flash('EarningProblem');
        return redirect()->route('projects.create');
    }

    # Store Earning
    public function store(StoreEarning $request)
    {
        $this->checkAccess(self::CREATE);
        $this->repo->createEarning($request, $this->user->id);
        return redirect()->route('earnings.index');
    }

    # Show Earning Detail
    public function show($earning)
    {
        $this->checkAccess(self::SHOW);
        $earning = $this->repo->getEarning($earning);
        return view('Admin.Earning.show', compact('earning'));
    }

    # Edit Earnings
    public function edit(Earning $earning)
    {
        $this->checkAccess(self::EDIT);
        $projects  = $this->repo->getActiveProject();
        return view('Admin.Earning.edit', compact('projects', 'earning'));
    }

    # Update Earning
    public function update(Request $request, Earning $earning)
    {
        $this->checkAccess(self::EDIT);
        $earning->update($request->all());
        session()->flash('UpdateEarning');
        return redirect()->route('earnings.show', $earning->id);
    }

    # Remove Earning
    public function destroy(Earning $earning)
    {
        $this->checkAccess(self::DELETE);
        $earning->delete();
        session()->flash('DeleteEarning');
        return redirect()->route('earnings.index');
    }
}
