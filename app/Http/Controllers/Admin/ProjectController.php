<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectRequest{

    public static function projectValidate($request){
        $fileds = [
            'name' => 'required',
            'lastname' => 'required',
            'father_name' => 'required',
            'meli_code' => 'required',
            //'meli_image' => 'none',
            'phone' => 'required',
            'address' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            //'contract_image' => 'Default',
            'contract_started' => 'required',
            'completed_at' => 'required',
            'date_start' => 'required',
            'complete_after' => 'required',
        ];

        $request->validate($fileds);
    }
}
class ProjectRepository
{

    public static function createTaskMaster($request)
    {
        return  DB::table('project_taskmaster')
            ->insertGetId([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'father_name' => $request->father_name,
                'meli_code' => $request->meli_code,
                'meli_image' => 'none',
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
    }

    public static function createProject($request, $taskmaster)
    {
        $uniqueId =  'rayaweb' . '-' . uniqid() . '-' . $request->phone;
        return DB::table('projects')->insertGetId([
            'project_creator' => '1',
            'taskmaster' => $taskmaster,
            'unique_id' => $uniqueId,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'contract_image' => 'Default',
            'contract_started' => $request->contract_started,
            'contract_ended' => $request->completed_at,
            'status' => 'waiting',
            'progress' => '0',
            'date_start' => $request->date_start,
            'complete_after' => $request->complete_after,
        ]);
    }

    public static function setContractors($projectId, $contractors)
    {
        foreach ($contractors as $contractor)
            DB::table('project_contractor')->insert([
                'project_id' => $projectId,
                'contractor_id' => $contractor,
            ]);
    }

    public static function setCategories($projectId, $categories)
    {
        foreach ($categories as $category)
            DB::table('project_category')->insert([
                'project_id' => $projectId,
                'category_id' => $category,
            ]);
    }

    public static function getProjects(){
        return DB::table('projects')
        ->join('project_taskmaster', 'projects.taskmaster', '=', 'project_taskmaster.id')
        ->get();
    }
}

class ProjectController extends Controller
{

    public function index()
    {
        $projects = ProjectRepository::getProjects();
        
    }


    public function create()
    {
        $categories = Category::where('child', '!=', '0')->get();
        $contractors = User::where('type', 'contractor')->get();
        return view('Admin.Project.create', compact('categories', 'contractors'));
    }


    public function store(Request $request)
    {
        ProjectRequest::projectValidate($request);

        DB::transaction(function () use ($request) {
            $taskmaster = ProjectRepository::createTaskMaster($request);
            $project = ProjectRepository::createProject($request, $taskmaster);
            ProjectRepository::setContractors($project, $request->contractors);
            ProjectRepository::setCategories($project, $request->categories);
        });
        return redirect()->route('projects.index');
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
