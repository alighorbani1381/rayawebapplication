<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryRequest
{

    public static function store($request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'child' => 'required',
        ]);
    }
}



class CategoryController extends AdminController
{

    private $repo;

    public function __construct()
    {
        $this->repo = resolve(CategoryRepository::class);
    }

    public function index()
    {
        $categories = Category::orderBy('id')->paginate(15);
        return view('Admin.Category.index', compact('categories'));
    }


    public function create()
    {
        $mainCategories = Category::where('child', '0')->get();
        return view('Admin.Category.create', compact('mainCategories'));
    }


    public function store(Request $request)
    {
        CategoryRequest::store($request);
        Category::create($request->all());
        return redirect()->route('categories.index');
    }


    public function show(Category $category)
    {
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $mainCategories = Category::where('child', '0')->where('id', '!=', $category->id)->get();
        return view('Admin.Category.edit', compact('category', 'mainCategories'));
    }


    public function update(Request $request, Category $category)
    {
        CategoryRequest::store($request);
        $subCatsCount = count($category->sub_cats);

        if ($subCatsCount != 0 && $request->child != 0) {
            Session::flash('CategoryUpdateFail');
            return back();
            return null;
        }

        $category->update($request->all());
        Session::flash('CategoryUpdate');
        return redirect()->route('categories.index');
    }


    public function destroy(Category $category)
    {
        if ($category->hasSubCategory()){
            Session::flash('Error-Sub', $category->getCountSub());
            return redirect()->route('categories.index');
        }

        if($category->hasProjects()){
            Session::flash('Error-Project', $category->getProjectCount());
            return redirect()->route('projects.index');
        }        


        $category->delete();
        Session::flash('DeleteCategory');
        return redirect()->route('categories.index');
    }
}
