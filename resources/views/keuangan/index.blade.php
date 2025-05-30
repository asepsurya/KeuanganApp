@extends('layout.main')
@section('title', 'Data Keuangan')
@section('container')
    <div class="mb-4">
        <p class="text-lg font-bold">Pengelola Keuangan</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-7 mb-4">
        <div class="bg-lightblue-100 rounded-2xl p-6">
            <p class="text-sm font-semibold text-black mb-2">Pemasukan</p>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl leading-9 font-semibold text-black">Rp.3.000.000</h2>
                <div class="flex items-center gap-1">
                    <p class="text-xs leading-[18px] text-black">+11.01%</p>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.45488 5.60777L14 4L12.6198 9.6061L10.898 7.9532L8.12069 10.8463C8.02641 10.9445 7.89615 11 7.76 11C7.62385 11 7.49359 10.9445 7.39931 10.8463L5.36 8.72199L2.36069 11.8463C2.16946 12.0455 1.85294 12.0519 1.65373 11.8607C1.45453 11.6695 1.44807 11.3529 1.63931 11.1537L4.99931 7.65373C5.09359 7.55552 5.22385 7.5 5.36 7.5C5.49615 7.5 5.62641 7.55552 5.72069 7.65373L7.76 9.77801L10.1766 7.26067L8.45488 5.60777Z"
                            fill="#1C1C1C"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-lightpurple-100 rounded-2xl p-6">
            <p class="text-sm font-semibold text-black mb-2">Pengeluaran</p>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl leading-9 font-semibold text-black">Rp.1.000.000</h2>
                <div class="flex items-center gap-1">
                    <p class="text-xs leading-[18px] text-black">+9.15%</p>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.45488 5.60777L14 4L12.6198 9.6061L10.898 7.9532L8.12069 10.8463C8.02641 10.9445 7.89615 11 7.76 11C7.62385 11 7.49359 10.9445 7.39931 10.8463L5.36 8.72199L2.36069 11.8463C2.16946 12.0455 1.85294 12.0519 1.65373 11.8607C1.45453 11.6695 1.44807 11.3529 1.63931 11.1537L4.99931 7.65373C5.09359 7.55552 5.22385 7.5 5.36 7.5C5.49615 7.5 5.62641 7.55552 5.72069 7.65373L7.76 9.77801L10.1766 7.26067L8.45488 5.60777Z"
                            fill="#1C1C1C"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-lightblue-100 rounded-2xl p-6">
            <p class="text-sm font-semibold text-black mb-2">Laba Bersih</p>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl leading-9 font-semibold text-black">Rp.2.000.000</h2>
                <div class="flex items-center gap-1">
                    <p class="text-xs leading-[18px] text-black">+9.15%</p>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.45488 5.60777L14 4L12.6198 9.6061L10.898 7.9532L8.12069 10.8463C8.02641 10.9445 7.89615 11 7.76 11C7.62385 11 7.49359 10.9445 7.39931 10.8463L5.36 8.72199L2.36069 11.8463C2.16946 12.0455 1.85294 12.0519 1.65373 11.8607C1.45453 11.6695 1.44807 11.3529 1.63931 11.1537L4.99931 7.65373C5.09359 7.55552 5.22385 7.5 5.36 7.5C5.49615 7.5 5.62641 7.55552 5.72069 7.65373L7.76 9.77801L10.1766 7.26067L8.45488 5.60777Z"
                            fill="#1C1C1C"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="p-2 bg-lightwhite dark:bg-white/5 rounded-lg flex gap-2 justify-between mb-2">
        <div class="flex items-center gap-4">
            <div class="flex gap-2 items-center">
                <!-- Modal Tambah Akun Baru -->
                <div x-data="{ open: false }">
                    <button type="button" @click="open = !open"
                        class="px-2 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        + Tambah Catatan Baru
                    </button>

                    <!-- Overlay -->
                    <div class="fixed inset-0 bg-black/60 dark:bg-white/10 z-[999] hidden overflow-y-auto"
                        :class="{ 'block': open, 'hidden': !open }">
                        <div class="flex items-center justify-center min-h-screen px-4" @click.self="open = false">
                            <!-- Modal Box -->
                            <div x-show="open" x-transition x-transition.duration.300
                                class="bg-white dark:bg-black relative shadow-3xl border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8"
                                style="display: none;">
                                <!-- Header -->
                                <div
                                    class="flex bg-white dark:bg-black border-b border-black/10 dark:border-white/10 items-center justify-between px-5 py-3">
                                    <h5 class="font-semibold text-lg">Tambah Akun Baru</h5>
                                    <button type="button"
                                        class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white"
                                        @click="open = false">
                                        <svg class="w-5 h-5" width="32" height="32" viewBox="0 0 32 32"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M24.2929 6.29289L6.29289 24.2929C6.10536 24.4804 6 24.7348 6 25C6 25.2652 6.10536 25.5196 6.29289 25.7071C6.48043 25.8946 6.73478 26 7 26C7.26522 26 7.51957 25.8946 7.70711 25.7071L25.7071 7.70711C25.8946 7.51957 26 7.26522 26 7C26 6.73478 25.8946 6.48043 25.7071 6.29289C25.5196 6.10536 25.2652 6 25 6C24.7348 6 24.4804 6.10536 24.2929 6.29289Z"
                                                fill="currentcolor" />
                                            <path
                                                d="M7.70711 6.29289C7.51957 6.10536 7.26522 6 7 6C6.73478 6 6.48043 6.10536 6.29289 6.29289C6.10536 6.48043 6 6.73478 6 7C6 7.26522 6.10536 7.51957 6.29289 7.70711L24.2929 25.7071C24.4804 25.8946 24.7348 26 25 26C25.2652 26 25.5196 25.8946 25.7071 25.7071C25.8946 25.5196 26 25.2652 26 25C26 24.7348 25.8946 24.4804 25.7071 24.2929L7.70711 6.29289Z"
                                                fill="currentcolor" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    isi
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Box -->
                <div x-data="{ open: false }" class="flex items-center space-x-3">
                    <button @click="open = !open" type="button"
                        class="p-1 rounded-lg bg-transparent hover:bg-black/5 dark:hover:bg-white/5 transition-all duration-300">
                        <i class="fas fa-search text-base"></i>
                    </button>

                    <div x-show="open" class="transition-all duration-300">
                        <input type="text" placeholder="Cari Nama Transaksi...."
                            class="w-full form-input !rounded-full py-2.5 px-4 text-black dark:text-white border border-black/10 dark:border-white/10 placeholder:text-black/20 dark:placeholder:text-white/20 focus:border-black dark:focus:border-white focus:ring-0 focus:shadow-none" />
                    </div>
                </div>
            </div>

        </div>
        <div class="flex items-center gap-2">
            <label for="tanggal" class="text-sm">Tanggal:</label>
            <input type="date" id="tanggal"
                class="form-input py-2.5 px-4 w-full text-black dark:text-white border border-black/10 dark:border-white/10 rounded-lg placeholder:text-black/20 dark:placeholder:text-white/20 focus:border-black dark:focus:border-white/10 focus:ring-0 focus:shadow-none;" />
        </div>
    </div>
    <div class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-2 rounded-md">

        <div class="table-responsive">
            <table class="w-full border-collapse text-sm table-auto" id="produkTable">

                <thead class=" lg:table-header-group">
                    <tr class="text-gray-400">
                        <th width="70%" class="text-left  font-normal ">18 Mei 2025 - Minggu</th>
                        <th class="text-left ">
                            <div class="flex flex-col lg:flex-row gap-4  text-gray-600">
                                <div>Pemasukan:<span class="text-green-600"> Rp 2.000.000</span></div>
                                <div>Pengeluaran: <span class="text-red-600"> Rp 2.000.000</span></div>
                            </div>
                        </th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50">
                        <!-- Produk -->
                        <td class="py-4 pl-6 flex items-start gap-3">
                            <div class="flex flex-col">
                                <span class="font-semibold leading-tight">
                                    <a href="http://127.0.0.1:8000/produk/update/1">Keripik Tape 100g</a>
                                </span>
                                <span class="text-gray-400 leading-tight truncate max-w-[50px]">
                                    Keripik Tape Enak dan Renyah
                                </span>

                            </div>
                        </td>
                        <!-- Kolom desktop (disembunyikan di mobile) -->
                        <td class="py-4 font-semibold mobile lg:table-cell">Rp. 15.000</td>

                    </tr>
                    <tr class="hover:bg-gray-50">
                        <!-- Produk -->
                        <td class="py-4 pl-6 flex items-start gap-3">
                            <div class="flex flex-col">
                                <span class="font-semibold leading-tight">
                                    <a href="http://127.0.0.1:8000/produk/update/1">Keripik Tape 100g</a>
                                </span>
                                <span class="text-gray-400 leading-tight truncate max-w-[50px]">
                                    Keripik Tape Enak dan Renyah
                                </span>

                            </div>
                        </td>
                        <!-- Kolom desktop (disembunyikan di mobile) -->
                        <td class="py-4 font-semibold mobile lg:table-cell">Rp. 15.000</td>

                    </tr>
                </tbody>

                <thead class=" lg:table-header-group">
                    <tr class="text-gray-400">
                        <th width="70%" class="text-left  font-normal ">18 Mei 2025 - Sabtu</th>
                        <th class="text-left ">
                            <div class="flex flex-col lg:flex-row gap-4  text-gray-600">
                                <div>Pemasukan:<span class="text-green-600"> Rp 2.000.000</span></div>
                                <div>Pengeluaran: <span class="text-red-600"> Rp 2.000.000</span></div>
                            </div>
                        </th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50">
                        <!-- Produk -->
                        <td class="py-4 pl-6 flex items-start gap-3">
                            <div class="flex flex-col">
                                <span class="font-semibold leading-tight">
                                    <a href="http://127.0.0.1:8000/produk/update/1">Keripik Tape 100g</a>
                                </span>
                                <span class="text-gray-400 leading-tight truncate max-w-[50px]">
                                    Keripik Tape Enak dan Renyah
                                </span>

                            </div>
                        </td>

                        <!-- Kolom desktop (disembunyikan di mobile) -->

                        <td class="py-4 font-semibold mobile lg:table-cell">Rp. 15.000</td>

                    </tr>
                </tbody>
            </table>


        </div>
    </div>

@endsection
