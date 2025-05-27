<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin',[
            'activeMenu' => 'dashboard',
            'active' => 'dashboard', 
        ]);
    }
    public function dashboardKeuangan()
    {
        return view('dashboard.keuangan',[
            'activeMenu' => 'dashboard',
            'active' => 'keuangan', 
        ]);
    }
    public function peta_pemasaran()
    {
        return view('dashboard.peta',[
            'activeMenu' => 'dashboard',
            'active' => 'peta', 
        ]);
    }
}