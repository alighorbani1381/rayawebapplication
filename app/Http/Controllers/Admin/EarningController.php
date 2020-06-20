<?php

namespace App\Http\Controllers\Admin;

use App\Earning;
use App\Http\Controllers\Controller;
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
            Earning::create($fileds);
        }
    }
}

class EarningController extends Controller
{

    public function __construct()
    {
        $this->repo = new EarningRepository();
    }

    public function index()
    {
        $earnings = Earning::join('projects', 'earnings.project_id', '=', 'projects.id')
            ->select('projects.title AS project_title', 'projects.unique_id', 'projects.price', 'earnings.*')
            ->orderBy('earnings.id', 'desc')
            ->paginate(15);

        return view('Admin.Earning.index', compact('earnings'));
    }


    public function create($earning = null)
    {
        if ($earning != null)
            $projects = Project::where('id', $earning)->get();
        else
            $projects  = Project::where('status', '!=', 'finished')->get();

        if ($projects->count() != 0)
            return view('Admin.Earning.create', compact('projects'));

        session()->flash('EarningProblem');
        return redirect()->route('projects.create');
        return null;
    }


    public function store(Request $request)
    {
        EarningRequest::storeValidate($request);
        $this->repo->createEarning($request);
        return redirect()->route('earnings.index');
    }


    public function show(Earning $earning)
    {
        //
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
        return redirect()->route('earnings.index');
    }


    public function destroy(Earning $earning)
    {
        $earning->delete();
        session()->flash('DeleteEarning');
        return redirect()->route('earnings.index');
    }
}
