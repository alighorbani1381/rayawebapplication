<?php

namespace App\Http\Controllers\Admin;

use App\Cost;
use App\CostStatic;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;

class CostController extends Controller
{
   

    public function index()
    {
        //
    }

    public function create()
    {
        $types = CostStatic::where('child', '0')->get();
        $projects = Project::where('status', '!=', 'finished')->get();
        return view('Admin.Cost.create', compact('projects', 'types'));
    }

    public function store(Request $request)
    {
        //
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
        //
    }
}
