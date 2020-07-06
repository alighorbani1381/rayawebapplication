<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ACLController extends Controller
{

    public function createPermission()
    {
        return view('Admin.ACL.Permission.create');
    }

    public function storePermission(Request $request)
    {
        
    }

}
