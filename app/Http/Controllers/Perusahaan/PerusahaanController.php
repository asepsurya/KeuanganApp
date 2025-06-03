<?php

namespace App\Http\Controllers\Perusahaan;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class PerusahaanController extends Controller
{
    public function index(){
        return view('perusahaan.setup');
    }
    public function create(request $request){
        $usaha = Perusahaan::where('auth',auth()->user()->id)->get();
        if($usaha->count() > 0){
             toastr()->warning("Anda Sudah Registrasi Perusahaan Sebelumnya");
            return redirect()->back();
        }else{
             Perusahaan::create([
                'nama_perusahaan'=>$request->name,
                'telp_perusahaan'=>$request->phone,
                'alamat'=>$request->alamat,
                'email'=>$request->email,
                'auth'=>auth()->user()->id,
            ]);
            toastr()->success("Data has been saved successfully!");
            return redirect('/dashboard');
        
        }      
      
    }

    public function PerusahaanSetting(request $request){
        $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
         return view('perusahaan.index',[
            'activeMenu' => 'perusahaan',
            'active' => 'perusahaan', 
        ],compact('logs'));
    }
}
