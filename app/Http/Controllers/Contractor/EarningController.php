<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\Repositories\EarningRepository;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = resolve(EarningRepository::class);
    }
}
