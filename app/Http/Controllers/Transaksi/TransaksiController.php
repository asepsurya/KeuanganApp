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
                '<div class="mobile">' . ($item->tanggal_transaksi ? \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d M Y') : '<span class="text-gray-500">Tidak Diketahui</span>') . '</div>',
                // Nama Toko (ambil dari relasi mitra, jika ada)
                '<div class="mobile">' . ($item->mitra->nama_mitra ?? '<span class="text-gray-500">Tidak Diketahui</span>') . '</div>',
                // Nilai Pesanan (misal: total_harga, jika ada field ini)
                '<div class="mobile">' . (isset($item->total) ? 'Rp ' . number_format($item->total, 0, ',', '.') : '<span class="text-gray-500">Tidak Diketahui</span>') . '</div>',
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
        $logs = Activity::where([
            'causer_id' => auth()->user()->id,
            'log_name' => 'ikm'
        ])->latest()->take(10)->get();
        $penawaran = Penawaran::where('kode_mitra', $id_mitra)->with('produk')->get();

        return view('transaksi.detail', [
            'activeMenu' => 'transaksi',
            'active' => 'transaksi',
        ], compact('mitra', 'logs', 'penawaran','transaksi'));
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

    public function transaksiUpdate(Request $request)
    {
        $request->validate([
            'kode_mitra' => 'required|exists:mitras,kode_mitra',
            'nomor_transaksi' => 'required',
            'discount' => 'nullable',
            'tanggal_bayar' => 'nullable|date',
            'status_bayar' => 'required',
            'barang_keluar' => 'array',
            'barang_terjual' => 'array',
            'barang_retur' => 'array',
            'total' => 'required',
        ]);

        $kode_mitra = $request->kode_mitra;
        $transaksi = Transaksi::where('kode_transaksi', $request->nomor_transaksi)->firstOrFail();

        $transaksi->diskon = $request->discount ?? '0';
        $transaksi->ongkir = $request->ongkir ?? '0';
        $transaksi->tanggal_pembayaran = $request->tanggal_bayar ?? $transaksi->tanggal_pembayaran;
        $transaksi->total = str_replace(['.', ','], '', $request->total); // Remove dots and commas before saving
        $transaksi->status_bayar = $request->status_bayar;
        $transaksi->auth = auth()->user()->id;

        foreach ($request->kode_produk as $index => $kode_produk) {
            $penawaran = Penawaran::where('kode_mitra', $kode_mitra)
            ->where('kode_produk', $kode_produk)
            ->first();

            if ($penawaran) {
            $penawaran->barang_keluar = $request->barang_keluar[$index] ?? $penawaran->barang_keluar;
            $penawaran->barang_terjual = $request->barang_terjual[$index] ?? $penawaran->barang_terjual;
            $penawaran->barang_retur = $request->barang_retur[$index] ?? $penawaran->barang_retur;
            $penawaran->total = str_replace(['.', ','], '', $request->harga[$index] ?? $penawaran->total); // Remove dots and commas before saving
            $penawaran->update();
            }
        }

        $transaksi->update();

        activity('ikm')
            ->causedBy(auth()->user())
            ->performedOn($transaksi)
            ->log('Memperbarui transaksi');

        return redirect()->route('transaksi.detail', ['id' => $transaksi->id])->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function konsinyasi($id){
        $transaksi = Transaksi::where('kode_transaksi', $id)->first();
        return view('transaksi.dokumen.index',compact('id','transaksi'));
    }
    public function konsinyasidok($id){
        $transaksi = Transaksi::where('kode_transaksi', $id)->first();
        return view('transaksi.dokumen.laporan.konsinyasi',compact('transaksi'));
    }
}
