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
        //
    }

   
    public function edit(CostStatic $costStatic)
    {
        //
    }

    
     
    public function update(Request $request, CostStatic $costStatic)
    {
        //
    }

   
    public function destroy(CostStatic $costStatic)
    {
        //
    }
}
