@extends('layout.main')
@section('css')
@section('title', 'Setelan Perusahaan')
@section('container')
    <style>
        @media (min-width: 640px) {
            .sm\:p-7 {
                padding: 0;
            }
        }

        @media (min-width: 768px) {
            .sm\:p-7 {
                padding: 0;
            }

            .mobile {
                visibility: none;
            }
        }
        .space-x-3>:not([hidden])~:not([hidden]) {
            --tw-space-x-reverse: none;
          
        }

    </style>
    
    <div class=" flex items-center rounded bg-lightblue-200/50 dark:bg-lightblue-200 p-3 text-black/80 dark:text-black">
        <svg class="w-5 h-5 mr-2" width="32" height="32" viewBox="0 0 32 32" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M16 3C16 3 18.6442 3 21.0605 4.02201C21.0605 4.02201 23.3936 5.00884 25.1924 6.80761C25.1924 6.80761 26.9912 8.60638 27.978 10.9395C27.978 10.9395 29 13.3558 29 16C29 16 29 18.6442 27.978 21.0605C27.978 21.0605 26.9912 23.3936 25.1924 25.1924C25.1924 25.1924 23.3936 26.9912 21.0605 27.978C21.0605 27.978 18.6442 29 16 29C16 29 13.3558 29 10.9395 27.978C10.9395 27.978 8.60638 26.9912 6.80761 25.1924C6.80761 25.1924 5.00884 23.3936 4.02202 21.0605C4.02202 21.0605 3 18.6442 3 16C3 16 3 13.3558 4.02202 10.9395C4.02202 10.9395 5.00885 8.60638 6.80761 6.80761C6.80761 6.80761 8.60638 5.00884 10.9395 4.02201C10.9395 4.02201 13.3558 3 16 3ZM16 5C16 5 13.7614 5 11.7186 5.86402C11.7186 5.86402 9.74476 6.69889 8.22183 8.22182C8.22183 8.22182 6.6989 9.74476 5.86402 11.7186C5.86402 11.7186 5 13.7614 5 16C5 16 5 18.2386 5.86402 20.2814C5.86402 20.2814 6.69889 22.2552 8.22183 23.7782C8.22183 23.7782 9.74476 25.3011 11.7186 26.136C11.7186 26.136 13.7614 27 16 27C16 27 18.2386 27 20.2814 26.136C20.2814 26.136 22.2552 25.3011 23.7782 23.7782C23.7782 23.7782 25.3011 22.2552 26.136 20.2814C26.136 20.2814 27 18.2386 27 16C27 16 27 13.7614 26.136 11.7186C26.136 11.7186 25.3011 9.74476 23.7782 8.22183C23.7782 8.22183 22.2552 6.69889 20.2814 5.86402C20.2814 5.86402 18.2386 5 16 5Z"
                fill="currentColor"></path>
            <path
                d="M16 23H17C17.5523 23 18 22.5523 18 22C18 21.4477 17.5523 21 17 21V15C17 14.4477 16.5523 14 16 14H15C14.4477 14 14 14.4477 14 15C14 15.5523 14.4477 16 15 16V22C15 22.5523 15.4477 23 16 23Z"
                fill="currentColor"></path>
            <path
                d="M17.25 10.5C17.25 11.3284 16.5784 12 15.75 12C14.9216 12 14.25 11.3284 14.25 10.5C14.25 9.67157 14.9216 9 15.75 9C16.5784 9 17.25 9.67157 17.25 10.5Z"
                fill="currentColor"></path>
        </svg>
        <span class="pr-2">Halaman Data Perusahaan, Legalitas dan Setelan Cap Tanda tangan</span>
        <button type="button" class="ml-auto hover:opacity-50 rotate-0 hover:rotate-180 transition-all duration-300">
            <svg class="w-5 h-5" width="32" height="32" viewBox="0 0 32 32" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M24.2929 6.29289L6.29289 24.2929C6.10536 24.4804 6 24.7348 6 25C6 25.2652 6.10536 25.5196 6.29289 25.7071C6.48043 25.8946 6.73478 26 7 26C7.26522 26 7.51957 25.8946 7.70711 25.7071L25.7071 7.70711C25.8946 7.51957 26 7.26522 26 7C26 6.73478 25.8946 6.48043 25.7071 6.29289C25.5196 6.10536 25.2652 6 25 6C24.7348 6 24.4804 6.10536 24.2929 6.29289Z"
                    fill="currentcolor"></path>
                <path
                    d="M7.70711 6.29289C7.51957 6.10536 7.26522 6 7 6C6.73478 6 6.48043 6.10536 6.29289 6.29289C6.10536 6.48043 6 6.73478 6 7C6 7.26522 6.10536 7.51957 6.29289 7.70711L24.2929 25.7071C24.4804 25.8946 24.7348 26 25 26C25.2652 26 25.5196 25.8946 25.7071 25.7071C25.8946 25.5196 26 25.2652 26 25C26 24.7348 25.8946 24.4804 25.7071 24.2929L7.70711 6.29289Z"
                    fill="currentcolor"></path>
            </svg>
        </button>
    </div>
    <div class="flex">
        <!-- Sidebar Tab -->
        <div class="hidden md:block border-r border-gray-200 dark:border-white/10 p-4" style="width: 30%; height:100vh;">
            <ul class="space-y-2">
                <li>
                    <button onclick="openTab('tab-profil')"
                        class="w-full text-left px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800 font-medium"
                        id="btn-tab-profil">
                        Profil Usaha
                    </button>
                </li>
                <li>
                    <button onclick="openTab('tab-legalitas')"
                        class="w-full text-left px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800 font-medium"
                        id="btn-tab-legalitas">
                        Legalitas Usaha
                    </button>
                </li>
                <li>
                    <button onclick="openTab('tab-stamp')"
                        class="w-full text-left px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800 font-medium"
                        id="btn-tab-stamp">
                        Setelan Nota dan Kwitansi
                    </button>
                </li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="w-full pl-6 p-5">
            <div id="tab-profil" class="tab-content">
                <div class="grid grid-flow-row gap-7">
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Perusahaan Saya</h2>
                        <img class="w-[120px] h-[120px] flex-none rounded-full overflow-hidden object-cover mb-2"
                            src="{{ asset('assets/images/inopak.jpg') }}" alt="">
                        <p class="text-xs text-black/40 dark:text-white/40">Allowed file types: png, jpg, jpeg.</p>
                    </div>
                    <div class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-5 rounded-md">
                        <div class="mb-3">
                            <p class="text-sm font-semibold">Data Perusahaan</p>
                        </div>
                        <div class="relative mb-3">
                            <input type="text" id="cold-design"
                                class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                                placeholder=" " value="{{ $perusahaan->nama_perusahaan }}">
                            <label for="cold-design"
                                class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
                                Nama Perusahaan
                            </label>
                        </div>
                        <div class="relative mb-3">
                            <input type="text" value="{{ $perusahaan->email }}" id="relationship"
                                class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                                placeholder=" ">
                            <label for="relationship"
                                class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
                                Email
                            </label>
                        </div>
                        <div class="relative mb-3">
                            <textarea id="description"
                                class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                                placeholder=" ">{{ $perusahaan->alamat }}</textarea>
                            <label for="description"
                                class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
                                Alamat Usaha
                            </label>
                        </div>
                    </div>
                    <div class="border bg-white dark:bg-black border-black/10 dark:border-white/10 p-5 rounded-md">
                        <div class="mb-1">
                            <p class="text-sm font-semibold">Identitas Pemilik USaha</p>
                        </div>
                        <div class="relative mb-3">
                            <input type="text" value="{{ auth()->user()->ikm->nik ?? '' }}" id="relationship"
                                class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                                placeholder="Nomor Induk Kependudukan" readonly>
                            <label for="relationship"
                                class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
                                NIK
                            </label>
                        </div>
                        <div class="relative">
                            <input type="text" value="{{ auth()->user()->ikm->nama ?? '' }}" id="relationship"
                                class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                                placeholder=" ">
                            <label for="relationship"
                                class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
                                Nama Lengkap
                            </label>
                        </div>
                    </div>
                    <div
                        class="-mx-7 -mb-7 border-t border-b border-black/10 dark:border-white/10 px-7 py-[18px] flex justify-end gap-4">
                        <a href="javaScript:;" class="btn">Discard</a>
                        <a href="javaScript:;" class="btn">Save Changes</a>
                    </div>
                </div>
            </div>

            <div id="tab-legalitas" class="tab-content hidden">
                {{-- Konten form Legalitas Usaha --}}
                <h2 class="text-lg font-semibold mb-4">Legalitas Usaha</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- NIB -->
                    <div class="relative">
                        <input type="text" id="nib" name="nib"
                            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5
                               border border-black/10 dark:border-white/10 appearance-none focus:outline-none
                               focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                            placeholder=" " value="{{ $perusahaan->nib ?? '' }}">
                        <label for="nib"
                            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90
                               top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0
                               peer-focus:scale-90 peer-focus:-translate-y-2">
                            NIB
                        </label>
                    </div>

                    <!-- NPWP -->
                    <div class="relative">
                        <input type="text" id="npwp" name="npwp"
                            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5
                               border border-black/10 dark:border-white/10 appearance-none focus:outline-none
                               focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                            placeholder=" " value="{{ $perusahaan->npwp ?? '' }}">
                        <label for="npwp"
                            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90
                               top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0
                               peer-focus:scale-90 peer-focus:-translate-y-2">
                            NPWP
                        </label>
                    </div>

                    <!-- Nomor Izin Usaha -->
                    <div class="relative">
                        <input type="text" id="izin_usaha" name="izin_usaha"
                            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5
                               border border-black/10 dark:border-white/10 appearance-none focus:outline-none
                               focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                            placeholder=" " value="{{ $perusahaan->izin_usaha ?? '' }}">
                        <label for="izin_usaha"
                            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90
                               top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0
                               peer-focus:scale-90 peer-focus:-translate-y-2">
                            Nomor Izin Usaha
                        </label>
                    </div>

                    <!-- Jenis Usaha -->
                    <div class="relative">
                        <input type="text" id="jenis_usaha" name="jenis_usaha"
                            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5
                               border border-black/10 dark:border-white/10 appearance-none focus:outline-none
                               focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                            placeholder=" " value="{{ $perusahaan->jenis_usaha ?? '' }}">
                        <label for="jenis_usaha"
                            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90
                               top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0
                               peer-focus:scale-90 peer-focus:-translate-y-2">
                            Jenis Usaha
                        </label>
                    </div>

                    <!-- Tanggal Terbit -->
                    <div class="relative col-span-1 md:col-span-2">
                        <input type="date" id="tgl_terbit" name="tgl_terbit"
                            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5
                               border border-black/10 dark:border-white/10 appearance-none focus:outline-none
                               focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                            placeholder=" " value="{{ $perusahaan->tgl_terbit ?? '' }}">
                        <label for="tgl_terbit"
                            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90
                               top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40
                               peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0
                               peer-focus:scale-90 peer-focus:-translate-y-2">
                            Tanggal Terbit
                        </label>
                    </div>

                </div>

            </div>
            <div id="tab-stamp" class="tab-content hidden">
                <h2 class="mb-3">Stample dan Tanda Tangan</h2>
                <div class="mb-3 border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-5 rounded-md">
                    <div class="mb-3">
                        <p class="text-sm font-semibold">Stemple dan Cap</p>
                    </div>
                    <div class="relative mb-3">
                        <input type="file" id="cold-design"
                            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                            placeholder=" " value="{{ $perusahaan->nama_perusahaan }}">
                        <label for="cold-design"
                            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
                            Stample
                        </label>
                    </div>
                    <div class="relative mb-3">
                        <input type="file" id="cold-design"
                            class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                            placeholder=" " value="{{ $perusahaan->nama_perusahaan }}">
                        <label for="cold-design"
                            class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
                            Cap
                        </label>
                    </div>
                </div>
                <div x-data="{ showModal: false }"
                    class="mb-3 flex items-center rounded bg-indigo-300/50 dark:bg-indigo-300 p-3 text-black/80 dark:text-black space-x-3">
                    <svg class="w-5 h-5" width="32" height="32" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16 3C16 3 18.6442 3 21.0605 4.02201C21.0605 4.02201 23.3936 5.00884 25.1924 6.80761C25.1924 6.80761 26.9912 8.60638 27.978 10.9395C27.978 10.9395 29 13.3558 29 16C29 16 29 18.6442 27.978 21.0605C27.978 21.0605 26.9912 23.3936 25.1924 25.1924C25.1924 25.1924 23.3936 26.9912 21.0605 27.978C21.0605 27.978 18.6442 29 16 29C16 29 13.3558 29 10.9395 27.978C10.9395 27.978 8.60638 26.9912 6.80761 25.1924C6.80761 25.1924 5.00884 23.3936 4.02202 21.0605C4.02202 21.0605 3 18.6442 3 16C3 16 3 13.3558 4.02202 10.9395C4.02202 10.9395 5.00885 8.60638 6.80761 6.80761C6.80761 6.80761 8.60638 5.00884 10.9395 4.02201C10.9395 4.02201 13.3558 3 16 3ZM16 5C16 5 13.7614 5 11.7186 5.86402C11.7186 5.86402 9.74476 6.69889 8.22183 8.22182C8.22183 8.22182 6.6989 9.74476 5.86402 11.7186C5.86402 11.7186 5 13.7614 5 16C5 16 5 18.2386 5.86402 20.2814C5.86402 20.2814 6.69889 22.2552 8.22183 23.7782C8.22183 23.7782 9.74476 25.3011 11.7186 26.136C11.7186 26.136 13.7614 27 16 27C16 27 18.2386 27 20.2814 26.136C20.2814 26.136 22.2552 25.3011 23.7782 23.7782C23.7782 23.7782 25.3011 22.2552 26.136 20.2814C26.136 20.2814 27 18.2386 27 16C27 16 27 13.7614 26.136 11.7186C26.136 11.7186 25.3011 9.74476 23.7782 8.22183C23.7782 8.22183 22.2552 6.69889 20.2814 5.86402C20.2814 5.86402 18.2386 5 16 5Z"
                            fill="currentColor"></path>
                        <path
                            d="M16 23H17C17.5523 23 18 22.5523 18 22C18 21.4477 17.5523 21 17 21V15C17 14.4477 16.5523 14 16 14H15C14.4477 14 14 14.4477 14 15C14 15.5523 14.4477 16 15 16V22C15 22.5523 15.4477 23 16 23Z"
                            fill="currentColor"></path>
                        <path
                            d="M17.25 10.5C17.25 11.3284 16.5784 12 15.75 12C14.9216 12 14.25 11.3284 14.25 10.5C14.25 9.67157 14.9216 9 15.75 9C16.5784 9 17.25 9.67157 17.25 10.5Z"
                            fill="currentColor"></path>
                    </svg>

                    <span class="pr-2 flex-1">Tempelate Keterangan Pembayaran</span>

                    <button @click="showModal = true"
                        class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition" style="z-index: 999999999999999;">
                        Show
                    </button>

                    <!-- Modal / Lightbox -->
                    <div x-show="showModal" style="background: rgba(0,0,0,0.6);z-index:2147483647;width:100%;"
                        class="fixed inset-0 flex items-center justify-center " @click.away="showModal = false"
                        @keydown.escape.window="showModal = false" >
                        <div class="relative bg-white dark:bg-gray-800 rounded shadow-lg max-w-3xl max-h-[90vh] p-4">
                            <button @click="showModal = false"
                                class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 dark:hover:text-white text-xl font-bold"
                                aria-label="Close modal">&times;</button>

                            <img src="{{ asset('assets/tempelate/keterangan-pembayaran.png') }}"
                                alt="Keterangan Pembayaran" class="max-w-full max-h-[80vh] object-contain rounded" />
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <textarea id="description"
                        class="block rounded-lg px-5 pb-4 pt-[38px] w-full text-black dark:text-white bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 appearance-none focus:outline-none focus:ring-0 focus:border-black/10 dark:focus:border-black/10 peer"
                        placeholder=" ">Pembayaran dilakukan melalui transfer ke no. Rek Mandiri. 131 000 7197603 atas nama Afin Nurfahmi Mufreni setelah diterima informasi penjualan.</textarea>
                    <label for="description"
                        class="absolute text-sm text-black/40 dark:text-white/40 duration-300 transform -translate-y-2 scale-90 top-6 z-10 origin-[0] left-5 peer-focus:text-black/40 dark:peer-focus:text-white/40 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-90 peer-focus:-translate-y-2">
                        Tempelate Pembayaran
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation Menu - Mobile Only -->
    <nav
        class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-black  border-t border-gray-200 dark:border-white/10  shadow md:hidden">
        <div class="flex justify-between items-center px-6 h-16">

            <!-- Profil -->
            <button onclick="openTab('tab-profil')"
                class="flex flex-col items-center justify-center text-sm text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                <svg class="w-5 h-5 mb-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 100 12 6 6 0 000-12zM2 18a8 8 0 1116 0H2z" />
                </svg>
                <span>Profil Perusahaan</span>
            </button>

            <!-- Legalitas -->
            <button onclick="openTab('tab-legalitas')"
                class="flex flex-col items-center justify-center text-sm text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                <svg class="w-5 h-5 mb-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 4h10v2H5V4zM4 8h12v2H4V8zm1 4h10v2H5v-2z" />
                </svg>
                <span>Legalitas</span>
            </button>

            <!-- Stempel -->
            <button onclick="openTab('tab-stamp')"
                class="flex flex-col items-center justify-center text-sm text-gray-700 dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                <svg class="w-5 h-5 mb-1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 21v-18l2 2 2-2 2 2 2-2 2 2 2-2v18z" />
                    <line x1="8" y1="10" x2="16" y2="10" />
                    <line x1="8" y1="14" x2="16" y2="14" />
                    <line x1="8" y1="18" x2="12" y2="18" />
                  </svg>
                  
                <span>Nota dan Kwitansi</span>
            </button>

        </div>
    </nav>

    
    <script>
        function openTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(function(tab) {
                tab.classList.add('hidden');
            });

            document.querySelectorAll('[id^="btn-tab-"]').forEach(btn => {
                btn.classList.remove('bg-gray-200', 'dark:bg-gray-800');
            });

            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById('btn-' + tabId).classList.add('bg-gray-200', 'dark:bg-gray-800');
        }

        // Open first tab by default
        document.addEventListener("DOMContentLoaded", () => {
            openTab('tab-profil');
        });
    </script>

@endsection
