<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
        return view('dashboard.admin',[
            'activeMenu' => 'dashboard',
            'active' => 'dashboard', 
        ],compact('logs'));
    }
    public function dashboardKeuangan()
    {
        $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
        return view('dashboard.keuangan',[
            'activeMenu' => 'dashboard',
            'active' => 'keuangan', 
        ],compact('logs'));
    }
    public function peta_pemasaran()
    {
        $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
        return view('dashboard.peta',[
            'activeMenu' => 'dashboard',
            'active' => 'peta', 
        ],compact('logs'));
    }
}