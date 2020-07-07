<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Earning;
use Illuminate\Http\Request;
use App\Request\EarningRequest;
use App\Repositories\EarningRepository;


class EarningController extends AdminController
{

    private $repo;

    public function __construct()
    {
        # Configuratio of Repository
        $this->repo =  resolve(EarningRepository::class);

        # Set User into This Class
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    public function index()
    {
        $earnings = $this->repo->getEarningsList();
        return view('Admin.Earning.index', compact('earnings'));
    }


    public function create($earning = null)
    {
        $projects = $this->repo->getProjectWant($earning);  

        if ($projects->count() != 0)
            return view('Admin.Earning.create', compact('projects'));

        session()->flash('EarningProblem');
        return redirect()->route('projects.create');
    }


    public function store(Request $request)
    {
        EarningRequest::storeValidate($request);
        $this->repo->createEarning($request, $this->user->id);
        return redirect()->route('earnings.index');
    }


    public function show($earning)
    {
        $earning = $this->repo->getEarning($earning);
        return view('Admin.Earning.show', compact('earning'));
    }


    public function edit(Earning $earning)
    {
        $projects  = $this->repo->getActiveProject();
        return view('Admin.Earning.edit', compact('projects', 'earning'));
    }


    public function update(Request $request, Earning $earning)
    {
        $earning->update($request->all());
        session()->flash('UpdateEarning');
        return redirect()->route('earnings.show', $earning->id);
    }


    public function destroy(Earning $earning)
    {
        $earning->delete();
        session()->flash('DeleteEarning');
        return redirect()->route('earnings.index');
    }
}
