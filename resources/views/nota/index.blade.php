@extends('layout.main')
@section('title', 'Nota dan Kwitansi')
@section('container')
<style>
    @media screen and (max-width: 767px) {
        .mobile{
            display: none;
        }
    }
</style>
<div class="flex justify-between items-center p-6  shadow-md rounded-lg">

    <!-- Title (Nota & Kwitansi) -->
    <div class="text-2xl font-bold text-gray-800">
        <span>Nota</span> & <span>Kwitansi</span>
    </div>

    <!-- Tombol di sebelah kanan -->
    <div class="flex space-x-2">
        @php
        function generateTransactionCode() {
        // Menghasilkan angka acak 7 digit
        $randomNumber = rand(1000000, 9999999);
        // Membuat kode transaksi dengan format B + angka acak
        $transactionCode = 'B' . $randomNumber;
        return $transactionCode;
        }

        // Menggunakan fungsi untuk menghasilkan kode transaksi
        $transactionCode = generateTransactionCode();
        @endphp
        <a href="{{ route('transaksi.nota.manual',$transactionCode) }}" target="_BLANK"
            class="px-2 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
          + Buat Nota Konsinyasi
        </a>
        <a href="{{ route('transaksi.invoice.manual',$transactionCode) }}" target="_BLANK"
            class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
          + Buat INVOICE
        </a>
        <a href="{{ route('transaksi.kwitansi.manual',$transactionCode) }}" target="_BLANK"
            class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
          + Buat Kwitansi
    </a>
    </div>
</div>
<div class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-5 rounded-md">
    <div class="border bg-white dark:bg-black border-black/10 dark:border-white/10 p-5 rounded-md">
        <div class="table-responsive">
            <table class="table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th class="mobile">Kode Transaksi</th>
                        <th class="mobile">Judul</th>
                        <th>Toko / Mitra</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1 @endphp
                    @foreach($data as $item)
                    <tr class="group  border-b border-black/20">
                        <td>{{ $no++ }}</td>
                        <td class="whitespace-nowrap">
                            <a href="{{ route('transaksi.nota.detail', $item->kode_transaksi) }}">
                                {{ $item->tanggal }}
                            </a>
                        </td>
                        <td class="mobile">
                            <a href="{{ route('transaksi.nota.detail', $item->kode_transaksi) }}">
                                {{ $item->kode_transaksi }}
                            </a>
                        </td>
                        <td class="mobile">
                            <a href="{{ route('transaksi.nota.detail', $item->kode_transaksi) }}">
                                {{ $item->judul }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('transaksi.nota.detail', $item->kode_transaksi) }}">
                                {{ $item->kepada }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('transaksi.nota.detail', $item->kode_transaksi) }}">
                                Rp {{ number_format($item->grandtotal, 0, ',', '.') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    @if($data->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-5"> Belum ada Nota dibuat</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
