<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Mitra;
use App\Models\Produk;
use App\Models\Dokumen;
use App\Models\Regency;
use App\Models\Penawaran;
use App\Models\Transaksi;
use App\Models\Itemdokumen;
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
        $totalTransaksiluar = Transaksi::where(['auth'=> auth()->user()->id,'status_bayar'=>'Belum Bayar'])->sum('total');
        $totalTransaksi = Transaksi::where(['auth'=> auth()->user()->id,'status_bayar'=>'Sudah Bayar'])->sum('total');
        $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
        return view('transaksi.index', [
            'activeMenu' => 'transaksi',
            'active' => 'transaksi',
        ], compact('mitra','logs','transaksi','totalTransaksi','totalTransaksiluar'));
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
            toastr()->success("Data has been saved successfully!");
            return redirect()->route('transaksi.index');
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
        toastr()->success("Data has been saved successfully!");
        return redirect()->route('transaksi.detail', ['id' => $transaksi->id]);
    }

    public function konsinyasi($id){
        $transaksi = Transaksi::where('kode_transaksi', $id)->first();
        return view('transaksi.dokumen.index',compact('id','transaksi'));
    }
    public function konsinyasidok($id){
        $transaksi = Transaksi::where('kode_transaksi', $id)->first();
        return view('transaksi.dokumen.laporan.konsinyasi',compact('transaksi'));
    }

    public function manualNota($id){
        $nota = Dokumen::where('kode_transaksi',$id)->first();
        return view('transaksi.dokumen.manual',compact('nota','id'));
    }
  public function manualadd(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'harga' => 'required',
            'total' => 'required',
            'judul' => 'required',
            'kode_transaksi' => 'required',
            'tanggal' => 'required',
            'alamat_company' => 'required',
            'telp_company' => 'required',
            'kota' => 'required',
            'telp' => 'required',
            'kepada' => 'required',
            'keterangan' => 'required',
            'email_company' => 'required',
        ]);

        // Find or create the document based on the 'kode_transaksi'
        $dokumen = Dokumen::updateOrCreate(
            ['kode_transaksi' => $request->kode_transaksi], // Key for determining if document exists
            [
                'judul' => $request->judul,
                'tanggal' => $request->tanggal,
                'alamat_company' => $request->alamat_company,
                'telp_company' => $request->telp_company,
                'kota' => $request->kota,
                'telp' => $request->telp,
                'kepada' => $request->kepada,
                'keterangan' => $request->keterangan,
                'email_company' => $request->email_company,
                'grandtotal' => preg_replace('/\D/', '', $request->grandtotal),
                'auth' => auth()->user()->id,
            ]
        );

      // Loop through the validated data and create/update the items
        foreach ($request->nama_barang as $index => $namaBarang) {
            // Cek jika id_item ada dan tidak null
            $itemId = isset($request->id_item[$index]) ? $request->id_item[$index] : null;

            // Jika id_item tidak ada, gunakan nama_barang untuk mencari item
            if ($itemId === null) {
                $item = Itemdokumen::where('nama_barang', $namaBarang)
                                ->where('kode_transaksi', $request->kode_transaksi)
                                ->first();  // Cek jika ada item dengan nama_barang yang sama
                $itemId = $item ? $item->id : null;  // Jika ditemukan, gunakan id itemnya, kalau tidak id tetap null
            }

            if (empty($namaBarang)) {
                return redirect()->back()->withErrors("Nama barang tidak boleh kosong.");
            }

            // Update atau create item
            Itemdokumen::updateOrCreate(
                ['kode_transaksi' => $request->kode_transaksi, 'id' => $itemId],
                [
                    'nama_barang' => $namaBarang,
                    'qty' => $validated['qty'][$index],
                    'unit' => $validated['unit'][$index],
                    'harga' => preg_replace('/\D/', '', $validated['harga'][$index]), // Remove non-numeric characters
                    'total' => preg_replace('/\D/', '', $validated['total'][$index]),
                    'auth' => auth()->user()->id,
                ]
            );
        }


        toastr()->success("Data has been saved/updated successfully!");
        return redirect()->back();
    }

    public function itemDelete($id){
        Itemdokumen::where('id',$id)->delete();
        return redirect()->back();
    }

    public function kwitansi($id){
        $transaksi = Transaksi::where('kode_transaksi', $id)->first();
        return view('transaksi.dokumen.index',compact('id','transaksi'));
    }

    public function notes(request $request){
        Transaksi::where('kode_transaksi', $request->id)->update(['notes' => $request->notes]);
        toastr()->success("Data has been saved/updated successfully!");
        return redirect()->back();

    }

}
