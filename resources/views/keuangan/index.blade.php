@extends('layout.main')
@section('title', 'Data Keuangan')
@section('container')
<style>
    .select2-container--default .select2-selection--single {
        margin-left: -10px;
        border: none;
    }

    .dark .select2-container--default .select2-selection--single {
        background-color: rgba(0, 0, 0, 0);
        margin-left: -10px;
        border: none;
    }
</style>
    <div class="mb-4">
        <p class="text-lg font-bold">Pengelola Keuangan</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-7 mb-4">
        <div class="bg-lightblue-100 rounded-2xl p-6">
            <p class="text-sm font-semibold text-black mb-2">Pemasukan</p>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl leading-9 font-semibold text-black">
                     @php
                            $totalPemasukan = $transaksi->where('tipe', 'pemasukan')->sum('total');
                        @endphp
                        Rp.{{ number_format($totalPemasukan, 0, ',', '.') }}
                </h2>
                <div class="flex items-center gap-1">
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
                <h2 class="text-2xl leading-9 font-semibold text-black">
                     @php
                            $totalPemasukan = $transaksi->where('tipe', 'pengeluaran')->sum('total');
                        @endphp
                        Rp.{{ number_format($totalPemasukan, 0, ',', '.') }}
                </h2>
                <div class="flex items-center gap-1">
                
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.54512 10.3922L2 12L3.3802 6.3939L5.10201 8.0468L7.87931 5.1537C7.97359 5.05548 8.10385 5 8.24 5C8.37615 5 8.50641 5.05548 8.60069 5.1537L10.64 7.27801L13.6393 4.1537C13.8305 3.95447 14.1471 3.94807 14.3463 4.13931C14.5455 4.33054 14.5519 4.64706 14.3607 4.8463L11.0007 8.34627C10.9064 8.44448 10.7762 8.5 10.64 8.5C10.5038 8.5 10.3736 8.44448 10.2793 8.34627L8.24 6.22199L5.82341 8.73933L7.54512 10.3922Z"
                            fill="#E53E3E"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-lightblue-100 rounded-2xl p-6">
            <p class="text-sm font-semibold text-black mb-2">Saldo</p>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl leading-9 font-semibold text-black">
                    @php
                        $totalPemasukan = $transaksi->where('tipe', 'pemasukan')->sum('total');
                        $totalPengeluaran = $transaksi->where('tipe', 'pengeluaran')->sum('total');
                        $labaBersih = $totalPemasukan - $totalPengeluaran;
                    @endphp
                    Rp.{{ number_format($labaBersih, 0, ',', '.') }}
                </h2>
                <div class="flex items-center gap-1">
                   
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="#2563eb" stroke-width="2" fill="#e0f2fe"/>
                        <path d="M8 12h8M12 8v8" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
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
                                    <h5 class="font-semibold text-lg">Tambah Catatan Baru</h5>
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
                                    <div x-data="{ tab: 'pengeluaran' }">
                                        <div class="flex mb-4">
                                             <button
                                                :class="tab === 'pengeluaran' ? 'bg-purple-600 text-white' : 'bg-gray-100 text-black'"
                                                class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-l-lg focus:outline-none transition-all duration-200 w-full"
                                                @click="tab = 'pengeluaran'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                                Pengeluaran
                                            </button>
                                            <button
                                                :class="tab === 'pemasukan' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-black'"
                                                class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-r-lg focus:outline-none transition-all duration-200 w-full"
                                                @click="tab = 'pemasukan'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Pemasukan
                                            </button>
                                           
                                        </div>
                                        
                                        <div x-show="tab === 'pengeluaran'">
                                              <form action="{{ route('keuangan.add') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                <input type="hidden" name="tipe" value="pengeluaran">
                                                 <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 flex items-center gap-4">
                                                  <div class="flex-1">
                                                        <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Tanggal <span style="color: red">*</span></label>
                                                        <input type="text" name="tanggal" class="form-input" id="tanggal">
                                                        <!-- Pastikan flatpickr locale id sudah di-load -->
                                                        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
                                                        <script>
                                                            flatpickr("#tanggal", {
                                                                dateFormat: "d/m/Y",  // Format yang diinginkan
                                                                defaultDate: "today", // Menampilkan tanggal sekarang sebagai default
                                                                locale: "id",         // Menggunakan format lokal Indonesia (untuk bulan dan nama hari)
                                                            });
                                                        </script>
                                                    </div>
                                                 </div>
                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 flex items-center gap-4">
                                                    <div class="flex-1">
                                                        <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Deskripsi Transaksi <span style="color: red">*</span></label>
                                                        <textarea name="deskripsi" class="form-input" rows="2" placeholder="Deskripsi Transaksi"></textarea>
                                                    </div>
                                                    <div x-data="{ fileName2: '', fileUrl2: '' }">
                                                        <label for="foto-upload-2" 
                                                            :class="fileName2 ? 'bg-green-100 border-green-500' : 'bg-gray-100'"
                                                            class="cursor-pointer flex flex-col items-center justify-center w-24 h-24 border-2 border-dashed rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                                            <template x-if="fileUrl2">
                                                                <img :src="fileUrl2" alt="Preview" class="w-16 h-16 object-cover rounded mb-1" />
                                                            </template>
                                                            <template x-if="!fileUrl2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 002.828 2.828L18 9.828M7 7h.01M21 21H3V3h18v18z" />
                                                                </svg>
                                                            </template>
                                                            <span x-text="fileName2 ? fileName2 : 'Upload Foto'" class="text-xs text-gray-500 mt-1 text-center"></span>
                                                            <input id="foto-upload-2" type="file" name="foto" class="hidden"
                                                                @change="
                                                                    fileName2 = $event.target.files[0]?.name || '';
                                                                    if ($event.target.files[0]) {
                                                                        const reader = new FileReader();
                                                                        reader.onload = e => fileUrl2 = e.target.result;
                                                                        reader.readAsDataURL($event.target.files[0]);
                                                                    } else {
                                                                        fileUrl2 = '';
                                                                    }
                                                                " />
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10">
                                                    <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Kategori Transaksi <span style="color: red">*</span></label>
                                                    <select name="id_akun" class="select-form kategori_keluar w-full" style="width: 100%;" data-placeholder="Pilih Kategori Akun">
                                                        <option></option>
                                                        @foreach($akun->where('jenis_akun','pengeluaran') as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_akun }}</option>
                                                        @endforeach
                                                    </select>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('.kategori_keluar').select2({
                                                                placeholder: 'Pilih Kategori Akun',
                                                                allowClear: true,
                                                                width: 'resolve'
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            
                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 flex items-center gap-4">
                                                    <div class="flex-1">
                                                        <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Jumlah (Rp) <span style="color: red">*</span></label>
                                                        <input 
                                                            type="text" 
                                                            name="total" 
                                                            class="form-input" 
                                                            placeholder="Jumlah"
                                                            autocomplete="off"
                                                            inputmode="numeric"
                                                            id="total_pengeluaran"
                                                        >
                                                        </div>
                                                        <script>
                                                            // Format input as currency (Rp. 2.000.000) but submit as plain number (2000000)
                                                            document.addEventListener('DOMContentLoaded', function () {
                                                                const input = document.getElementById('total_pengeluaran');
                                                                if (input) {
                                                                    input.addEventListener('input', function (e) {
                                                                        // Remove all non-digit characters
                                                                        let value = this.value.replace(/\D/g, '');
                                                                        // Format as currency
                                                                        if (value) {
                                                                            this.value = 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                                                        } else {
                                                                            this.value = '';
                                                                        }
                                                                    });

                                                                    // On form submit, remove formatting so only number is sent
                                                                    input.form && input.form.addEventListener('submit', function () {
                                                                        input.value = input.value.replace(/\D/g, '');
                                                                    });
                                                                }
                                                            });
                                                        </script>
                                                    <!-- Kotak Rekening dengan Icon -->
                                                    <div x-data="{ openRekening: false, selectedRekening: '', selectedRekeningName: '' }" class="relative">
                                                        <button type="button" @click="openRekening = !openRekening"
                                                            class="flex items-center gap-2 px-3 py-2 border rounded-lg bg-gray-100 dark:bg-black dark:border hover:bg-gray-200 transition">
                                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                                                viewBox="0 0 24 24">
                                                                <rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor" fill="none"/>
                                                                <path d="M16 3v4M8 3v4M3 11h18" stroke="currentColor"/>
                                                            </svg>
                                                            <span 
                                                                x-text="selectedRekeningName 
                                                                    ? selectedRekeningName 
                                                                    : `{{ optional($rekening->firstWhere('kode_rekening', app('settings')['default_rekening']))->nama_rekening ?? ($rekening->first()->nama_rekening ?? '') }}`">
                                                                {{ optional($rekening->firstWhere('kode_rekening', app('settings')['default_rekening']))->nama_rekening ?? ($rekening->first()->nama_rekening ?? '') }}
                                                            </span>
                                                            <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                                                viewBox="0 0 24 24">
                                                                <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                        <!-- Dropdown Pilihan Rekening -->
                                                        <div x-show="openRekening" @click.away="openRekening = false"
                                                            class="fixed inset-0 z-[1001] flex items-center justify-center"
                                                            style="background: rgba(0,0,0,0.2);">
                                                            <div class="bg-white dark:bg-black dark:border:border-black border border-gray-200 rounded-lg shadow-lg w-80 max-w-full"
                                                                @click.stop>
                                                                <div class="p-3 border-b font-semibold">Pilih Rekening</div>
                                                                <ul>
                                                                    @if($rekening->isEmpty())
                                                                        <li class="px-4 py-2 text-gray-400 text-center">Tidak ada rekening tersedia.</li>
                                                                    @else
                                                                        @foreach($rekening as $item)
                                                                        <li>
                                                                            <button type="button"
                                                                                @click="selectedRekening = '{{ $item->id }}'; selectedRekeningName = '{{ \Illuminate\Support\Str::limit($item->nama_rekening, 10, '...') }}'; openRekening = false"
                                                                                class="w-full text-left px-4 py-2 hover:bg-blue-100 transition">
                                                                                <span class="block truncate max-w-[200px] flex items-center">
                                                                                    {{ $item->nama_rekening }}
                                                                                    <template x-if="selectedRekening === '{{ $item->id }}' || (!selectedRekening && '{{ $item->id }}' == '{{ optional($rekening->firstWhere('kode_rekening', app('settings')['default_rekening']))->id ?? ($rekening->first()->id ?? '') }}')">
                                                                                        <svg class="w-4 h-4 text-green-500 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                                                        </svg>
                                                                                    </template>
                                                                                </span>
                                                                            </button>
                                                                        </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                                <div class="p-2 flex justify-end">
                                                                    <button type="button" @click="openRekening = false"
                                                                        class="text-sm px-3 py-1 rounded bg-gray-100 hover:bg-gray-200 dark:bg-black">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id_rekening" :value="selectedRekening">
                                                    </div>
                                                </div>
                                                <div class="flex ">
                                                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div x-show="tab === 'pemasukan'">
                                             <form action="{{ route('keuangan.add') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                <input type="hidden" name="tipe" value="pemasukan">
                                                 <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 flex items-center gap-4">
                                                  <div class="flex-1">
                                                        <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Tanggal <span style="color: red">*</span></label>
                                                        <input type="text" name="tanggal" class="form-input" id="tanggal">
                                                        <script>
                                                            flatpickr("#tanggal", {
                                                                dateFormat: "d/m/Y",  // Format yang diinginkan
                                                                defaultDate: "today", // Menampilkan tanggal sekarang sebagai default
                                                                locale: "id",         // Menggunakan format lokal Indonesia (untuk bulan dan nama hari)
                                                            });
                                                            </script>
                                                    </div>
                                                 </div>
                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 flex items-center gap-4">
                                                    <div class="flex-1">
                                                        <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Deskripsi Transaksi <span style="color: red">*</span></label>
                                                        <textarea name="deskripsi" class="form-input" rows="2" placeholder="Deskripsi Transaksi"></textarea>
                                                    </div>
                                                    <div x-data="{ fileName: '', fileUrl: '' }">
                                                        <label for="foto-upload" 
                                                            :class="fileName ? 'bg-green-100 border-green-500' : 'bg-gray-100'"
                                                            class="cursor-pointer flex flex-col items-center justify-center w-24 h-24 border-2 border-dashed rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                                            <template x-if="fileUrl">
                                                                <img :src="fileUrl" alt="Preview" class="w-16 h-16 object-cover rounded mb-1" />
                                                            </template>
                                                            <template x-if="!fileUrl">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 002.828 2.828L18 9.828M7 7h.01M21 21H3V3h18v18z" />
                                                                </svg>
                                                            </template>
                                                            <span x-text="fileName ? fileName : 'Upload Foto'" class="text-xs text-gray-500 mt-1 text-center"></span>
                                                            <input id="foto-upload" type="file" name="foto" class="hidden"
                                                                @change="
                                                                    {{-- fileName = $event.target.files[0]?.name || ''; --}}
                                                                    if ($event.target.files[0]) {
                                                                        const reader = new FileReader();
                                                                        reader.onload = e => fileUrl = e.target.result;
                                                                        reader.readAsDataURL($event.target.files[0]);
                                                                    } else {
                                                                        fileUrl = '';
                                                                    }
                                                                " />
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10">
                                                    <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Kategori Transaksi <span style="color: red">*</span></label>
                                                    <select name="id_akun" class="select-form kategori_keluar w-full" style="width: 100%;" data-placeholder="Pilih Kategori Akun">
                                                        <option></option>
                                                        @foreach($akun->where('jenis_akun','pemasukan') as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_akun }}</option>
                                                        @endforeach
                                                    </select>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('.kategori_keluar').select2({
                                                                placeholder: 'Pilih Kategori Akun',
                                                                allowClear: true,
                                                                width: 'resolve'
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            
                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 flex items-center gap-4">
                                                     <div class="flex-1">
                                                        <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Jumlah (Rp) <span style="color: red">*</span></label>
                                                        <input 
                                                            type="text" 
                                                            name="total" 
                                                            class="form-input" 
                                                            placeholder="Jumlah"
                                                            autocomplete="off"
                                                            inputmode="numeric"
                                                            id="total_pemasukan"
                                                        >
                                                        </div>
                                                        <script>
                                                            // Format input as currency (Rp. 2.000.000) but submit as plain number (2000000)
                                                            document.addEventListener('DOMContentLoaded', function () {
                                                                const input = document.getElementById('total_pemasukan');
                                                                if (input) {
                                                                    input.addEventListener('input', function (e) {
                                                                        // Remove all non-digit characters
                                                                        let value = this.value.replace(/\D/g, '');
                                                                        // Format as currency
                                                                        if (value) {
                                                                            this.value = 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                                                        } else {
                                                                            this.value = '';
                                                                        }
                                                                    });

                                                                    // On form submit, remove formatting so only number is sent
                                                                    input.form && input.form.addEventListener('submit', function () {
                                                                        input.value = input.value.replace(/\D/g, '');
                                                                    });
                                                                }
                                                            });
                                                        </script>
                                                    <!-- Kotak Rekening dengan Icon -->
                                                    <div x-data="{ openRekening: false, selectedRekening: '', selectedRekeningName: '' }" class="relative">
                                                        <button type="button" @click="openRekening = !openRekening"
                                                            class="flex items-center gap-2 px-3 py-2 border rounded-lg bg-gray-100 dark:bg-black dark:border hover:bg-gray-200 transition">
                                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                                                viewBox="0 0 24 24">
                                                                <rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor" fill="none"/>
                                                                <path d="M16 3v4M8 3v4M3 11h18" stroke="currentColor"/>
                                                            </svg>
                                                            <span 
                                                                x-text="selectedRekeningName 
                                                                    ? selectedRekeningName 
                                                                    : `{{ optional($rekening->firstWhere('kode_rekening', app('settings')['default_rekening']))->nama_rekening ?? ($rekening->first()->nama_rekening ?? '') }}`">
                                                                {{ optional($rekening->firstWhere('kode_rekening', app('settings')['default_rekening']))->nama_rekening ?? ($rekening->first()->nama_rekening ?? '') }}
                                                            </span>
                                                            <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                                                viewBox="0 0 24 24">
                                                                <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                        <!-- Dropdown Pilihan Rekening -->
                                                        <div x-show="openRekening" @click.away="openRekening = false"
                                                            class="fixed inset-0 z-[1001] flex items-center justify-center"
                                                            style="background: rgba(0,0,0,0.2);">
                                                            <div class="bg-white dark:bg-black dark:border:border-black border border-gray-200 rounded-lg shadow-lg w-80 max-w-full"
                                                                @click.stop>
                                                                <div class="p-3 border-b font-semibold">Pilih Rekening</div>
                                                              
                                                                <ul>
                                                                    @if($rekening->isEmpty())
                                                                        <li class="px-4 py-2 text-gray-400 text-center">Tidak ada rekening tersedia.</li>
                                                                    @else
                                                                        @foreach($rekening as $item)
                                                                        <li>
                                                                            <button type="button"
                                                                                @click="selectedRekening = '{{ $item->id }}'; selectedRekeningName = '{{ \Illuminate\Support\Str::limit($item->nama_rekening, 10, '...') }}'; openRekening = false"
                                                                                class="w-full text-left px-4 py-2 hover:bg-blue-100 transition {{ $loop->first && old('id_rekening', '') == '' ? 'bg-blue-100' : '' }}"
                                                                                :class="selectedRekening === '{{ $item->id }}' ? 'bg-blue-100' : ''">
                                                                                <span class="block truncate max-w-[200px] flex items-center">
                                                                                    {{ $item->nama_rekening }}
                                                                                    <template x-if="selectedRekening === '{{ $item->id }}' || (!selectedRekening && '{{ $item->id }}' == '{{ optional($rekening->firstWhere('kode_rekening', app('settings')['default_rekening']))->id ?? ($rekening->first()->id ?? '') }}')">
                                                                                        <svg class="w-4 h-4 text-green-500 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                                                        </svg>
                                                                                    </template>
                                                                                </span>
                                                                            </button>
                                                                        </li>
                                                                        @endforeach
                                                                    @endif
                                                                 
                                                                </ul>
                                                                <div class="p-2 flex justify-end">
                                                                    <button type="button" @click="openRekening = false"
                                                                        class="text-sm px-3 py-1 rounded bg-gray-100 hover:bg-gray-200 dark:bg-black">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id_rekening" :value="selectedRekening">
                                                    </div>
                                                </div>
                                                <div class="flex ">
                                                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div>
        <div class="flex items-center gap-2 mt-2">
            <input
                type="text"
                id="produkTableSearch"
                placeholder="Cari transaksi di tabel..."
                class="w-full form-input !rounded-full py-2.5 px-4 text-black dark:text-white border border-black/10 dark:border-white/10 placeholder:text-black/20 dark:placeholder:text-white/20 focus:border-black dark:focus:border-white focus:ring-0 focus:shadow-none"
                autocomplete="off"
            >
            <a
                href="{{ route('keuangan.kalender') }}"
                id="calendarFilterBtn"
                class="p-2 rounded-full bg-gray-100 hover:bg-blue-100 dark:bg-black border border-gray-200 flex items-center justify-center"
                title="Lihat Kalender"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor" fill="none"/>
                    <path d="M16 3v4M8 3v4M3 11h18" stroke="currentColor"/>
                </svg>
            </a>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('produkTableSearch');
            const table = document.getElementById('produkTable');
            input.addEventListener('keyup', function () {
                const filter = input.value.toLowerCase();
                const trs = table.querySelectorAll('tbody tr');
                trs.forEach(tr => {
                    const text = tr.textContent.toLowerCase();
                    tr.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        });
        </script>
        </div>
    </div>
    <div class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-2 rounded-md">
        @php
                    // Ambil parameter sort dan filter tanggal dari request
                    $sort = request('sort', 'desc');
                    $from = request('from');
                    $to = request('to');

                    // Filter transaksi berdasarkan rentang tanggal jika ada
                    $filteredTransaksi = $transaksi;
                    if ($from && $to) {
                        try {
                            $fromDate = \Carbon\Carbon::createFromFormat('d/m/Y', $from)->startOfDay();
                            $toDate = \Carbon\Carbon::createFromFormat('d/m/Y', $to)->endOfDay();
                            $filteredTransaksi = $filteredTransaksi->filter(function($item) use ($fromDate, $toDate) {
                                $itemDate = \Carbon\Carbon::createFromFormat('d/m/Y', $item->tanggal);
                                return $itemDate->between($fromDate, $toDate);
                            });
                        } catch (\Exception $e) {
                            // Jika format salah, tampilkan semua
                        }
                    }

                    // Urutkan transaksi berdasarkan tanggal sesuai sort
                    $filteredTransaksi = $sort === 'asc'
                        ? $filteredTransaksi->sortBy(function($item) {
                            return \Carbon\Carbon::createFromFormat('d/m/Y', $item->tanggal)->format('Y-m-d');
                        })
                        : $filteredTransaksi->sortByDesc(function($item) {
                            return \Carbon\Carbon::createFromFormat('d/m/Y', $item->tanggal)->format('Y-m-d');
                        });
                @endphp

                <div class="flex flex-col md:flex-row justify-between mb-2 gap-2">
                    <div x-data="{ openFilter: false }" class="relative">
                        <button type="button" @click="openFilter = !openFilter"
                            class="p-2 rounded-lg bg-gray-100 hover:bg-blue-100 dark:bg-black border border-gray-200 flex items-center gap-1">
                            <i class="fas fa-filter"></i>
                            <span class=" md:inline">Filter</span>
                        </button>
                        <div x-show="openFilter" @click.away="openFilter = false"
                            class="absolute z-50 mt-2 left-0 bg-white dark:bg-black border border-gray-200 dark:border-white/10 rounded-lg shadow-lg p-4 min-w-[320px]">
                            <form method="GET" class="flex flex-col gap-2" id="filterForm">
                                <h3><strong>Filter Transaksi</strong></h3>
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center gap-2">
                                        <label class="text-sm w-16">Dari:</label>
                                        <input type="text" name="from" id="from_date" value="{{ $from }}" class="form-input py-1 px-2 rounded border border-black/10 dark:border-white/10 w-full" placeholder="dd/mm/yyyy" autocomplete="off">
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <label class="text-sm w-16">Sampai:</label>
                                        <input type="text" name="to" id="to_date" value="{{ $to }}" class="form-input py-1 px-2 rounded border border-black/10 dark:border-white/10 w-full" placeholder="dd/mm/yyyy" autocomplete="off">
                                    </div>
                                    <div class="flex gap-2 mt-2">
                                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 w-full">Terapkan</button>
                                        <a href="{{ route('index.keuangan') }}" class="bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-gray-300 w-full text-center">Reset</a>
                                    </div>
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        flatpickr("#from_date", {
                            dateFormat: "d/m/Y",
                            locale: "id",
                            allowInput: true
                        });
                        flatpickr("#to_date", {
                            dateFormat: "d/m/Y",
                            locale: "id",
                            allowInput: true
                        });
                    });
                </script>
        <div class="table-responsive">           
            <table class="w-full border-collapse text-sm table-auto" id="produkTable">

                @php
                    // Group transaksi by tanggal (format: Y-m-d)
                    $groupedTransaksi = $transaksi->groupBy(function($item) {
                        return \Carbon\Carbon::createFromFormat('d/m/Y', $item->tanggal)->format('Y-m-d');
                    });
                @endphp

                @foreach($groupedTransaksi as $tanggal => $items)
                    @php
                        // Format tanggal untuk header
                        $carbonTanggal = \Carbon\Carbon::createFromFormat('Y-m-d', $tanggal);
                        $tanggalFormatted = $carbonTanggal->translatedFormat('d F Y - l');
                        // Hitung total pemasukan & pengeluaran untuk tanggal ini
                        $pemasukan = $items->where('tipe', 'pemasukan')->sum('total');
                        $pengeluaran = $items->where('tipe', 'pengeluaran')->sum('total');
                    @endphp
                    <thead class="lg:table-header-group">
                        <tr class="text-gray-400">
                            <th width="70%" class="text-left font-normal ">{{ $tanggalFormatted }}</th>
                            <th class="text-left ">
                                <div class="flex flex-col lg:flex-row gap-4 text-gray-600">
                                    <div>Pemasukan:<span class="text-green-600"> Rp {{ number_format($pemasukan, 0, ',', '.') }}</span></div>
                                    <div>Pengeluaran: <span class="text-red-600"> Rp {{ number_format($pengeluaran, 0, ',', '.') }}</span></div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr class="hover:bg-gray-50" x-data="{ openDetail: false }">
                            <!-- Produk / Transaksi -->
                            <td class="py-4 pl-6 flex items-start gap-3">
                                <div class="flex flex-col">
                                    <span class="font-semibold leading-tight">
                                        <a href="#" 
                                            @click.prevent="openDetail = true" 
                                            class="hover:underline">
                                             {{ $item->deskripsi ?? '-' }}
                                             <!-- Modal Detail Transaksi -->
                                             <div 
                                                  x-show="openDetail" 
                                                  x-transition 
                                                  class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/60"
                                                  style="display: none; z-index:9999;">
                                                  <div class="bg-white dark:bg-black rounded-lg shadow-lg w-full max-w-lg relative" @click.away="openDetail = false">
                                                        <!-- Header -->
                                                        <div class="flex justify-between items-center border-b px-5 py-3">
                                                             <h3 class="font-semibold text-lg">Detail Transaksi</h3>
                                                            <div class="flex gap-2">
                                                                <button @click="openDetail = false" type="button" class="px-3 py-1 rounded bg-red-100 text-red-600 hover:bg-red-200 focus:outline-none">
                                                                    Batal
                                                                </button>
                                                                <a href=""
                                                                    class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 focus:outline-none transition inline-block"
                                                                    onclick="event.preventDefault(); Swal.fire({
                                                                          title: 'Yakin ingin menghapus transaksi ini?',
                                                                          icon: 'warning',
                                                                          showCancelButton: true,
                                                                          confirmButtonColor: '#dc2626',
                                                                          cancelButtonColor: '#6b7280',
                                                                          confirmButtonText: 'Ya, hapus!',
                                                                          cancelButtonText: 'Batal',
                                                                          customClass: {
                                                                                confirmButton: 'bg-red-600 text-white px-4 py-2 rounded mr-2 hover:bg-red-700',
                                                                                cancelButton: 'bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300'
                                                                          },
                                                                          buttonsStyling: false,
                                                                          didOpen: () => {
                                                                              // Tambah z-index swal
                                                                              document.querySelector('.swal2-container').style.zIndex = 10000;
                                                                          }
                                                                     }).then((result) => {
                                                                          if (result.isConfirmed) {
                                                                                window.location.href = '{{ route('keuangan.delete',$item->id) }}';
                                                                          }
                                                                     });"
                                                                    title="Hapus Data">
                                                                     Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- Content -->
                                                        <div class="p-5 space-y-4">
                                                            <form action="{{ route('keuangan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                                @csrf       
                                                                <input type="hidden" name="tipe" value="{{ $item->tipe }}">
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 flex items-center gap-4">
                                                                    <div class="flex-1">
                                                                        <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Tanggal</label>
                                                                        <input type="text" name="tanggal" class="form-input" id="tanggal_edit_{{ $item->id }}" value="{{ $item->tanggal }}">
                                                                        <script>
                                                                            flatpickr("#tanggal_edit_{{ $item->id }}", {
                                                                                dateFormat: "d/m/Y",
                                                                                defaultDate: "{{ $item->tanggal }}",
                                                                                locale: "id",
                                                                            });
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 flex items-center gap-4">
                                                                    <div class="flex-1">
                                                                        <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Deskripsi Transaksi</label>
                                                                        <textarea name="deskripsi" class="form-input" rows="2" placeholder="Deskripsi Transaksi">{{ $item->deskripsi }}</textarea>
                                                                    </div>
                                                                    <div x-data="{ fileName: '', fileUrl: '' }">
                                                                        <label for="foto-upload-edit-{{ $item->id }}"
                                                                            :class="fileName ? 'bg-green-100 border-green-500' : 'bg-gray-100'"
                                                                            class="cursor-pointer flex flex-col items-center justify-center w-24 h-24 border-2 border-dashed rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                                                            <template x-if="fileUrl">
                                                                                <img :src="fileUrl" alt="Preview" class="w-16 h-16 object-cover rounded mb-1" />
                                                                            </template>
                                                                            <template x-if="!fileUrl">
                                                                                @if($item->foto)
                                                                                    <img src="{{ asset('storage/'.$item->foto) }}" alt="Foto Transaksi" class="w-16 h-16 object-cover rounded mb-1" />
                                                                                @else
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 002.828 2.828L18 9.828M7 7h.01M21 21H3V3h18v18z" />
                                                                                    </svg>
                                                                                @endif
                                                                            </template>
                                                                            <span x-text="fileName ? fileName : 'Upload Foto'" class="text-xs text-gray-500 mt-1 text-center"></span>
                                                                            <input id="foto-upload-edit-{{ $item->id }}" type="file" name="foto" class="hidden"
                                                                                @change="
                                                                                    fileName = $event.target.files[0]?.name || '';
                                                                                    if ($event.target.files[0]) {
                                                                                        const reader = new FileReader();
                                                                                        reader.onload = e => fileUrl = e.target.result;
                                                                                        reader.readAsDataURL($event.target.files[0]);
                                                                                    } else {
                                                                                        fileUrl = '';
                                                                                    }
                                                                                " />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10">
                                                                    <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Kategori Transaksi</label>
                                                                    <select name="id_akun" class="select-form kategori_edit_{{ $item->id }} w-full" style="width: 100%;" data-placeholder="Pilih Kategori Akun">
                                                                        <option></option>
                                                                        @php
                                                                            $jenisAkun = $item->tipe == 'pemasukan' ? 'pemasukan' : 'pengeluaran';
                                                                        @endphp
                                                                        @foreach($akun->where('jenis_akun', $jenisAkun) as $akunItem)
                                                                            <option value="{{ $akunItem->id }}" {{ $item->id_akun == $akunItem->id ? 'selected' : '' }}>{{ $akunItem->nama_akun }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $('.kategori_edit_{{ $item->id }}').select2({
                                                                                placeholder: 'Pilih Kategori Akun',
                                                                                allowClear: true,
                                                                                width: 'resolve',
                                                                                dropdownParent: $('.kategori_edit_{{ $item->id }}').parent()
                                                                            });
                                                                        });
                                                                    </script>
                                                                </div>
                                                                <div class="mb-4 relative bg-white dark:bg-white/5 py-4 px-5 rounded-lg border border-black/10 flex items-center gap-4">
                                                                    <div class="flex-1">
                                                                        <label class="block text-xs text-black/40 dark:text-white/40 mb-1">Jumlah (Rp)</label>
                                                                        <input
                                                                            type="text"
                                                                            name="total"
                                                                            class="form-input"
                                                                            placeholder="Jumlah"
                                                                            autocomplete="off"
                                                                            inputmode="numeric"
                                                                            id="total_edit_{{ $item->id }}"
                                                                            value="Rp. {{ number_format($item->total, 0, ',', '.') }}"
                                                                        >
                                                                    </div>
                                                                    <script>
                                                                        document.addEventListener('DOMContentLoaded', function () {
                                                                            const input = document.getElementById('total_edit_{{ $item->id }}');
                                                                            if (input) {
                                                                                input.addEventListener('input', function (e) {
                                                                                    let value = this.value.replace(/\D/g, '');
                                                                                    if (value) {
                                                                                        this.value = 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                                                                    } else {
                                                                                        this.value = '';
                                                                                    }
                                                                                });
                                                                                input.form && input.form.addEventListener('submit', function () {
                                                                                    input.value = input.value.replace(/\D/g, '');
                                                                                });
                                                                            }
                                                                        });
                                                                    </script>
                                                                    <div x-data="{ openRekening: false, selectedRekening: '{{ $item->id_rekening }}', selectedRekeningName: '{{ $item->rekening->nama_rekening ?? '' }}' }" class="relative">
                                                                        <button type="button" @click="openRekening = !openRekening"
                                                                            class="flex items-center gap-2 px-3 py-2 border rounded-lg bg-gray-100 dark:bg-black dark:border hover:bg-gray-200 transition">
                                                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                                                                viewBox="0 0 24 24">
                                                                                <rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor" fill="none"/>
                                                                                <path d="M16 3v4M8 3v4M3 11h18" stroke="currentColor"/>
                                                                            </svg>
                                                                            <span x-text="selectedRekeningName ? selectedRekeningName : '{{ $item->rekening->nama_rekening ?? "Rekening" }}'">
                                                                                {{ $item->rekening->nama_rekening ?? 'Rekening' }}
                                                                            </span>
                                                                            <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                                                                viewBox="0 0 24 24">
                                                                                <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                                                            </svg>
                                                                        </button>
                                                                        <div x-show="openRekening" @click.away="openRekening = false"
                                                                            class="fixed inset-0 z-[1001] flex items-center justify-center"
                                                                            style="background: rgba(0,0,0,0.2);">
                                                                            <div class="bg-white dark:bg-black dark:border:border-black border border-gray-200 rounded-lg shadow-lg w-80 max-w-full"
                                                                                @click.stop>
                                                                                <div class="p-3 border-b font-semibold">Pilih Rekening</div>
                                                                                <ul>
                                                                                    @foreach($rekening as $rek)
                                                                                    <li>
                                                                                        <button type="button"
                                                                                            @click="selectedRekening = '{{ $rek->id }}'; selectedRekeningName = '{{ \Illuminate\Support\Str::limit($rek->nama_rekening, 10, '...') }}'; openRekening = false"
                                                                                            class="w-full text-left px-4 py-2 hover:bg-blue-100 transition">
                                                                                            <span class="block truncate max-w-[200px] flex items-center">
                                                                                                {{ $rek->nama_rekening }}
                                                                                                <template x-if="selectedRekening === '{{ $rek->id }}'">
                                                                                                    <svg class="w-4 h-4 text-green-500 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                                                                    </svg>
                                                                                                </template>
                                                                                            </span>
                                                                                        </button>
                                                                                    </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                                <div class="p-2 flex justify-end">
                                                                                    <button type="button" @click="openRekening = false"
                                                                                        class="text-sm px-3 py-1 rounded bg-gray-100 hover:bg-gray-200 dark:bg-black">Tutup</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="id_rekening" :value="selectedRekening">
                                                                    </div>
                                                                </div>
                                                                <div class="flex ">
                                                                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
                                                                </div>
                                                            </form>
                                                            {{-- <div class="flex gap-2 justify-end mt-4">
                                                                <!-- Delete Button -->
                                                                <form action="" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="px-3 py-2 rounded bg-red-600 text-white hover:bg-red-700 text-sm flex items-center gap-1">
                                                                        <i class="fas fa-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div> --}}
                                                        </div>
                                                  </div>
                                             </div>
                                        </a>
                                    </span>
                                    <span class="text-gray-400 leading-tight truncate max-w-[120px]">
                                        {{ $item->akun->nama_akun ?? '-' }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 font-semibold mobile lg:table-cell">
                                <span class="{{ $item->tipe == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                    Rp. {{ number_format($item->total, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                @endforeach

            </table>
            @if($transaksi->isEmpty())
                <tbody>
                    <tr>
                        <td colspan="2" class="py-12 text-center align-middle">
                            <span class="inline-block text-gray-400 text-base font-medium">
                                Tidak ada transaksi ditemukan.
                            </span>
                        </td>
                    </tr>
                </tbody>
            @endif
        </div>
    </div>
@endsection
