<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $mitras = Mitra::select('latitude', 'longitude', 'nama_mitra')->get()->map(function($item) {
            return [
                'lat' => (float) $item->latitude,
                'lng' => (float) $item->longitude,
                'label' => $item->nama_mitra,
            ];
        });
        
      $jumlahPerKota = Mitra::select('id_kota', DB::raw('count(*) as total'))
        ->whereNotNull('id_kota')
        ->groupBy('id_kota')
        ->get();


        $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
        return view('dashboard.peta',[
            'activeMenu' => 'dashboard',
            'active' => 'peta', 
        ],compact('logs','mitras','jumlahPerKota'));
    }
}