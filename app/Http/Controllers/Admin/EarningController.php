<?php

namespace App\Http\Controllers\Admin;

use App\Earning;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;

class EarningRequest{
    
    public static function storeValidate($request){
        $request->validate([
            'title.*' => 'required|array',
            'received_money.*' => 'required|array|numeric|min:1',
            'status.*' => 'required|array',
        ]);
    }

}

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
        // return $request->all();
        // return null;

        EarningRequest::storeValidate($request);
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
