<?php

namespace App\Http\Controllers\Keuangan;

use App\Models\Akun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class KeuanganController extends Controller
{
    public function index(){
        $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
        return view('keuangan.index',[
            'activeMenu' => 'keuangan',
            'active' => 'keuangan',
        ],compact('logs'));
    }
    public function IndexAkun(){
        $akun = Akun::all();
        $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
        return view('keuangan.akun',[
            'activeMenu' => 'akun',
            'active' => 'akun',
        ],compact('logs','akun'));
    }

    public function akunCreate(request $request){
        $request->validate([
            'nama_akun' => 'required|string|max:255',
            'jenis_akun' => 'required|in:pemasukan,pengeluaran',
        ]);

        $akun = Akun::create($request->all());
        activity('ikm')->performedOn($akun)->causedBy(auth()->user())->log('Menambahkan Akun Baru ' . $request->akun);
        toastr()->success("Data has been saved successfully!");
        return redirect()->back();
    }

    public function akunUpdate(request $request){
        $request->validate([
            'nama_akun' => 'required|string|max:255',
            'jenis_akun' => 'required|in:pemasukan,pengeluaran',
        ]);
    
        $akun = Akun::findOrFail($request->id);
        $akun->update([
            'nama_akun' => $request->nama_akun,
            'jenis_akun' => $request->jenis_akun,
        ]);
    
        activity('ikm')
            ->performedOn($akun)
            ->causedBy(auth()->user())
            ->log('Mengupdate Akun ' . $request->nama_akun);
    
        toastr()->success("Data akun berhasil diupdate!");
        return redirect()->back();
    }

    public function akunDelete($id){
        $akun = Akun::findOrFail($id);
        $akun->delete();

        activity('ikm')
            ->performedOn($akun)
            ->causedBy(auth()->user())
            ->log('Menghapus Akun ' . $akun->nama_akun);

        toastr()->success("Data akun berhasil dihapus!");
        return redirect()->back();
    }
}
