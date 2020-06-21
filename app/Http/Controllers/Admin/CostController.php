<?php

namespace App\Http\Controllers\Admin;

use App\Cost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CostController extends Controller
{
   

    public function index()
    {
        //
    }

    public function create()
    {
        return view('Admin.Cost.create');
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
