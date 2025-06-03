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
    </style>
    <form action="{{ route('update.mitra') }}" method="POST">
        @csrf
        <div class="px-2 py-1 mb-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold">Detail Mitra / Toko</h2>
            <div class="flex flex-col sm:flex-row gap-2">
            <button type="submit"
                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow transition duration-150">
                Simpan
            </button>

            <button type="button" onclick="confirmDelete('{{ route('mitra.delete', $mitra->id) }}')"
                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow transition duration-150">
                Hapus
            </button>

            <button type="button" onclick="checkTransaction('{{ route('transaksi.detail', $mitra->transaksi->id) }}')"
                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow transition duration-150">
                Lakukan Transaksi
            </button>

            <script>
                function checkTransaction(url) {
                    @if ($mitra->transaksi == null)
                        window.location.href = "{{ route('transaksi.index') }}";
                    @else
                        Swal.fire({
                            title: 'Transaksi sudah ada',
                            text: 'Apakah Anda ingin melanjutkan transaksi yang ada?',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, lanjutkan transaksi',
                            cancelButtonText: 'Batal',
                            customClass: {
                                confirmButton: 'bg-green-600 hover:bg-green-700 text-white px-4 py-1.5 rounded-lg mx-2 focus:outline-none',
                                cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-1.5 rounded-lg mx-2 focus:outline-none'
                            },
                            buttonsStyling: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = url;
                            }
                        });
                    @endif
                }
            </script>
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
                    confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-lg mx-2 focus:outline-none',
                    cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-1.5 rounded-lg mx-2 focus:outline-none'
                },
                buttonsStyling: false
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
                });
            }

            function redirectToTransaction(url) {
                window.location.href = url;
            }
            </script>
        </div>

        <div class="grid grid-cols-1 gap-7 lg:grid-cols-2">
            <div>
                <input type="text" name="id" value="{{ $mitra->id }}" hidden>
                <div class="space-y-4">
                    <!-- Mita -->
                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                            Kode Mitra
                        </label>
                        <input type="text" placeholder="Kode Mitra" class="form-input" name="kode_mitra" id="kode_mitra"
                            value="{{ $mitra->kode_mitra }}" readonly />
                    </div>

                    <!-- Nama Mitra -->
                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                            Nama Mitra / Toko
                        </label>
                        <input type="text" placeholder="Nama Mitra atau Toko" class="form-input" name="nama_mitra"
                            id="nama_mitra" value="{{ $mitra->nama_mitra }}" />
                    </div>
                    <!-- Telp Mitra -->
                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                            Nomor Telepon Mitra
                        </label>
                        <input type="text" placeholder="Nomor Telepon" class="form-input" name="no_telp_mitra"
                            id="no_telp_mitra" value="{{ $mitra->no_telp_mitra }}" />
                    </div>
                    <!-- Alamat -->
                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                            Alamat Mitra/Toko
                        </label>
                        <textarea type="text" class="form-input" placeholder="Alamat Mitra" name="alamat_mitra">{{ $mitra->alamat_mitra }}</textarea>
                    </div>

                    <!-- Provinsi -->

                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                            Kota
                        </label>
                        <input type="text" id="kota-input" name="id_kota" placeholder="Masukan Nama Kota Mitra "
                            class="form-input" oninput="showRecommendations()" value="{{ $mitra->id_kota }}" />
                        <!-- Dropdown for Recommendations -->
                        <ul id="kota-recommendations"
                            class="absolute w-full mt-1 bg-white dark:bg-dark  dark:border-white/10 p-5  border border-gray-200  shadow-lg hidden max-h-40 overflow-y-auto z-10">
                            <!-- Data recommendations will be injected here -->
                        </ul>

                    </div>
                    <div class="border border-black/10 dark:border-white/10 p-5 rounded-md">
                        <p class="text-sm font-semibold mb-3">Titik Lokasi</p>
                        <div class="mb-4">
                            <label class="block mb-1">Tempel Link Google Maps</label>
                            <input type="text" id="gmaps-link" placeholder="Paste link Google Maps di sini"
                                class="form-input w-full py-4">
                        </div>

                        <div class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-2">
                            <!-- First Input Field -->
                            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                                    Longitude
                                </label>
                                <input type="text" placeholder="Longitude" class="form-input w-full" name="longitude"
                                    id="longitude" value="{{ $mitra->longitude }}" />
                            </div>

                            <!-- Second Input Field -->
                            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                                    Latitude
                                </label>
                                <input type="text" placeholder="latitude" class="form-input w-full" name="latitude"
                                    id="latitude" value="{{ $mitra->latitude }}" />
                            </div>

                        </div>

                    </div>
                    <!-- Submit Button -->
                    <div>

                    </div>
                </div>
            </div>
            <div>
                <div class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-5 rounded-md">
                    <div class="px-2 py-1 mb-4 flex items-center justify-between">
                        <p class="text-sm font-semibold">Daftar barang yang dijual</p>

                        <button type="button"
                            class="btn py-2 px-5 text-[15px]"
                            onclick="addRow()">
                            + Tambah Produk
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="productTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="80%">Nama Produk</th>
                                    <th>Harga Penawaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($penawaran as $index => $row)
                                    <tr>
                                        <td class="row-number">{{ $index + 1 }}</td>
                                        <td>
                                            <select class="select2 w-full" name="kode_produk[]"
                                                onchange="updateHarga(this)">
                                                <option value="">Pilih Produk</option>
                                                @foreach ($produk as $item)
                                                    <option value="{{ $item->kode_produk }}"
                                                        data-harga="{{ $item->harga }}" @selected($item->kode_produk == $row->kode_produk)>
                                                        {{ $item->nama_produk }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            Rp.
                                            <input type="text" name="harga[]"
                                                value="{{ number_format($row->harga, 0, ',', '.') }}"
                                                oninput="formatCurrency(this)" class="form-input harga-input">
                                        </td>
                                        <td><button type="button" class="text-red-600 hover:text-red-800"
                                                onclick="removeRow(this)" data-id="{{ $row->id }}">Hapus</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="noDataRow">
                                        <td colspan="4" class="text-center text-gray-500">Belum ada produk yang
                                            ditawarkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <template id="rowTemplate">
        <tr>
            <td class="row-number">1</td>
            <td class="w-1/2">
                <select class="produk select2 w-full p-2 border border-gray-300 rounded-md" name="kode_produk[]"
                    onchange="updateHarga(this)">
                    <option value="" selected>Pilih Produk</option>
                    @foreach ($produk as $item)
                        <option value="{{ $item->kode_produk }}" data-harga="{{ $item->harga }}">
                            {{ $item->nama_produk }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                Rp.
                <input type="text" name="harga[]" placeholder="Harga" oninput="formatCurrency(this)"
                    class="form-input harga-input py-2.5 px-4 w-full text-black border border-black/10 rounded-lg">
            </td>
            <td>
                <button type="button" class="text-red-600 hover:text-red-800" onclick="removeRow(this)">
                    Hapus
                </button>
            </td>
        </tr>
    </template>

    <script>
        function addRow() {
            const tableBody = document.querySelector('#productTable tbody');
            const noDataRow = document.querySelector('#noDataRow');
            const template = document.querySelector('#rowTemplate');
            const newRow = template.content.cloneNode(true);

            // Hapus pesan "Belum ada produk..." jika ada
            if (noDataRow) noDataRow.remove();

            tableBody.appendChild(newRow);
            updateRowNumbers();

            // Inisialisasi select2 pada elemen baru
            $(tableBody.querySelectorAll('select.select2')).select2();
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();

            updateRowNumbers();

            // Jika tidak ada baris, tampilkan pesan kosong
            const tableBody = document.querySelector('#productTable tbody');
            if (tableBody.rows.length === 0) {
                tableBody.innerHTML = `
                <tr id="noDataRow">
                    <td colspan="4" class="text-center text-gray-500">Belum ada produk yang ditawarkan.</td>
                </tr>
            `;
            }
        }

        function updateRowNumbers() {
            const rows = document.querySelectorAll('#productTable tbody tr');
            let number = 1;
            rows.forEach((row) => {
                const numberCell = row.querySelector('.row-number');
                if (numberCell) numberCell.innerText = number++;
            });
        }

        function formatCurrency(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            value = new Intl.NumberFormat('id-ID').format(value);
            input.value = value;
        }

        function updateHarga(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');

            const row = selectElement.closest('tr');
            const hargaInput = row.querySelector('.harga-input');

            if (hargaInput && harga) {
                hargaInput.value = new Intl.NumberFormat('id-ID').format(harga);
            } else if (hargaInput) {
                hargaInput.value = '';
            }
        }

        // Inisialisasi awal
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>



    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
            if (value) {
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Add thousand separators
            }
            input.value = value;
        }
    </script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 pada input kota
            $('.produk').select2({
                placeholder: 'Pilih Produk',
                width: '100%',
            });
        });
    </script>
    <script>
        const kotaData = @json($kota);

        async function showRecommendations() {
            const input = document.getElementById('kota-input');
            const dropdown = document.getElementById('kota-recommendations');
            const query = input.value.toLowerCase();

            const filteredKota = kotaData.filter(kota =>
                kota.name.toLowerCase().includes(query)
            );

            dropdown.innerHTML = '';

            if (filteredKota.length > 0 && query !== '') {
                dropdown.classList.remove('hidden');

                filteredKota.forEach(kota => {
                    const li = document.createElement('li');
                    li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                    li.textContent = kota.name;

                    li.onclick = function() {
                        input.value = kota.name;
                        dropdown.classList.add('hidden');
                    };

                    dropdown.appendChild(li);
                });
            } else {
                dropdown.classList.add('hidden');
            }
        }

        document.getElementById('kota-input').addEventListener('input', showRecommendations);

        document.addEventListener('click', function(event) {
            const input = document.getElementById('kota-input');
            const dropdown = document.getElementById('kota-recommendations');
            if (!input.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

    <script>
        function removeRow(button) {
            const row = button.closest('tr');
            const penawaranId = button.getAttribute('data-id');

            if (penawaranId) {
                // Hapus dari database via API
                fetch(`/mitra/produk/delete/${penawaranId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            row.remove();
                            renumberRows();
                            // Optional: tampilkan pesan sukses singkat tanpa konfirmasi
                            console.log('Data penawaran telah dihapus.');
                        } else {
                            alert('Gagal menghapus data.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus.');
                    });
            } else {
                // Baris belum disimpan di DB, hapus langsung di UI
                row.remove();
                renumberRows();
            }
        }



        function renumberRows() {
            document.querySelectorAll('#productTable tbody tr .row-number').forEach((td, index) => {
                td.textContent = index + 1;
            });
        }
    </script>
    <script>
        document.getElementById('gmaps-link').addEventListener('input', function() {
            const url = this.value;

            // Tangkap koordinat dari !3dLAT!4dLNG dengan angka desimal penuh
            const regex_3d4d = /!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/;
            // Fallback dari @LAT,LNG
            const regex_at = /@(-?\d+\.\d+),(-?\d+\.\d+)/;

            let lat = null;
            let lng = null;

            const match3d4d = url.match(regex_3d4d);
            if (match3d4d) {
                lat = parseFloat(match3d4d[1]);
                lng = parseFloat(match3d4d[2]);
            } else {
                const matchAt = url.match(regex_at);
                if (matchAt) {
                    lat = parseFloat(matchAt[1]);
                    lng = parseFloat(matchAt[2]);
                }
            }

            if (lat && lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            } else {
                console.warn("Koordinat tidak ditemukan.");
                // alert("Link Google Maps tidak valid atau tidak mengandung koordinat.");
            }
        });
    </script>



@endsection
