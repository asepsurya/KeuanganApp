@extends('layout.main')
@section('css')

@section('title', 'Form Tambah Mitra')
@section('container')
    <style>
        /* Membatasi tinggi dropdown dan menambah overflow auto untuk scroll jika terlalu panjang */
        #kota-recommendations {
            max-height: 200px;
            /* Atur tinggi maksimal dropdown */
            width: 100%;
            /* Menyesuaikan lebar dropdown dengan lebar input */
            position: absolute;
            top: 100%;
            /* Menampilkan di bawah input */
            left: 0;
            z-index: 10;
        }

        /* Agar dropdown terlihat lebih rapi saat tampil */
        #kota-recommendations li {
            padding: 8px 10px;
            cursor: pointer;
        }

        #kota-recommendations li:hover {
            background-color: #f0f0f0;
        }

        /* Dark mode hover effect */
        .dark #kota-recommendations li:hover {
            background-color: #374151;
            /* dark hover */
        }

        .dark #kota-recommendations li {
            color: #e5e7eb;
            /* warna teks dark mode */
        }

        .dark #kota-recommendations {
            background-color: #1c1c1c;
            /* dark background */
            border-color: #4b5563;
            /* dark border */
        }
       
        /* Style untuk desktop (default) */
        #produkTable .table-responsive {
        width: 100%;
        overflow-x: hidden; /* Sembunyikan scroll horizontal di desktop */
        }

        /* Style khusus untuk mobile */
        @media (max-width: 768px) {
        #produkTable .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto; /* Aktifkan scroll horizontal */
            -webkit-overflow-scrolling: touch; /* Scroll halus di iOS */
            
            /* Optional: Styling tambahan untuk mobile */
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        
        #produkTable table {
            min-width: 600px; /* Lebar minimum tabel */
            white-space: nowrap; /* Mencegah text wrapping */
        }
        
        #produkTable th, 
        #produkTable td {
            padding: 8px 12px; /* Padding lebih kecil di mobile */
        }
        
        /* Style scrollbar (opsional) */
        #produkTable .table-container::-webkit-scrollbar {
            height: 5px;
        }
        
        #produkTable .table-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }
}



    </style>
    <div class="px-2 py-1 mb-4 flex items-center justify-between">
        <h2 class="text-lg font-semibold">Transaksi Mitra / Toko</h2>
        <div class="flex flex-col sm:flex-row gap-3">
            <button type="submit"
                class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow transition duration-150">
                Tambah Transaksi Baru
            </button>
        </div>
        <script>
            function confirmDelete(url) {
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Tindakan ini tidak dapat dibatalkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg mx-2 focus:outline-none',
                        cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg mx-2 focus:outline-none'
                    },
                    buttonsStyling: false // penting agar customClass dipakai
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        </script>
    </div>

    <form action="{{ route('transaksi.update') }}" method="POST">
        @csrf
        <div class="border border-black/10 dark:border-white/10 p-6 rounded-lg mb-6 shadow-sm bg-white dark:bg-white/5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <div class="mb-4">
                        <label class="block mb-1 text-xs font-semibold text-gray-600 dark:text-gray-300">
                            Tanggal Transaksi
                        </label>
                        <input type="date"
                            class="form-input w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 transition"
                            name="tanggal_transaksi" value="{{ $mitra->tanggal_transaksi ?? date('Y-m-d') }}" required
                            style="appearance: none; -webkit-appearance: none; background:  url('data:image/svg+xml;utf8,<svg fill=\'%236B7280\' height=\'20\' viewBox=\'0 0 20 20\' width=\'20\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7.293 9.293a1 1 0 011.414 0L10 10.586l1.293-1.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414z\'/></svg>') no-repeat right 0.75rem center/1.5em 1.5em; padding-right: 2.5rem;" />
                    </div>
                </div>
                <div>
                    <div class="mb-4">
                        <label class="block mb-1 text-xs font-semibold text-gray-600 dark:text-gray-300">
                            Nomor Transaksi
                        </label>
                        <input type="text"
                            class="form-input w-full rounded-md border-gray-300  text-gray-800 font-bold text-lg"
                            name="nomor_transaksi" value="{{ $transaksi->kode_transaksi }}"
                            readonly />
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
            <div class="col-span-1">
                <div class="border border-black/10 dark:border-white/10 rounded-lg mb-2">
                    <button type="button"
                        class="w-full flex justify-between items-center px-4 py-3 bg-gray-100 dark:bg-white/10 rounded-t-lg focus:outline-none"
                        data-accordion-target="#accordion-mitra" aria-expanded="true" aria-controls="accordion-mitra"
                        onclick="toggleAccordion('accordion-mitra')">
                        <span class="font-semibold text-sm">Data Mitra / Toko</span>
                        <svg class="w-4 h-4 transition-transform rotate-180" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="accordion-mitra" class="px-4 py-3 bg-white dark:bg-white/5 rounded-b-lg">
                        <div class="relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 mb-4">
                            <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Nama Mitra / Toko</label>
                            <div class="flex items-center">
                                <span class="mr-2 text-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7V6a1 1 0 011-1h16a1 1 0 011 1v1M5 21h14a2 2 0 002-2v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7a2 2 0 002 2zM16 10V5a1 1 0 00-1-1h-6a1 1 0 00-1 1v5" />
                                    </svg>
                                </span>
                                <input type="text"
                                    class="form-input w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 transition"
                                    name="nama_mitra" value="{{ $mitra->nama_mitra }}" readonly />
                            </div>
                        </div>
                        <div class="relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 mb-4">
                            <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Asal Kota</label>
                            <input type="text" id="kota-input" name="id_kota"
                                class="form-input w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 transition"
                                placeholder="Masukan Nama Kota Mitra" value="{{ $mitra->id_kota }}" autocomplete="off"
                                oninput="showRecommendations()" readonly />
                            <ul id="kota-recommendations"
                                class="absolute w-full mt-1 bg-white dark:bg-dark dark:border-white/10 border border-gray-200 shadow-lg hidden max-h-40 overflow-y-auto z-10 rounded-md">
                                <!-- Data recommendations will be injected here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="border border-black/10 dark:border-white/10 rounded-lg mb-2">
                    <button type="button"
                        class="w-full flex justify-between items-center px-4 py-3 bg-gray-100 dark:bg-white/10 rounded-t-lg focus:outline-none"
                        data-accordion-target="#accordion-mitra2" aria-expanded="true" aria-controls="accordion-mitra2"
                        onclick="toggleAccordion('accordion-mitra2')">
                        <span class="font-semibold text-sm">Kontak & Kode Customer</span>
                        <svg class="w-4 h-4 transition-transform rotate-180" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="accordion-mitra2" class="px-4 py-3 bg-white dark:bg-white/5 rounded-b-lg">
                        <div class="relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 mb-4">
                            <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Nomor Telepon Mitra</label>
                            <input type="text"
                                class="form-input w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 transition"
                                name="no_telp_mitra" value="{{ $mitra->no_telp_mitra }}" readonly />
                        </div>
                        <div class="relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 mb-4">
                            <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Kode Customer</label>
                            <input type="text"
                                class="form-input w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 transition"
                                name="kode_mitra" value="{{ $mitra->kode_mitra }}" readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accordions Start -->
        <div id="accordion-parent" class="mb-6">
            <div class="border border-black/10 dark:border-white/10 rounded-lg mb-2">
                <button type="button"
                    class="w-full flex justify-between items-center px-4 py-3 bg-gray-100 dark:bg-white/10 rounded-t-lg focus:outline-none"
                    data-accordion-target="#accordion-alamat" aria-expanded="false" aria-controls="accordion-alamat"
                    onclick="toggleAccordion('accordion-alamat')">
                    <span class="font-semibold text-sm">Alamat Mitra / Toko</span>
                    <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="accordion-alamat" class="hidden px-4 py-3 bg-white dark:bg-white/5 rounded-b-lg">
                    <textarea class="form-input w-full" name="alamat_mitra" placeholder="Alamat Mitra" readonly>{{ $mitra->alamat_mitra }}</textarea>
                </div>
            </div>
            <div class="border border-black/10 dark:border-white/10 rounded-lg mb-2">
                <button type="button"
                    class="w-full flex justify-between items-center px-4 py-3 bg-gray-100 dark:bg-white/10 rounded-t-lg focus:outline-none"
                    data-accordion-target="#accordion-maps" aria-expanded="false" aria-controls="accordion-maps"
                    onclick="toggleAccordion('accordion-maps')">
                    <span class="font-semibold text-sm">Titik Lokasi (Google Maps)</span>
                    <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="accordion-maps" class="hidden px-4 py-3 bg-white dark:bg-white/5 rounded-b-lg">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Longitude</label>
                            <input type="text" placeholder="Longitude" class="form-input w-full" name="longitude"
                                id="longitude" value="{{ $mitra->longitude }}" readonly />
                        </div>
                        <div>
                            <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Latitude</label>
                            <input type="text" placeholder="Latitude" class="form-input w-full" name="latitude"
                                id="latitude" value="{{ $mitra->latitude }}" readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Accordions End -->

        <script>
            function toggleAccordion(id) {
                const content = document.getElementById(id);
                const btn = document.querySelector(`[data-accordion-target="#${id}"] svg`);
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    btn.classList.add('rotate-180');
                } else {
                    content.classList.add('hidden');
                    btn.classList.remove('rotate-180');
                }
            }
        </script>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <div class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-5 rounded-md">
                <div class="px-2 py-1 mb-4 flex items-center justify-between">
                    <p class="text-sm font-semibold">Daftar barang yang dijual</p>
                    <button type="button"
                        class="inline-flex items-center px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow transition duration-150"
                        onclick="window.location.href='{{ route('detail.mitra', ['id' => $mitra->id]) }}'">
                        + Tambah Produk
                    </button>

                </div>
                <div class="table-responsive">
                    <table id="productTable"
                        class="min-w-full border bg-white border-gray-300 rounded-lg shadow-sm dark:bg-transparent">
                        <thead class="bg-gray-100 dark:bg-transparent">
                            <tr>
                                <th
                                    class="border border-gray-300 px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-200 w-10 text-center">
                                    #</th>
                                <th
                                    class="border border-gray-300 px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-200 w-1/3">
                                    Nama Produk</th>
                                <th
                                    class="border border-gray-300 px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-200 text-center">
                                    Barang Keluar</th>
                                <th
                                    class="border border-gray-300 px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-200 text-center">
                                    Barang Terjual</th>
                                <th
                                    class="border border-gray-300 px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-200 text-center">
                                    Barang Retur</th>
                                <th
                                    class="border border-gray-300 px-3 py-2 text-xs font-semibold text-gray-700 dark:text-gray-200 text-center">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalSemua = 0;
                            @endphp
                            @forelse ($penawaran as $index => $row)
                                @php
                                    $barang_keluar = (int) ($row->barang_keluar ?? 0);
                                    $barang_terjual = (int) ($row->barang_terjual ?? 0);
                                    $barang_retur = (int) ($row->barang_retur ?? 0);
                                    $harga = (int) ($row->harga ?? 0);
                                    $total_barang_keluar = $barang_terjual + $barang_retur;
                                    $total = $barang_keluar * $harga;
                                    $totalSemua += $total;
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-black">
                                    <td class="border border-gray-300 px-3 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border border-gray-300 px-3 py-2">
                                        <button type="button"
                                            class="form-input w-full bg-gray-50 dark:bg-gray-800 border-gray-300 rounded-md text-left cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900"
                                            onclick="showProductDetail('{{ $row->produk->kode_produk }}')"
                                            style="padding: 0.5rem 0.75rem;">
                                            {{ $row->produk->nama_produk ?? '-' }}
                                        </button>
                                        <input type="hidden" name="kode_produk[]"
                                            value="{{ $row->produk->kode_produk }}">

                                        <!-- Modal for product detail -->
                                        <div id="modal-detail-{{ $row->produk->kode_produk }}"
                                            class="fixed inset-0 z-[99999] flex items-center justify-center hidden"
                                            style="z-index: 999999">
                                            <!-- Overlay -->
                                            <div class="absolute inset-0 bg-black/30"></div>
                                            <!-- Modal content -->
                                            <div
                                                class="relative bg-white  dark:bg-black border-b border-black/10 dark:border-white/10 items-center justify-between px-5 py-3 rounded-lg shadow-lg max-w-lg w-full p-6 z-10">
                                                <button type="button"
                                                    class="absolute top-2 right-2 text-gray-500 hover:text-red-600"
                                                    onclick="closeProductDetail('{{ $row->produk->kode_produk }}')">
                                                    &times;
                                                </button>
                                                <h3 class="text-lg font-bold mb-3">Detail Produk Penawran</h3>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                                    <div>
                                                        <table
                                                            class="table-auto border-collapse border border-gray-300 w-full text-sm">
                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-300 px-3 py-2 font-semibold">
                                                                        Kode Produk</td>
                                                                    <td class="border border-gray-300 px-3 py-2">
                                                                        {{ $row->produk->kode_produk }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-300 px-3 py-2 font-semibold">
                                                                        Nama Produk</td>
                                                                    <td class="border border-gray-300 px-3 py-2">
                                                                        {{ $row->produk->nama_produk ?? '-' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-300 px-3 py-2 font-semibold">
                                                                        Stok</td>
                                                                    <td class="border border-gray-300 px-3 py-2">
                                                                        {{ $row->produk->stok }} Pcs</td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-300 px-3 py-2 font-semibold">
                                                                        Harga</td>
                                                                    <td class="border border-gray-300 px-3 py-2">Rp.
                                                                        {{ number_format($row->harga ?? 0, 0, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                                <!-- Tambahkan detail lain sesuai kebutuhan -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="flex items-center justify-end">
                                                        <div
                                                            class="border border-gray-300 rounded-lg p-3 bg-gray-50 dark:bg-gray-800">
                                                            @if ($row->produk->gambar)
                                                                <img src="{{ asset('storage/' . $row->produk->gambar) }}"
                                                                    alt="Foto Produk"
                                                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                                            @else
                                                                <p class="text-gray-500 text-center">Foto produk tidak
                                                                    tersedia</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="mt-3 w-full sm:w-auto inline-flex items-center justify-center px-5 py-2 text-sm font-medium  bg-blue-600 hover:bg-blue-700 rounded-lg shadow transition duration-150  right-2 text-white hover:text-red-600"
                                                    onclick="closeProductDetail('{{ $row->produk->kode_produk }}')">
                                                    Oke
                                                </button>
                                            </div>
                                        </div>

                                        <script>
                                            function showProductDetail(kode) {
                                                document.getElementById('modal-detail-' + kode).classList.remove('hidden');
                                            }

                                            function closeProductDetail(kode) {
                                                document.getElementById('modal-detail-' + kode).classList.add('hidden');
                                            }
                                        </script>

                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <input type="number" name="barang_keluar[]"
                                            class="form-input w-20 text-center border-gray-300 rounded-md barang-keluar-input"
                                            value="{{ $barang_keluar }}" data-index="{{ $index }}"
                                            data-harga="{{ $harga }}">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <input type="number" name="barang_terjual[]"
                                            class="form-input w-20 text-center border-gray-300 rounded-md barang-terjual-input"
                                            value="{{ $barang_terjual }}" data-index="{{ $index }}">
                                          
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <input type="number" name="barang_retur[]"
                                            class="form-input w-20 text-center border-gray-300 rounded-md barang-retur-input"
                                            value="{{ $barang_retur }}" data-index="{{ $index }}">
                                    </td>
                                    <td class="border border-gray-300 px-3 py-2 text-center">
                                        <div class="flex items-center justify-center">
                                            <span class="mr-1">Rp.</span>
                                            <input type="text" name="harga[]"
                                                value="{{ number_format($total, 0, ',', '.') }}"
                                                class="form-input harga-input w-24 text-right border-gray-300 rounded-md total-harga-input"
                                                data-index="{{ $index }}" readonly>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="noDataRow">
                                    <td colspan="6" class="border border-gray-300 px-3 py-2 text-center text-gray-500">
                                        Belum ada
                                        produk yang ditawarkan.</td>
                                </tr>
                            @endforelse

                            <!-- Ongkir -->
                            <tr>
                                <td class="border border-gray-300 px-3 py-2"></td>
                                <td class="border border-gray-300 px-3 py-2 font-semibold text-right" colspan="4">
                                    Ongkir
                                </td>
                                <td class="border border-gray-300 px-3 py-2 text-center">
                                    <div class="flex items-center justify-center">
                                        <span class="mr-1">Rp.</span>
                                        <input type="text" name="ongkir" id="ongkir-input"
                                            class="form-input w-24 text-right border-gray-300 rounded-md" value="{{ $transaksi->ongkir ?? '0'}}">
                                    </div>
                                </td>
                            </tr>
                            <!-- Total -->
                            <tr>
                                <td class="border border-gray-300 px-3 py-2" colspan="4"></td>
                                <td class="border border-gray-300 px-3 py-2 font-semibold text-right">Total</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">
                                    <div class="flex items-center justify-center">
                                        <span class="mr-1">Rp.</span>
                                        <input type="text" name="total" id="total-input"
                                            class="form-input w-24 text-right border-gray-300 rounded-md"
                                            value="{{ $transaksi->total ?? number_format($totalSemua, 0, ',', '.') }}" readonly>
                                    </div>
                                </td>
                            </tr>
                            <!-- Discount -->
                            <tr>
                                <td class="border border-gray-300 px-3 py-2" colspan="4"></td>
                                <td class="border border-gray-300 px-3 py-2 font-semibold text-right">Discount</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">
                                    <div class="flex items-center justify-center">
                                        <span class="mr-1">Rp.</span>
                                        <input type="text" name="discount" id="discount-input"
                                            class="form-input w-24 text-right border-gray-300 rounded-md" value="{{ number_format($transaksi->diskon , 0, ',', '.') }}">
                                    </div>
                                </td>
                            </tr>
                            <!-- Grand Total -->
                            <tr>
                                <td class="border border-gray-300 px-3 py-2" colspan="4"></td>
                                <td class="border border-gray-300 px-3 py-2 font-bold text-right">Grand Total</td>
                                <td class="border border-gray-300 px-3 py-2 text-center font-bold">
                                    <div class="flex items-center justify-center">
                                        <span class="mr-1">Rp.</span>
                                        <input type="text" name="grand_total" id="grand-total-input"
                                            class="form-input w-24 text-right border-gray-300 rounded-md font-bold"
                                            value="{{ $transaksi->total ?? number_format($totalSemua, 0, ',', '.') }}" readonly>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2" colspan="4"></td>
                            <td class="border border-gray-300 px-3 py-2 font-semibold text-right">Status Bayar</td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <select name="status_bayar" id="status-bayar-input"
                                    class="form-input w-full text-center border-gray-300 rounded-md">
                                    <option value="Belum Bayar"
                                        {{ old('status_bayar', $transaksi->status_bayar ?? '') == 'Belum Bayar' ? 'selected' : '' }}>
                                        Belum Bayar</option>
                                    <option value="Sudah Bayar"
                                        {{ old('status_bayar', $transaksi->status_bayar ?? '') == 'Sudah Bayar' ? 'selected' : '' }}>
                                        Sudah Bayar</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-3 py-2" colspan="4"></td>
                            <td class="border border-gray-300 px-3 py-2 font-semibold text-right">Tanggal Bayar</td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                <input type="date" name="tanggal_bayar" id="tanggal-bayar-input"
                                    class="form-input w-full text-center border-gray-300 rounded-md"
                                    value="{{ old('tanggal_bayar', $transaksi->tanggal_pembayaran ?? '') }}">
                            </td>
                        </tr>
                    </table>


              <script>
                function formatRupiah(angka) {
                    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }

                function parseRupiah(str) {
                    return parseInt((str || '0').replace(/\./g, '').replace(/[^0-9]/g, '')) || 0;
                }

                function updateTotals() {
                    let total = 0;
                    document.querySelectorAll('.barang-keluar-input').forEach(function(input) {
                        const index = input.dataset.index;
                        const harga = parseInt(input.dataset.harga) || 0;
                        const jumlahKeluar = parseInt(input.value) || 0;

                        const barangTerjualInput = document.querySelector('.barang-terjual-input[data-index="' + index + '"]');
                        const barangReturInput = document.querySelector('.barang-retur-input[data-index="' + index + '"]');
                        const totalInput = document.querySelector('.total-harga-input[data-index="' + index + '"]');

                        let barangTerjual = parseInt(barangTerjualInput?.value) || 0;

                        // Batasi barang terjual maksimal ke barang keluar
                        if (barangTerjual > jumlahKeluar) {
                            barangTerjual = jumlahKeluar;
                            if (barangTerjualInput) {
                                barangTerjualInput.value = barangTerjual;
                            }
                        }

                        // Hitung barang retur
                        const barangRetur = jumlahKeluar - barangTerjual;

                        if (barangReturInput) {
                            barangReturInput.value = barangRetur;
                        }

                        // Hitung total per baris berdasarkan kondisi
                        let totalRow = 0;
                        if (barangTerjual > 0) {
                            totalRow = barangTerjual * harga; // Jika barang terjual ada, hitung berdasarkan terjual
                        } else {
                            totalRow = jumlahKeluar * harga; // Jika tidak ada, hitung berdasarkan keluar
                        }

                        if (totalInput) {
                            totalInput.value = formatRupiah(totalRow);
                        }

                        // Tambah ke total keseluruhan
                        total += totalRow;
                    });

                    // Update total keseluruhan
                    const totalInput = document.getElementById('total-input');
                    if (totalInput) {
                        totalInput.value = formatRupiah(total);
                    }

                    // Ambil ongkir & diskon
                    const ongkir = parseRupiah(document.getElementById('ongkir-input')?.value);
                    const discount = parseRupiah(document.getElementById('discount-input')?.value);
                    const grandTotal = total + ongkir - discount;

                    // Update grand total
                    const grandTotalInput = document.getElementById('grand-total-input');
                    if (grandTotalInput) {
                        grandTotalInput.value = formatRupiah(grandTotal);
                    }
                }

                document.addEventListener('DOMContentLoaded', function() {
                    // Format harga awal saat halaman dimuat
                    document.querySelectorAll('.total-harga-input').forEach(function(input) {
                        input.value = formatRupiah(parseRupiah(input.value));
                    });

                    // Event listener barang keluar
                    document.querySelectorAll('.barang-keluar-input').forEach(function(input) {
                        input.addEventListener('input', function() {
                            updateTotals();
                        });
                    });

                    // Event listener barang terjual
                    document.querySelectorAll('.barang-terjual-input').forEach(function(input) {
                        input.addEventListener('input', function() {
                            const index = this.dataset.index;
                            const barangKeluar = parseInt(document.querySelector('.barang-keluar-input[data-index="' + index + '"]')?.value) || 0;

                            // Batasi barang terjual maksimal sesuai barang keluar
                            if (parseInt(this.value) > barangKeluar) {
                                this.value = barangKeluar;
                            }

                            updateTotals();
                        });
                    });

                    // Event listener ongkir
                    const ongkirInput = document.getElementById('ongkir-input');
                    if (ongkirInput) {
                        ongkirInput.addEventListener('input', function() {
                            this.value = formatRupiah(parseRupiah(this.value));
                            updateTotals();
                        });
                    }

                    // Event listener diskon
                    const discountInput = document.getElementById('discount-input');
                    if (discountInput) {
                        discountInput.addEventListener('input', function() {
                            this.value = formatRupiah(parseRupiah(this.value));
                            updateTotals();
                        });
                    }

                    // Jalankan update totals pertama kali saat halaman selesai dimuat
                    updateTotals();
                });

            </script>


                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 mt-6 justify-between">
            <button type="submit"
                class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow transition duration-150">
                Simpan Data
            </button>


            <div class="flex flex-wrap gap-3">
                <a href="{{ route('transaksi.konsinyasi', ['id' => $transaksi->kode_transaksi, 'type' => 'konsinyasi']) }}"
                    target="_BLANK"
                    class="inline-flex items-center px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow transition duration-150"
                    id="btn-konsinyasi"
                    disabled>
                    Buat Nota Konsinyasi
                    </a> 
                <a href="{{ route('transaksi.kwitansi',['id' => $transaksi->kode_transaksi,'type'=>'invoice']) }}" target="_BLANK"
                    class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow transition duration-150"
                    id="btn-invoice"
                    @php
                $adaTerjual = false;
                foreach($penawaran as $row) {
                    if(($row->barang_terjual ?? 0) > 0) { $adaTerjual = true; break; }
                } @endphp
                    @if (!$adaTerjual) disabled style="opacity:0.5;pointer-events:none;" @endif>
                    Buat Invoice
                </a>
                <a href="{{ route('transaksi.invoce',['id' => $transaksi->kode_transaksi,'type'=>'kwitansi']) }}" target="_BLANK"
                    class="inline-flex items-center px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-lg shadow transition duration-150"
                    id="btn-kwitansi2"
                    @if ($transaksi->status_bayar === 'Belum Bayar') 
                        disabled style="opacity:0.5; pointer-events:none;" 
                    @endif>
                    Buat Kwitansi
                </a>
            </div>
        </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    function updateButtons() {
        const status = document.getElementById('status-bayar-input')?.value;  // Status bayar input
        const tanggal = document.getElementById('tanggal-bayar-input')?.value;  // Tanggal bayar input
        const btnKwitansi = document.getElementById('btn-kwitansi');  // Tombol Kwitansi
        const btnKwitansi2 = document.getElementById('btn-kwitansi2');  // Tombol Kwitansi2
        const btnKonsinyasi = document.getElementById('btn-konsinyasi');  // Tombol Konsinyasi

        // Tombol Kwitansi dan Kwitansi2
        if (!status || !tanggal) {
            // Jika status atau tanggal belum ada, disable kedua tombol
            
            btnKwitansi2.setAttribute('disabled', true);
            btnKwitansi2.style.opacity = 0.5;
            btnKwitansi2.style.pointerEvents = 'none';
        } else if (status === 'Sudah Bayar') {
          

            btnKwitansi2.removeAttribute('disabled');
            btnKwitansi2.style.opacity = 1;
            btnKwitansi2.style.pointerEvents = '';
        } else {
       

            btnKwitansi2.setAttribute('disabled', true);
            btnKwitansi2.style.opacity = 0.5;
            btnKwitansi2.style.pointerEvents = 'none';
        }

        // Tombol Konsinyasi (aktif jika ada barang terjual yang diisi)
        let adaTerjual = false;
        document.querySelectorAll('.barang-terjual-input').forEach(function(input) {
            if (parseInt(input.value) > 0) adaTerjual = true;  // Jika ada barang yang terjual
        });

        if (adaTerjual) {
            btnKonsinyasi.removeAttribute('disabled');  // Menghapus disabled pada tombol Konsinyasi
            btnKonsinyasi.style.opacity = 1;  // Mengatur opacity ke normal
            btnKonsinyasi.style.pointerEvents = '';  // Mengizinkan interaksi
        } else {
            btnKonsinyasi.setAttribute('disabled', true);  // Menonaktifkan tombol Konsinyasi
            btnKonsinyasi.style.opacity = 0.5;  // Mengatur opacity agar terlihat dinonaktifkan
            btnKonsinyasi.style.pointerEvents = 'none';  // Menonaktifkan pointer events
        }

        
        // Tombol Konsinyasi (aktif jika ada barang keluar yang diisi)
        const barangKeluarInput = document.querySelectorAll('.barang-keluar-input');
        let barangKeluarTerisi = false;

        // Pengecekan jika ada barang keluar yang diisi
        barangKeluarInput.forEach(function(input) {
            if (parseInt(input.value) > 0) barangKeluarTerisi = true;  // Jika ada barang keluar terisi
        });

        if (barangKeluarTerisi) {
            btnKonsinyasi.removeAttribute('disabled');  // Menghapus disabled pada tombol Konsinyasi
            btnKonsinyasi.style.opacity = 1;  // Mengatur opacity ke normal
            btnKonsinyasi.style.pointerEvents = '';  // Mengizinkan interaksi
        } else {
            btnKonsinyasi.setAttribute('disabled', true);  // Menonaktifkan tombol Konsinyasi
            btnKonsinyasi.style.opacity = 0.5;  // Mengatur opacity agar terlihat dinonaktifkan
            btnKonsinyasi.style.pointerEvents = 'none';  // Menonaktifkan pointer events
        }

        // Tombol Invoice (hanya aktif jika ada barang terjual)
        let adaBarangTerjual = false;
        document.querySelectorAll('.barang-terjual-input').forEach(function(input) {
            if (parseInt(input.value) > 0) adaBarangTerjual = true;
        });
        const btnInvoice = document.getElementById('btn-invoice');
        if (!adaBarangTerjual) {
            btnInvoice.setAttribute('disabled', true);
            btnInvoice.style.opacity = 0.5;
            btnInvoice.style.pointerEvents = 'none';
        } else {
            btnInvoice.removeAttribute('disabled');
            btnInvoice.style.opacity = 1;
            btnInvoice.style.pointerEvents = '';
        }
    }

    // Event listener ketika status bayar berubah
    document.getElementById('status-bayar-input')?.addEventListener('change', updateButtons);

    // Event listener untuk input tanggal bayar dan barang terjual
    document.getElementById('tanggal-bayar-input')?.addEventListener('input', updateButtons);
    document.querySelectorAll('.barang-terjual-input').forEach(function(input) {
        input.addEventListener('input', updateButtons);  // Pengecekan setiap kali input barang terjual berubah
    });

    // Inisialisasi tombol saat halaman dimuat
    updateButtons();
});

  </script>
  </form>
@endsection
