<?php

namespace App\Repositories;

use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryRepository
{
    const CATEGORY_PROJECT = "project_category";

    public $categoryId;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getProjectsCount()
    {
        return DB::table(self::CATEGORY_PROJECT)
            ->where('category_id', $this->getCategoryId())
            ->count();
    }

    public function getFileds()
    {
        return ['title', 'description', 'child', 'created_at', 'updated_at'];
    }

    public function getValues()
    {
        $time = date('Y-m-d');
        $request = $this->request;
        return [$request->title, $request->description, $request->child, $time, $time,];
    }

    public function getParam()
    {
        $fileds = $this->getFileds();
        $values = $this->getValues($this->request);
        foreach($fileds as $key => $filed){
            if(array_key_exists($key, $values)){
                $result[$filed] = $values[$key];
            }
        }
        return $result;
    }

    public function createCategory(Request $request)
    {
        $this->setRequest($request);
        return DB::table('categories')->insert($this->getParam());
    }

    public function hasCategories()
    {
        return Category::where('child', '!=', '0')->get();
    }
}
