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
        # Configuration of Repository
        $this->repo = resolve(CostStaticRepository::class);
    }

    # Show Cost Static List
    public function index()
    {
        $staticCosts = $this->repo->getStaticCosts();
        return view('Admin.CostStatic.index', compact('staticCosts'));
    }

    # Create Cost Static
    public function create()
    {
        $mainCategories = $this->repo->getMainCostStatic();
        return view('Admin.CostStatic.create', compact('mainCategories'));
    }

    # Store Cost Static
    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'child' => 'required']);
        CostStatic::create($request->all());
        return redirect()->route('static.index');
    }

    # Show Cost Static
    public function show()
    {
        return redirect()->route('static.index');
    }

    # Edit Cost Static
    public function edit($costStatic)
    {
        $costStatic = $this->repo->getCostStatic($costStatic);
        $mainCategories = $this->repo->isMain($costStatic)  ? [] : $this->repo->getMainWithoutSelf($costStatic);
        return view('Admin.CostStatic.edit', compact('costStatic', 'mainCategories'));
    }

    # Update Cost Static
    public function update(Request $request, $costStatic)
    {
        $costStatic = $this->repo->getCostStatic();
        $costStatic->update($request->all());
        session()->flash('UpdateCostStatic');
        return redirect()->route('static.index');
    }

    # Remove Cost Static
    public function destroy($costStatic)
    {
        $costStatic = $this->repo->getCostStatic($costStatic);
        $this->repo->deleteSubOrSetFlash($costStatic);
        return back();
    }
}
