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
    <h2 class="mb-3 text-lg font-semibold">Detail Mitra / Toko </h2>
    <div class="grid grid-cols-1 gap-7 lg:grid-cols-2">
        <div>
            <form action="#" method="POST">
                <div class="space-y-4">
                    <!-- Mita -->
                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                            Kode Mitra
                        </label>
                        <input type="text" placeholder="Kode Mitra" class="form-input" />
                    </div>

                    <!-- Nama Mitra -->
                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                            Nama Mitra / Toko
                        </label>
                        <input type="text" placeholder="Nama Mitra atau Toko" class="form-input" />
                    </div>

                    <!-- Alamat -->
                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                            Alamat Mitra/Toko
                        </label>
                        <textarea type="text" class="form-input" placeholder="Mita"></textarea>
                    </div>

                    <!-- Provinsi -->

                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                            Kota
                        </label>
                        <input type="text" id="kota-input" placeholder="Masukan Nama Kota Mitra " class="form-input"
                            oninput="showRecommendations()" />
                        <!-- Dropdown for Recommendations -->
                        <ul id="kota-recommendations"
                            class="absolute w-full mt-1 bg-white dark:bg-dark  dark:border-white/10 p-5  border border-gray-200  shadow-lg hidden max-h-40 overflow-y-auto z-10">
                            <!-- Data recommendations will be injected here -->
                        </ul>

                    </div>
                    <div class="border border-black/10 dark:border-white/10 p-5 rounded-md">
                        <p class="text-sm font-semibold mb-3">Titik Lokasi</p>
                        <div class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-2">
                            <!-- First Input Field -->
                            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                                    Longitude
                                </label>
                                <input type="text" placeholder="longtitutde" class="form-input w-full" />
                            </div>

                            <!-- Second Input Field -->
                            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">
                                    Latitude
                                </label>
                                <input type="text" placeholder="lantitude" class="form-input w-full" />
                            </div>
                        </div>
                    </div>



                    <!-- Submit Button -->
                    <div>

                    </div>
                </div>
            </form>
        </div>
        <div>
            <div class="p-5 bg-lightwhite border border-black/10 rounded-md dark:bg-white/5 dark:border-white/10">
                <div class="px-2 py-1 mb-4 flex items-center justify-between">
                    <p class="text-sm font-semibold">Daftar barang yang Dijual</p>
                    <button class="px-2 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition"
                        onclick="addRow()">
                        + Tambah
                    </button>
                </div>

                <div class="table-responsive">
                    <table id="productTable" class="table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga yang ditawarkan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Baris pertama (akan diulang dengan data dinamis) -->
                            <tr>
                                <td><div class="border border-black/10 text-black dark:text-white dark:border-white/10 rounded-md h-10 w-10 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path>
                                    </svg>
                                </div></td>
                                <td class="w-1/2">
                                    <select id="my-select" class="select2 w-full p-2 border border-gray-300 rounded-md">
                                        <option value=""  disabled selected>Nama Produk</option>
                                        <option value="1">Keripik PIsang 100g</option>
                                        <option value="2">Keripik Tape 100g</option>
                                        <option value="3">Keripik Salak 100g</option>
                                        <option value="4">Keripik Nangka 100g</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" placeholder="Harga"  oninput="formatCurrency(this)" 
                                        class="form-input py-2.5 px-4 w-full text-black dark:text-white border border-black/10 dark:border-white/10 rounded-lg">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
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
            $('.select2').select2({
                placeholder: 'Pilih Produk',
                width: '100%',
                

            });
        });
    </script>
    <script>
        // Mengambil data kota dari PHP (menggunakan compact('kota'))
        const kotaData = @json($kota);

        // Fungsi untuk menampilkan rekomendasi kota berdasarkan input
        async function showRecommendations() {
            const input = document.getElementById('kota-input');
            const dropdown = document.getElementById('kota-recommendations');
            const query = input.value.toLowerCase();

            // Filter data kota berdasarkan input
            const filteredKota = kotaData.filter(kota => kota.toLowerCase().includes(query));

            // Clear previous recommendations
            dropdown.innerHTML = '';

            // Menampilkan rekomendasi jika ada hasil pencarian
            if (filteredKota.length > 0 && query !== '') {
                dropdown.classList.remove('hidden');

                filteredKota.forEach(kota => {
                    const li = document.createElement('li');
                    li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-100');
                    li.textContent = kota;

                    li.onclick = function() {
                        input.value = kota;
                        dropdown.classList.add('hidden');
                    };

                    dropdown.appendChild(li);
                });
            } else {
                dropdown.classList.add('hidden');
            }
        }

        // Menambahkan event listener untuk input
        document.getElementById('kota-input').addEventListener('input', showRecommendations);

        // Menutup dropdown jika klik di luar
        document.addEventListener('click', function(event) {
            const input = document.getElementById('kota-input');
            const dropdown = document.getElementById('kota-recommendations');
            if (!input.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
@endsection
