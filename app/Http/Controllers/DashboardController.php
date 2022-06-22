<?php

namespace App\Http\Controllers;

use App\Http\Repositories\DashboardRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    private DashboardRepo $dashboardRepo;
    public function __construct(DashboardRepo $dashboardRepo)
    {
        $this->dashboardRepo = $dashboardRepo;
    }

    public function index()
    {
        $data = $this->dashboardRepo->indexPageData();
        return view('dashboard', $data);
    }
}
