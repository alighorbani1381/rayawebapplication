<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryRequest{

    public static function store($request){
        $request->validate([
            'title' => 'required',            
            'description' => 'required',            
            'child' => 'required',            
        ]);
    }

}

class CategoryController extends Controller
{
   
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
        //
    }

    public function edit(Category $category)
    {
        //
    }

   
    public function update(Request $request, Category $category)
    {
        //
    }

    
    public function destroy(Category $category)
    {
        //
    }
}
