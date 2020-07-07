<?php

namespace App\Http\Controllers\Admin;

use App\CostStatic;
use Illuminate\Http\Request;
use App\Repositories\CostStaticRepository;

class CoststaticController extends AdminController
{

    private $repo;
  
    public function __construct()
    {
        $this->repo = resolve(CostStaticRepository::class);
    }

    public function index()
    {
        $staticCosts = $this->repo->getStaticCosts();
        return view('Admin.CostStatic.index', compact('staticCosts'));
    }


    public function create()
    {
        $mainCategories = $this->repo->getMainCostStatic();
        return view('Admin.CostStatic.create', compact('mainCategories'));
    }


    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'child' => 'required']);
        CostStatic::create($request->all());
        return redirect()->route('static.index');
    }


    public function show()
    {
        return redirect()->route('static.index');
    }


    public function edit($costStatic)
    {
        $costStatic = $this->repo->getCostStatic($costStatic);
        $mainCategories = $this->repo->isMain($costStatic)  ? [] : $this->repo->getMainWithoutSelf($costStatic);
        return view('Admin.CostStatic.edit', compact('costStatic', 'mainCategories'));
    }

    public function update(Request $request, $costStatic)
    {
        $costStatic = $this->repo->getCostStatic();
        $costStatic->update($request->all());
        session()->flash('UpdateCostStatic');
        return redirect()->route('static.index');
    }

    public function destroy($costStatic)
    {
        $costStatic = $this->repo->getCostStatic($costStatic);
        $this->repo->deleteSubOrSetFlash($costStatic);
        return back();
    }
}
