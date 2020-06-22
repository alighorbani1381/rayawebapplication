<?php

namespace App\Http\Controllers\Admin;

use App\Cost;
use App\CostStatic;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class CostRepository
{

    public function projectStore($request)
    {
        return $pay =  isset($request->contractor_pay) ? $this->projectContractorPay($request) : $this->projectStorePay($request);
    }

    public function projectStorePay($request)
    {
        return 'without contract pay';
    }

    public function projectContractorPay($request)
    {
        return 'contract pay';
    }
}
class CostController extends Controller
{

    public function __construct()
    {
        $this->repo = new CostRepository();
    }

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
        $request->validate(['storeType' => 'required']);
        $type = $request->get('storeType');

        if ($type == 'project')
            return $this->repo->projectStore($request);
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
