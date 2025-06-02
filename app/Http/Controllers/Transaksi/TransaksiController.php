<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Mitra;
use App\Models\Produk;
use App\Models\Regency;
use App\Models\Penawaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class TransaksiController extends Controller
{
    public function transaksiIndex(){
    $mitra = Mitra::where('auth', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->select('id', 'kode_mitra', 'nama_mitra')
        ->get();
        // Hitung jumlah berdasarkan Kota
        $totalKota = Mitra::whereNotNull('id_kota')->count();

        $transaksi = Transaksi::where('auth', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
            return [
                // Kode Transaksi
                '<a href="' . route("transaksi.detail", $item->id) . '" class="flex items-center space-x-2 text-blue-600 hover:underline">
                <span>' . e($item->kode_transaksi) . '</span>
                </a>',
                // Tanggal Transaksi
                '<div class="mobile">' . ($item->tanggal_transaksi ?? '<span class="text-gray-500">Tidak Diketahui</span>') . '</div>',
                // Nama Toko (ambil dari relasi mitra, jika ada)
                '<div class="mobile">' . ($item->mitra->nama_mitra ?? '<span class="text-gray-500">Tidak Diketahui</span>') . '</div>',
                // Nilai Pesanan (misal: total_harga, jika ada field ini)
                '<div class="mobile">' . (isset($item->total) ? number_format($item->total, 0, ',', '.') : '<span class="text-gray-500">Tidak Diketahui</span>') . '</div>',
                // Status Pembayaran (misal: status_pembayaran, jika ada field ini)
                '<div class="mobile">' . ($item->status_bayar ?? '<span class="text-gray-500">Tidak Diketahui</span>') . '</div>',
            ];
            })->values();

        $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
        return view('transaksi.index', [
            'activeMenu' => 'transaksi',
            'active' => 'transaksi',
        ], compact('mitra','logs','totalKota','transaksi')); 
    }

    public function DetailTransaki($id){
        $transaksi = Transaksi::findOrFail($id);
        $id_mitra = $transaksi->kode_mitra;

        $mitra = Mitra::where('kode_mitra', $id_mitra)->first();
        $produk = Produk::where('auth', auth()->user()->id)->get();
        $kota = Regency::all();
        $logs = Activity::where([
            'causer_id' => auth()->user()->id,
            'log_name' => 'ikm'
        ])->latest()->take(10)->get();
        $penawaran = Penawaran::where('kode_mitra', $id_mitra)->get();

        return view('transaksi.detail', [
            'activeMenu' => 'transaksi',
            'active' => 'transaksi',
        ], compact('mitra', 'produk', 'logs', 'penawaran', 'kota'));
    }

    public function transaksiCreate(request $request){
        $request->validate([
            'kode_mitra' => 'required|exists:mitras,kode_mitra',
            ]);

            $transaksi = new Transaksi();
            $transaksi->kode_transaksi = $request->kode_transaksi;
            $transaksi->kode_mitra = $request->kode_mitra;
            $transaksi->tanggal_transaksi = now();
            $transaksi->auth = auth()->user()->id;
            $transaksi->save();

            activity('ikm')
                ->causedBy(auth()->user())
                ->performedOn($transaksi)
                ->log('Membuat transaksi baru');

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
