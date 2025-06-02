<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDF Editor Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<style>
    .kop-surat {
        width: 100%;
        text-align: center;
        margin-bottom: 10px;
    }

    .garis-atas {
        border: 2px solid black;
        margin: 0;
    }

    .garis-bawah {
        border: 1px solid black;
        margin: 2px 0 10px 0;
    }
</style>

<head>

<body>
    <div class="max-w-[900px] mx-auto p-6 text-black">
        <div class="flex justify-between items-center mb-2">
            <div class="w-36">
                <img alt="IC INOVATE CORPORA logo with red, green, orange, and blue leaf shapes" class="w-full h-auto"
                    height="70" src="{{ asset('assets/images/inopak.jpg') }}" width="150" />
            </div>

            <div class="text-right">
                <h1 class="text-2xl font-normal mb-1"><b>Nota Konsinyasi</b></h1>
                <table class="border border-gray-400 text-sm w-[320px] mx-auto text-black">
                    <thead>
                        <tr class="bg-gray-300 text-center text-xs font-semibold">
                            <th class="border border-gray-400 px-2 py-1">Nomor Nota</th>
                            <th class="border border-gray-400 px-2 py-1">Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center text-xs font-bold">
                            <td class="border border-gray-400 px-2 py-1">{{ $transaksi->kode_transaksi }}</td>
                            <td class="border border-gray-400 px-2 py-1">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-M-y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mb-1 text-[11px] leading-[13px]">
            {{-- <p>{{ $transaksi->alamat_perusahaan }}</p>
    <p>{{ $transaksi->kota_perusahaan }}</p>
    <p>p. {{ $transaksi->telepon_perusahaan }}</p>
    <p>e. {{ $transaksi->email_perusahaan }}</p> --}}
        </div>
        <div class="mt-2">
            <hr class="garis-atas">
            <hr class="garis-bawah">
        </div>

        <div class="text-[12px] leading-[14px] mb-3">
            <div class="flex space-x-2 text-[11px] leading-[13px]">
                <div class="w-20 font-medium">Kepada</div>
                <div class="w-1">:</div>
                <div class="flex-1 font-normal">{{ $transaksi->mitra->nama_mitra }}</div>
            </div>
            <div class="flex space-x-2 text-[11px] leading-[13px]">
                <div class="w-20 font-medium">Alamat</div>
                <div class="w-1">:</div>
                <div class="flex-1 font-normal capitalize">{{ ucwords(strtolower($transaksi->mitra->id_kota)) }}</div>
            </div>
            <div class="flex space-x-2 text-[11px] leading-[13px]">
                <div class="w-20 font-bold">Telepon</div>
                <div class="w-1">:</div>
                <div class="flex-1 font-normal">{{ $transaksi->mitra->no_telp_mitra }}</div>
            </div>
        </div>
        <table class="w-full border-collapse border border-black text-[12px] leading-[14px] mb-2">
            <thead>
                <tr class="border border-black bg-white">
                    <th class="border border-black px-1 text-center w-[30px] font-semibold">No</th>
                    <th class="border border-black px-1 text-left font-semibold">Nama Barang</th>
                    <th class="border border-black px-1 text-center w-[40px] font-semibold">Qty</th>
                    <th class="border border-black px-1 text-center w-[40px] font-semibold">Unit</th>
                    <th class="border border-black px-1 text-center w-[40px] font-semibold">Rp</th>
                    <th class="border border-black px-1 text-center w-[100px] font-semibold">Harga Unit</th>
                    <th class="border border-black px-1 text-center w-[40px] font-semibold">Rp</th>
                    <th class="border border-black px-1 text-center w-[110px] font-semibold">Sub Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->penawaran as $index => $item)
                    <tr class="border border-black">
                        <td class="border border-black px-1 text-center font-normal">
                            {{ intval($index) + 1 }}
                        </td>
                        <td class="border border-black px-1 font-normal">
                            {{ $item->produk->nama_produk }}
                        </td>
                        <td class="border border-black px-1 text-center font-normal">
                            {{ $item->barang_keluar }}
                        </td>
                        <td class="border border-black px-1 text-center font-normal">
                            Pcs
                        </td>
                        <td class="border border-black px-1 text-center font-normal">Rp.</td>
                        <td class="border border-black px-1 text-right font-normal">
                            {{ number_format(floatval($item->harga), 2, ',', '.') }}
                        </td>
                        <td class="border border-black px-1 text-center font-normal">Rp.</td>
                        <td class="border border-black px-1 text-right font-normal">
                            {{ number_format(floatval($item->total), 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border-b border-black px-1 text-right font-normal"></td>
                    <td colspan="2" class="border border-black px-1  font-normal">Ongkos Kirim</td>
                    <td class="border border-black px-1 text-right font-normal">Paket</td>
                    <td colspan="7" class="border border-black px-1 text-right font-normal">
                        {{ $transaksi->ongkir }}
                    </td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <td class="border border-black px-1 font-semibold text-right">
                        TOTAL
                    </td>
                    <td class="border border-black px-1 font-semibold text-right">
                        Rp {{ number_format($item->sum('total'), 2, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="text-[11px] leading-[13px] ">
            Pembayaran dilakukan melalui transfer ke no.
            <strong>Rek Mandiri. 131 000 7197603 atas nama Afin Nurfahmi Mufreni</strong>
            setelah diterima informasi penjualan.
        </p>
        <table class="w-full border-collapse text-[12px] leading-[14px]">
            <tbody>
              <tr>
                <!-- Kolom Penerima -->
                <td class="text-center align-middle" style="height: 180px;">
                  <div class="flex flex-col justify-center items-center h-full">
                    <p class="font-bold">Penerima</p>
                  </div>
                </td>
          
                <!-- Kolom Hormat Kami -->
                <td class="text-center align-middle" style="height: 180px;">
                  <div class="flex flex-col justify-center items-center h-full">
                    <p class="font-bold">Hormat Kami</p>
          
                    <div class="relative flex justify-center items-center" style="height: 20px; width: 180px; margin-top: 8px;">
                      <!-- Stempel di belakang -->
                      <img src="{{ asset('assets/images/stamp.png') }}" alt="Stempel" width="140"
                        class="object-contain absolute z-10"
                        style="top: -40px; left: 50%;transform: translateX(-30%);"
                        id="stamp" hidden>
          
                      <!-- Tanda tangan di atas -->
                      <img src="{{ asset('assets/images/ttd.png') }}" alt="Tanda Tangan" width="140"
                        class="object-contain absolute z-20"
                        style="top: 0; left: 50%;transform: translateX(-50%);"
                        id="signature" hidden>
                    </div>
                  </div>
                </td>
              </tr>
          
              <!-- Baris Garis Tanda Tangan & Nama -->
              <tr>
                <td class="text-center">
                  <div class="mx-auto border-t border-black w-36 mt-8"></div>
                  <p class="mt-2">(Nama Penerima)</p>
                </td>
                <td class="text-center">
                  <div class="mx-auto border-t border-black w-36 mt-8"></div>
                  <p class="mt-2">(Nama Pengirim)</p>
                </td>
              </tr>
            </tbody>
          </table>
          
          



    </div>
    {{-- <script>
    window.onload = function() {
      window.print();
    };
  </script> --}}
</body>

</html>
