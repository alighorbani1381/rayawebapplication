<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryRepository
{
    const CATEGORY_PROJECT = "project_category";

    public $categoryId;

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
}
