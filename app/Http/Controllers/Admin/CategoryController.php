<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Gate;


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

    const INDEX = "Index-Category";
    const CREATE = "Index-Category";
    const EDIT = "Edit-Category";
    const DELETE = "Index-Category";

    private function checkAccess($gateName)
    {
        if (Gate::denies($gateName))
            abort(404);
    }

    public function __construct()
    {
        $this->repo = resolve(CategoryRepository::class);
    }

    public function index()
    {
        $this->checkAccess(self::INDEX);
        $categories = Category::orderBy('id')->paginate(15);
        return view('Admin.Category.index', compact('categories'));
    }


    public function create()
    {
        $this->checkAccess(self::CREATE);
        $mainCategories = Category::where('child', '0')->get();
        return view('Admin.Category.create', compact('mainCategories'));
    }


    public function store(Request $request)
    {
        $this->checkAccess(self::CREATE);
        CategoryRequest::store($request);
        $this->repo->createCategory($request);
        return redirect()->route('categories.index');
    }


    public function show(Category $category)
    {
        $this->checkAccess(self::CREATE);
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $this->checkAccess(self::EDIT);
        $mainCategories = Category::where('child', '0')->where('id', '!=', $category->id)->get();
        return view('Admin.Category.edit', compact('category', 'mainCategories'));
    }


    public function update(Request $request, Category $category)
    {
        $this->checkAccess(self::EDIT);
        CategoryRequest::store($request);
        $subCatsCount = count($category->sub_cats);

        if ($subCatsCount != 0 && $request->child != 0) {
            Session::flash('CategoryUpdateFail');
            return back();            
        }

        $category->update($request->all());
        Session::flash('CategoryUpdate');
        return redirect()->route('categories.index');
    }


    public function destroy(Category $category)
    {
        $this->checkAccess(self::DELETE);

        if ($category->hasSubCategory()) {
            Session::flash('Error-Sub', $category->getCountSub());
            return redirect()->route('categories.index');
        }

        if ($category->hasProjects()) {
            Session::flash('Error-Project', $category->getProjectCount());
            return redirect()->route('projects.index');
        }


        $category->delete();
        Session::flash('DeleteCategory');
        return redirect()->route('categories.index');
    }
}
