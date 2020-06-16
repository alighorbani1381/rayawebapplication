<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
   
    public function index()
    {
        //
    }

    
    public function create()
    {
        $categories = Category::where('child', '!=', '0')->get();
        $contractors = User::where('type', 'contractor')->get();
        return view('Admin.Project.create', compact('categories', 'contractors'));
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(Project $project)
    {
        //
    }

    
    public function edit(Project $project)
    {
        //
    }

    
    public function update(Request $request, Project $project)
    {
        //
    }

    
    public function destroy(Project $project)
    {
        //
    }
}
