<?php

namespace App\Http\Controllers\Admin;

use App\Earning;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;

class EarningController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        $projects  = Project::where('status', '!=', 'finished')->get();
        
        if ($projects->count() != 0)
            return view('Admin.Earning.create', compact('projects'));

        session()->flash('EarningProblem');
        return redirect()->route('projects.create');
        return null;
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Earning $earning)
    {
        //
    }


    public function edit(Earning $earning)
    {
        //
    }


    public function update(Request $request, Earning $earning)
    {
        //
    }


    public function destroy(Earning $earning)
    {
        //
    }
}
