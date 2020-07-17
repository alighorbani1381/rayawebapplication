<?php

namespace App\Http\Controllers\Admin;

use App\CostStatic;
use Illuminate\Http\Request;
use App\Repositories\CostStaticRepository;

class CoststaticController extends AdminController
{

    # Define Acess Gate
    const INDEX = "Index-Cost-Static";

    const CREATE = "Create-Cost-Static";

    const SHOW = "Show-Cost";

    const EDIT = "Edit-Cost-Static";

    const DELETE = "Delete-Cost-Static";

    const MULTI_ACCESS = [self::INDEX, self::CREATE, self::SHOW, self::EDIT, self::DELETE];
    

    private $repo;

    public function __construct()
    {
        # Configuration of Repository
        $this->repo = resolve(CostStaticRepository::class);
    }

    # Show Cost Static List
    public function index()
    {
        $this->checkMultiAccess(self::MULTI_ACCESS);
        $staticCosts = $this->repo->getStaticCosts();
        return view('Admin.CostStatic.index', compact('staticCosts'));
    }

    # Create Cost Static
    public function create()
    {
        $this->checkAccess(self::CREATE);
        $mainCategories = $this->repo->getMainCostStatic();
        return view('Admin.CostStatic.create', compact('mainCategories'));
    }

    # Store Cost Static
    public function store(Request $request)
    {
        $this->checkAccess(self::CREATE);
        $request->validate(['title' => 'required', 'child' => 'required']);
        CostStatic::create($request->all());
        session()->flash('CreateCostStatic');
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
        $this->checkAccess(self::EDIT);
        $costStatic = $this->repo->getCostStatic($costStatic);
        $mainCategories = $this->repo->isMain($costStatic)  ? [] : $this->repo->getMainWithoutSelf($costStatic);
        return view('Admin.CostStatic.edit', compact('costStatic', 'mainCategories'));
    }

    # Update Cost Static
    public function update(Request $request, $costStatic)
    {
        $this->checkAccess(self::EDIT);
        $costStatic = $this->repo->getCostStatic();
        $costStatic->update($request->all());
        session()->flash('UpdateCostStatic');
        return redirect()->route('static.index');
    }

    # Remove Cost Static
    public function destroy($costStatic)
    {
        $this->checkAccess(self::DELETE);
        $costStatic = $this->repo->getCostStatic($costStatic);
        $deletedResult = $this->repo->deleteSubOrSetFlash($costStatic);
        return $deletedResult;
    }
}
