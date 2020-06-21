<?php

namespace App\Http\Controllers\Admin;

use App\CostStatic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return redirect()->route('static.index');
    }


    public function show(CostStatic $costStatic)
    {
        return redirect()->route('static.index');
    }


    public function edit($costStatic)
    {
        $costStatic = CostStatic::findOrFail($costStatic);
        if ($costStatic->child != 0)
            $mainCategories = CostStatic::where('child', '0')->where('id', '!=', $costStatic)->get();
        else
            $mainCategories = [];
        return view('Admin.CostStatic.edit', compact('costStatic', 'mainCategories'));
    }



    public function update(Request $request, $costStatic)
    {
        $costStatic = CostStatic::findOrFail($costStatic);
        $costStatic->update($request->all());
        session()->flash('UpdateCostStatic');
        return redirect()->route('static.index');
    }


    public function destroy($costStatic)
    {
        $costStatic = CostStatic::findOrFail($costStatic);
        if ($costStatic->child == 0) {
            $subStatics = CostStatic::where('child', $costStatic->id)->select('id')->get();
            foreach ($subStatics as $subStatic) {
                DB::table('cost_statics')
                    ->where('cost_statics.id', $subStatic->id)
                    ->delete();
            }
            $costStatic->delete();

            session()->flash('DeleteCostStaticAllMember');
        } else {

            $costStatic->delete();
            session()->flash('DeleteCostStatic');
        }


        return back();
    }
}
