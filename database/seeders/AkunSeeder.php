<?php

namespace Database\Seeders;

use App\Models\Akun;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_akun' => 'Penjualan Produk', 'jenis_akun' => 'pemasukan'],
            ['nama_akun' => 'Pendapatan Jasa', 'jenis_akun' => 'pemasukan'],
            ['nama_akun' => 'Pendapatan Sewa', 'jenis_akun' => 'pemasukan'],
            ['nama_akun' => 'Pendapatan Lain-lain', 'jenis_akun' => 'pemasukan'],
            ['nama_akun' => 'Modal Awal', 'jenis_akun' => 'pemasukan'],
            ['nama_akun' => 'Pemasukan Investasi', 'jenis_akun' => 'pemasukan'],
    
            ['nama_akun' => 'Biaya Operasional', 'jenis_akun' => 'pengeluaran'],
            ['nama_akun' => 'Pembelian Bahan Baku', 'jenis_akun' => 'pengeluaran'],
            ['nama_akun' => 'Pembayaran Gaji', 'jenis_akun' => 'pengeluaran'],
            ['nama_akun' => 'Pembayaran Sewa', 'jenis_akun' => 'pengeluaran'],
            ['nama_akun' => 'Biaya Transportasi', 'jenis_akun' => 'pengeluaran'],
            ['nama_akun' => 'Biaya Promosi', 'jenis_akun' => 'pengeluaran'],
            ['nama_akun' => 'Biaya Listrik dan Air', 'jenis_akun' => 'pengeluaran'],
            ['nama_akun' => 'Pembayaran Hutang', 'jenis_akun' => 'pengeluaran'],
            ['nama_akun' => 'Pembelian Peralatan', 'jenis_akun' => 'pengeluaran'],
            ['nama_akun' => 'Pengeluaran Lain-lain', 'jenis_akun' => 'pengeluaran'],
        ];
    
        foreach ($data as $item) {
            Akun::updateOrCreate(
                ['nama_akun' => $item['nama_akun']],  // condition
                ['jenis_akun' => $item['jenis_akun']] // values to update
            );
        }
    }
}
