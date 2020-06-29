<?php

namespace App\Http\Controllers\Contractor;


class IndexController extends MainController
{
    public function index()
    {
        return view('Contractor.Index.dashbord');
    }
}
