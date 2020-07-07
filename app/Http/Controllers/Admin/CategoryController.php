<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Repositories\CategoryRepository;


class CategoryController extends AdminController
{

    private $repo;

    const INDEX = "Index-Category";
    const CREATE = "Index-Category";
    const EDIT = "Edit-Category";
    const DELETE = "Index-Category";

    

    public function __construct()
    {
        $this->repo = resolve(CategoryRepository::class);
    }

    public function index()
    {
        $this->checkAccess(self::INDEX);
        $categories = $this->repo->getCategories();
        return view('Admin.Category.index', compact('categories'));
    }


    public function create()
    {
        $this->checkAccess(self::CREATE);
        $mainCategories = $this->repo->getMainCategories();
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
        $mainCategories = $this->repo->getSpecialCategory($category->id);
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
