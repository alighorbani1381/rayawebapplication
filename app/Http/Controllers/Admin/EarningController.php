<?php

namespace App\Http\Controllers\Admin;

use App\Earning;
use App\Http\Controllers\Controller;
use App\Repository\EarningRepository;
use App\Project;
use Illuminate\Http\Request;

class EarningRequest
{

    public static function storeValidate($request)
    {
        $request->validate([
            'title.*' => 'required',
            'received_money.*' => 'required|numeric|min:1',
            'status.*' => 'required',
        ]);
    }
}

class EarningController extends Controller
{

    private $repo;

    public function __construct()
    {
        $this->repo =  resolve(EarningRepository::class);
    }

    public function index()
    {
        $earnings = $this->repo->getEarningsList();
        return view('Admin.Earning.index', compact('earnings'));
    }


    public function create($earning = null)
    {
        $projects = $this->repo->getProjectWant();

        if ($projects->count() != 0)
            return view('Admin.Earning.create', compact('projects'));

        session()->flash('EarningProblem');
        return redirect()->route('projects.create');
    }


    public function store(Request $request)
    {
        EarningRequest::storeValidate($request);
        $this->repo->createEarning($request);
        return redirect()->route('earnings.index');
    }


    public function show($earning)
    {
        $earning = $this->repo->getEarning($earning);
        return view('Admin.Earning.show', compact('earning'));
    }


    public function edit(Earning $earning)
    {
        $projects  = Project::where('status', '!=', 'finished')->get();
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
