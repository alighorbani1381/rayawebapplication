<?php

namespace App\Http\Controllers\Admin;

use App\CostStatic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoststaticController extends Controller
{
    
    public function index()
    {
        $staticCosts = CostStatic::orderBy('child')->paginate(15);
        return view('Admin.CostStatic.index', compact('staticCosts'));
    }

    
    public function create()
    {
        $mainCategories = CostStatic::where('child', '0')->get();
        return view('Admin.CostStatic.create', compact('mainCategories'));
    }

   
    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'child' => 'required']);
        CostStatic::create($request->all());
        session()->flash('StaticCreate');
        return redirect()->route('static.index');
    }

    
    public function show(CostStatic $costStatic)
    {
        return redirect()->route('static.index');
    }

   
    public function edit($costStatic)
    {
        CostStatic::findOrFail($costStatic);
        $mainCategories = CostStatic::where('child', '0')->where('id', '!=', $costStatic)->get();
        $costStatic = CostStatic::findOrFail($costStatic);
        return view('Admin.CostStatic.edit', compact('costStatic', 'mainCategories'));
    }

    
     
    public function update(Request $request, $costStatic)
    {
        $costStatic = CostStatic::findOrFail($costStatic);
        $costStatic->update($request->all());
        session()->flash('UpdateCostStatic');
        return redirect()->route('static.index');
    }

   
    public function destroy(CostStatic $costStatic)
    {
        //
    }
}
