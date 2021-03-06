<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\StoreCategory;
use Illuminate\Support\Facades\Session;
use App\Repositories\CategoryRepository;


class CategoryController extends AdminController
{

    private $repo;

    # Define Acess Gate
    const INDEX = "Index-Category";

    const CREATE = "Create-Category";

    const EDIT = "Edit-Category";

    const DELETE = "Delete-Category";

    const MULTI_ACCESS = [self::INDEX, self::CREATE, self::EDIT, self::DELETE];

    public function __construct(CategoryRepository $repository)
    {
        $this->repo = $repository;
    }

    # Show List of Categories
    public function index()
    {
        $this->checkMultiAccess(self::MULTI_ACCESS);
        $categories = $this->repo->getCategories();
        return view('Admin.Category.index', compact('categories'));
    }


    # Create Categories View
    public function create()
    {
        $this->checkAccess(self::CREATE);
        $mainCategories = $this->repo->getMainCategories();
        return view('Admin.Category.create', compact('mainCategories'));
    }

    # Store Categories
    public function store(StoreCategory $request)
    {
        $this->checkAccess(self::CREATE);
        $this->repo->createCategory($request);
        return redirect()->route('categories.index');
    }


    # Show Categories
    public function show(Category $category)
    {
        $this->checkAccess(self::CREATE);
        return redirect()->route('categories.index');
    }

    # Edit Categories
    public function edit(Category $category)
    {
        $this->checkAccess(self::EDIT);
        $mainCategories = $this->repo->getSpecialCategory($category->id);
        return view('Admin.Category.edit', compact('category', 'mainCategories'));
    }


    # Update Categories
    public function update(StoreCategory $request, Category $category)
    {
        $this->checkAccess(self::EDIT);
        $subCatsCount = count($category->sub_cats);

        if ($subCatsCount != 0 && $request->child != 0) {
            Session::flash('CategoryUpdateFail');
            return back();
        }

        $category->update($request->all());
        Session::flash('CategoryUpdate');
        return redirect()->route('categories.index');
    }


    # Remove Categories with Depencendy
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
