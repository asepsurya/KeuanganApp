@extends('layout.main')
@section('title', 'Tambah IKM')
<!-- Add these links in the <head> section of your HTML -->
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
@endsection
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

<div class="bg-lightwhite dark:bg-white/5 rounded-2xl p-6">
    <div class="flex items-start justify-between gap-4 mb-[2px]">
        <h2 class="text-lg font-semibold">{{ $ikm->nama }}</h2>

        <div x-data="modals">
            <a @click="toggle">
                <img class="h-20 w-20 flex-none rounded-full object-cover cursor-pointer"
                    src="{{ $ikm->foto ? asset('storage/' . $ikm->foto) : asset('assets/images/byewind-avatar.png') }}"
                    alt="Foto IKM">
            </a>
            <div class="fixed inset-0 bg-black/60 dark:bg-white/10 z-[999] hidden overflow-y-auto"
                :class="open &amp;&amp; '!block'">
                <div class="flex items-center justify-center min-h-screen px-4" @click.self="open = false">
                    <div x-show="open" x-transition="" x-transition.duration.300=""
                        class="bg-white dark:bg-black relative shadow-3xl border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8"
                        style="display: none;">
                        <div
                            class="flex bg-white dark:bg-black border-b border-black/10 dark:border-white/10 items-center justify-between px-5 py-3">
                            <h5 class="font-semibold text-lg">Foto Profile</h5>
                            <button type="button"
                                class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white"
                                @click="toggle">
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
                        <div class="p-5">
                           
                                <div class="text-sm text-black dark:text-white">
                                    <center>
                                        <img id="preview"
                                            src="{{ $ikm->foto ? asset('storage/' . $ikm->foto) : asset('assets/images/byewind-avatar.png') }}"
                                            class="py-4 flex-none rounded-md object-cover " alt="avatar" width="300">
                                    </center>
                                    <form id="studentForm" action="{{ route('ikm.update.foto') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" value="{{ $ikm->id }}" name="id" hidden>
                                        <input type="text" name="oldImage" value="{{ $ikm->foto }}" hidden>
                                        <input type="hidden" name="croppedFoto" id="croppedFoto"> <!-- Cropped Base64 image -->

                                        <div
                                            class="my-4 py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                                            <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Ubah
                                                Foto</label>
                                            <input type="file" id="image-input" accept="image/*" class="form-input">
                                        </div>


                                        <div id="loading-indicator"
                                            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); z-index: 9999; text-align: center; line-height: 100vh;">
                                            <span class="spinner-border text-primary" role="status"
                                                style="width: 3rem; height: 3rem;"></span>
                                            <p>Uploading...</p>
                                        </div>
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-7 mt-2">
                                            <div>
                                                <button type="button"
                                                    class="w-full px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition "
                                                    id="crop-btn" style="display: none;"><span
                                                        class="ti ti-crop"></span> Crop</button>
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="w-full px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition "
                                                    id="submit-btn" disabled><span class="ti ti-device-floppy"></span>
                                                    Simpan Perubahan</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap gap-4 items-center mb-4">
        <div class="flex items-center gap-1 text-xs text-black/40 dark:text-white/40">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M11.8465 2.26238C10.4873 1.6875 9 1.6875 9 1.6875C7.51265 1.6875 6.15347 2.26238 6.15347 2.26238C4.84109 2.81747 3.82928 3.82928 3.82928 3.82928C2.81748 4.84109 2.26238 6.15347 2.26238 6.15347C1.6875 7.51265 1.6875 9 1.6875 9C1.6875 10.4873 2.26238 11.8465 2.26238 11.8465C2.81747 13.1589 3.82928 14.1707 3.82928 14.1707C3.90704 14.2485 3.98657 14.3235 4.06715 14.3959C4.09662 14.4287 4.1301 14.4583 4.16709 14.4837C5.11036 15.2964 6.15347 15.7376 6.15347 15.7376C7.51265 16.3125 9 16.3125 9 16.3125C10.4873 16.3125 11.8465 15.7376 11.8465 15.7376C12.6786 15.3857 13.3899 14.8501 13.799 14.5053C13.8585 14.4704 13.9102 14.4253 13.9523 14.373C14.0928 14.2486 14.1707 14.1707 14.1707 14.1707C15.1825 13.1589 15.7376 11.8465 15.7376 11.8465C16.3125 10.4873 16.3125 9 16.3125 9C16.3125 7.51265 15.7376 6.15347 15.7376 6.15347C15.1825 4.84109 14.1707 3.82928 14.1707 3.82928C13.1589 2.81747 11.8465 2.26238 11.8465 2.26238ZM6.59172 14.7015C6.04988 14.4723 5.56846 14.151 5.21752 13.882C5.81067 12.9896 6.64596 12.4769 6.64596 12.4769C7.7291 11.8121 9 11.8125 9 11.8125C10.2709 11.8125 11.354 12.4769 11.354 12.4769C12.036 12.8955 12.5166 13.4997 12.7791 13.8899C12.0784 14.418 11.4083 14.7015 11.4083 14.7015C10.2592 15.1875 9 15.1875 9 15.1875C7.74079 15.1875 6.59172 14.7015 6.59172 14.7015ZM6.05746 11.5181C6.05746 11.5181 6.39649 11.3101 6.93432 11.1023C6.82429 11.0195 6.71668 10.9271 6.61351 10.824C6.61351 10.824 5.625 9.83547 5.625 8.4375C5.625 8.4375 5.625 7.03953 6.61351 6.05101C6.61351 6.05101 7.60203 5.0625 9 5.0625C9 5.0625 10.398 5.0625 11.3865 6.05101C11.3865 6.05101 12.375 7.03953 12.375 8.4375C12.375 8.4375 12.375 9.83547 11.3865 10.824C11.3865 10.824 11.2708 10.9397 11.0625 11.092C11.3547 11.2016 11.654 11.341 11.9425 11.5181C11.9425 11.5181 12.8853 12.0968 13.6153 13.1114C13.9039 12.7751 14.3886 12.148 14.7015 11.4083C14.7015 11.4083 15.1875 10.2592 15.1875 9C15.1875 9 15.1875 7.74079 14.7015 6.59172C14.7015 6.59172 14.2319 5.48143 13.3752 4.62478C13.3752 4.62478 12.5186 3.76813 11.4083 3.29851C11.4083 3.29851 10.2592 2.8125 9 2.8125C9 2.8125 7.74078 2.8125 6.59172 3.29851C6.59172 3.29851 5.48143 3.76813 4.62478 4.62478C4.62478 4.62478 3.76813 5.48143 3.29851 6.59172C3.29851 6.59172 2.8125 7.74078 2.8125 9C2.8125 9 2.8125 10.2592 3.29851 11.4083C3.29851 11.4083 3.68218 12.3154 4.38853 13.1224C4.73326 12.6405 5.2946 11.9864 6.05746 11.5181ZM10.591 10.0285C9.93198 10.6875 9 10.6875 9 10.6875C8.06802 10.6875 7.40901 10.0285 7.40901 10.0285C6.75 9.36948 6.75 8.4375 6.75 8.4375C6.75 7.50552 7.40901 6.84651 7.40901 6.84651C8.06802 6.1875 9 6.1875 9 6.1875C9.93198 6.1875 10.591 6.84651 10.591 6.84651C11.25 7.50552 11.25 8.4375 11.25 8.4375C11.25 9.36948 10.591 10.0285 10.591 10.0285Z"
                    fill="currentcolor"></path>
            </svg>
            <p>{{ $ikm->jenis_kelamin == "L" ? 'Laki - Laki' : 'Perempuan' }}</p>
        </div>
        <div class="flex items-center gap-1 text-xs text-black/40 dark:text-white/40">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M9 4.5C9 4.5 10.165 4.5 10.9887 5.32376C10.9887 5.32376 11.8125 6.14752 11.8125 7.3125C11.8125 7.3125 11.8125 8.47748 10.9887 9.30124C10.9887 9.30124 10.165 10.125 9 10.125C9 10.125 7.83502 10.125 7.01126 9.30124C7.01126 9.30124 6.1875 8.47748 6.1875 7.3125C6.1875 7.3125 6.1875 6.14752 7.01126 5.32376C7.01126 5.32376 7.83502 4.5 9 4.5ZM9 5.625C9 5.625 8.30101 5.625 7.80676 6.11926C7.80676 6.11926 7.3125 6.61351 7.3125 7.3125C7.3125 7.3125 7.3125 8.01149 7.80676 8.50574C7.80676 8.50574 8.30101 9 9 9C9 9 9.69899 9 10.1932 8.50574C10.1932 8.50574 10.6875 8.01149 10.6875 7.3125C10.6875 7.3125 10.6875 6.61351 10.1932 6.11926C10.1932 6.11926 9.69899 5.625 9 5.625Z"
                    fill="currentcolor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.7165 4.94465C14.7165 4.94465 15.1875 6.08173 15.1875 7.3125C15.1875 7.3125 15.1875 10.6869 12.237 14.08C12.237 14.08 11.3302 15.1228 10.2432 16.0468C10.2432 16.0468 9.69576 16.5121 9.32257 16.7733C9.12889 16.9089 8.87111 16.9089 8.67743 16.7733C8.67743 16.7733 8.30424 16.5121 7.75679 16.0468C7.75679 16.0468 6.66978 15.1228 5.76303 14.08C5.76303 14.08 2.8125 10.6869 2.8125 7.3125C2.8125 7.3125 2.8125 6.08173 3.2835 4.94465C3.2835 4.94465 3.75449 3.80756 4.62478 2.93728C4.62478 2.93728 5.49506 2.06699 6.63215 1.596C6.63215 1.596 7.76923 1.125 9 1.125C9 1.125 10.2308 1.125 11.3679 1.596C11.3679 1.596 12.5049 2.06699 13.3752 2.93728C13.3752 2.93728 14.2455 3.80756 14.7165 4.94465ZM14.0625 7.3125C14.0625 7.3125 14.0625 6.30551 13.6771 5.37516C13.6771 5.37516 13.2918 4.44483 12.5797 3.73277C12.5797 3.73277 11.8677 3.02072 10.9373 2.63536C10.9373 2.63536 10.007 2.25 9 2.25C9 2.25 7.99301 2.25 7.06266 2.63536C7.06266 2.63536 6.13232 3.02072 5.42027 3.73277C5.42027 3.73277 4.70822 4.44482 4.32286 5.37516C4.32286 5.37516 3.9375 6.30551 3.9375 7.3125C3.9375 7.3125 3.9375 10.2662 6.61197 13.3418C6.61197 13.3418 7.46303 14.3206 8.4854 15.1896C8.4854 15.1896 8.77076 15.4321 9 15.6113C9 15.6113 9.22924 15.4321 9.5146 15.1896C9.5146 15.1896 10.537 14.3206 11.388 13.3418C11.388 13.3418 14.0625 10.2662 14.0625 7.3125Z"
                    fill="currentcolor"></path>
            </svg>
            <p>
                {{ $ikm->kota->name ?? 'Kota Tidak ditemukan' }}
            </p>
        </div>
        <div class="flex items-center gap-1 text-xs text-black/40 dark:text-white/40">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M1.6875 13.5V3.9375C1.6875 3.62684 1.93934 3.375 2.25 3.375H15.75C16.0607 3.375 16.3125 3.62684 16.3125 3.9375V13.5C16.3125 13.5 16.3125 13.966 15.983 14.2955C15.983 14.2955 15.6535 14.625 15.1875 14.625H2.8125C2.8125 14.625 2.34651 14.625 2.01701 14.2955C2.01701 14.2955 1.6875 13.966 1.6875 13.5ZM2.8125 13.5H15.1875V4.5H2.8125V13.5Z"
                    fill="currentcolor"></path>
                <path
                    d="M2.6301 3.52285C2.52635 3.42775 2.39073 3.375 2.25 3.375C2.24185 3.375 2.23371 3.37518 2.22557 3.37553C2.07652 3.38201 1.93616 3.44743 1.83535 3.5574C1.74025 3.66115 1.6875 3.79677 1.6875 3.9375C1.6875 3.94565 1.68768 3.95379 1.68803 3.96193C1.69451 4.11098 1.75993 4.25134 1.8699 4.35215L8.6199 10.5396C8.83496 10.7368 9.16504 10.7368 9.3801 10.5396L16.1297 4.35249C16.2459 4.24595 16.3125 4.09517 16.3125 3.9375L16.3125 3.93282C16.3113 3.79371 16.2587 3.65996 16.1646 3.5574C16.0638 3.44743 15.9235 3.38201 15.7744 3.37553C15.7663 3.37518 15.7581 3.375 15.75 3.375L15.7474 3.37501C15.6076 3.37565 15.473 3.42836 15.3699 3.52285L9 9.36193L2.6301 3.52285Z"
                    fill="currentcolor"></path>
            </svg>
            <p>{{ $ikm->email ?? 'Email Tidak ditemukan'}} </p>
        </div>
    </div>
    <div
        class="grid grid-cols-1 sm:grid-cols-2 gap-8 md:gap-0 md:flex md:divide-x divide-black/10 dark:divide-white/10">
        <div class="md:pr-7 shrink-0">
            <p class="mb-1">Profile Completion</p>
            <div class="w-[163px] bg-black/5 dark:bg-white/5 rounded-lg overflow-hidden">
                <div class="bg-lightpurple-200 whitespace-nowrap text-center px-1.5 text-lg font-semibold text-black"
                    style="width: {{ $percentage }}%;">
                    {{ $percentage }}%
                </div>
            </div>
            @if ($emptyFields > 0)
            <p class="text-sm text-red-500 mt-1">Masih ada {{ $emptyFields }} data yang belum diisi.</p>
            @endif
        </div>
        <div class="md:px-7">
            <p class="mb-1">Earnings</p>
            <p class="text-lg font-semibold">$4,500</p>
        </div>
        <div class="md:px-7">
            <p class="mb-1">Produk</p>
            <p class="text-lg font-semibold">0</p>
        </div>
        <div class="md:pl-7">
            <p class="mb-1">Mitra</p>
            <p class="text-lg font-semibold">60%</p>
        </div>
    </div>
</div>

<form action="{{ route('ikm.update.action') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="px-2 py-1 mb-4 mt-3 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Detail Data</h2>
    
    <div class="flex flex-col sm:flex-row gap-3">
        <button
            type="submit"
            class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow transition duration-150"
        > Simpan 
        </button>

        <button
            type="button"
            onclick="confirmDelete('{{ route('ikm.delete', $id) }}')"
            class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow transition duration-150"
        >
            Hapus
        </button>
    </div>
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


    @if ($errors->any())
    <div class="bg-lightyellow/50 dark:bg-lightyellow border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
        role="alert">
        <strong class="font-bold">Oops!</strong>
        <span class="block sm:inline">Ada kesalahan pada input Anda:</span>
        <ul class="mt-2 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 2xl:grid-cols-2 gap-2">
        <input type="text" name="id" value="{{ $ikm->id }}" hidden>
        <div>
            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">NIK</label>
                <input type="text" name="nik" placeholder="NIK" class="form-input" maxlength="16"
                    value="{{ old('nik', $ikm->nik ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Nama</label>
                <input type="text" name="nama" placeholder="Nama" class="form-input"
                    value="{{ old('nama', $ikm->nama ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="form-input"
                    value="{{ old('tempat_lahir', $ikm->tempat_lahir ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-input"
                    value="{{ old('tanggal_lahir', $ikm->tanggal_lahir ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-input" id="jenis_kelamin">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('jenis_kelamin', $ikm->jenis_kelamin ?? '') == 'L' ? 'selected' : ''
                        }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $ikm->jenis_kelamin ?? '') == 'P' ? 'selected' : ''
                        }}>Perempuan</option>
                </select>
            </div>

            <!-- Alamat -->
            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Alamat</label>
                <input type="text" name="alamat" placeholder="Alamat" class="form-input"
                    value="{{ old('alamat', $ikm->alamat ?? '') }}" />
            </div>

            <div class="flex gap-3 mb-3">
                <div class="flex-1 py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                    <label class="block mb-1 text-xs text-black/40 dark:text-white/40">RT</label>
                    <input type="text" name="rt" placeholder="RT" class="form-input"
                        value="{{ old('rt', $ikm->rt ?? '') }}" />
                </div>
                <div class="flex-1 py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                    <label class="block mb-1 text-xs text-black/40 dark:text-white/40">RW</label>
                    <input type="text" name="rw" placeholder="RW" class="form-input"
                        value="{{ old('rw', $ikm->rw ?? '') }}" />
                </div>
            </div>
            <div class="py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5 mb-3">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Provinsi</label>
                <select id="provinsi" name="id_provinsi" class="form-select w-full">
                    <option value="" selected>Pilih Provinsi</option>
                    @foreach ($provinsi as $ikm2)
                    <option value="{{ $ikm2->id }}" {{ $ikm2->id == $ikm->id_provinsi ? 'selected' : ''}}>{{ $ikm2->name
                        }}</option>
                    @endforeach
                </select>
            </div>

            <div class="py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5 mb-3">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Kota / Kabupaten</label>
                <select id="kabupaten" name="id_kota" class="form-select w-full">
                    <option value="{{ $ikm->id_kota ?? '' }}" selected>{{ $ikm->kota->name ?? '' }}</option>
                </select>
            </div>

            <div class="py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5 mb-3">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Kecamatan</label>
                <select id="kecamatan" name="id_kecamatan" class="form-select w-full">
                    <option value="{{ $ikm->id_kecamatan ?? '' }}" selected>{{ $ikm->kecamatan->name ?? ''}}</option>
                </select>
            </div>
            <div class="py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5 mb-3">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Desa</label>
                <select id="desa" name="id_desa" class="form-select w-full">
                    <option value="{{ $ikm->id_desa ?? ''}}" selected>{{ $ikm->desa->name ?? '' }}</option>
                </select>
            </div>

            
        </div>
        <div>
            <div class="py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5 mb-3">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Agama</label>
                <select id="agama" name="agama" class="form-select w-full">
                    <option value="islam" {{ $ikm->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                    <option value="kristen" {{ $ikm->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="katolik" {{ $ikm->agama == 'katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="hindu" {{ $ikm->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="buddha" {{ $ikm->agama == 'budha' ? 'selected' : '' }}>Buddha</option>
                    <option value="konghucu" {{ $ikm->agama == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
                    <option value="kepercayaan" {{ $ikm->agama == 'kepercayaan' ? 'selected' : '' }}>Kepercayaan (Agama
                        Lokal)</option>
                </select>
            </div>

            <div class="py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5 mb-3">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Status </label>
                <select id="status_perkawinan" name="status_perkawinan" class="form-select w-full">
                    <option value="" selected>status perkawinan</option>
                    <option value="belum_menikah" {{ $ikm->status_perkawinan == 'belum_menikah' ? 'selected' : ''
                        }}>Belum Menikah</option>
                    <option value="menikah" {{ $ikm->status_perkawinan == 'menikah' ? 'selected' : '' }}>Menikah
                    </option>
                    <option value="cerai_hidup" {{ $ikm->status_perkawinan == 'cerai_hidup' ? 'selected' : '' }}>Cerai
                        Hidup</option>
                    <option value="cerai_mati" {{ $ikm->status_perkawinan == 'cerai_mati' ? 'selected' : '' }}>Cerai
                        Mati</option>
                </select>
            </div>


            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Pekerjaan</label>
                <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="form-input"
                    value="{{ old('pekerjaan', $ikm->pekerjaan ?? '') }}" />
            </div>

            <div class="py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5 mb-3">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Kewarganegaraan</label>
                <select id="kewarganegaraan" name="kewarganegaraan" class="form-select w-full">
                    <option value="" selected> Kewarganegaraan</option>
                    <option value="wni" {{ $ikm->kewarganegaraan == 'wni' ? 'selected' : '' }}>Warga Negara Indonesia
                        (WNI)</option>
                    <option value="wna" {{ $ikm->kewarganegaraan == 'wna' ? 'selected' : '' }}>Warga Negara Asing (WNA)
                    </option>
                </select>
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">No. Telepon</label>
                <input type="text" name="telp" placeholder="No. Telepon" class="form-input"
                    value="{{ old('telp', $ikm->telp ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Sosial Media</label>
                <input type="text" name="sosmed" placeholder="Sosial Media" class="form-input"
                    value="{{ old('sosmed', $ikm->sosmed ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Website</label>
                <input type="text" name="website" placeholder="Website" class="form-input"
                    value="{{ old('website', $ikm->website ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Email</label>
                <input type="email" name="email" placeholder="Email" class="form-input"
                    value="{{ old('email', $ikm->email ?? '') }}" />
            </div>





        </div>

    </div>

</form>

<!-- Modal for cropping -->
<div class="hidden fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50  justify-center items-center z-50">
    <!-- Modal Background (Overlay) -->
    <div class="absolute inset-0 bg-gray-800 bg-opacity-50 z-40"></div>

    <!-- Modal Container -->
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl relative z-50">
        <h3 class="text-2xl font-semibold mb-6 text-center">Crop Foto</h3>

    </div>
</div>
<!-- Modal Cropper -->
<div id="cropperModal" class="fixed inset-0 bg-black/60 dark:bg-white/10 z-[999] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4" @click.self="toggle">
        <div
            class="bg-white dark:bg-black relative shadow-3xl border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
            <div
                class="flex bg-white dark:bg-black border-b border-black/10 dark:border-white/10 items-center justify-between px-5 py-3">
                <h5 class="font-semibold text-lg">Tambah Mitra</h5>
                <button type="button" class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white"
                    @click="toggle">
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
            <div class="p-5">
                <div class="text-sm text-black dark:text-white">
                    <div class="relative">
                        <img id="image" src="" alt="Image" class="h-auto max-h-96 object-contain w-60">
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button id="cancelCrop"
                            class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</button>
                        <button id="saveCrop"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const imageInput = document.getElementById('image-input');
const preview = document.getElementById('preview');
const cropBtn = document.getElementById('crop-btn');
const submitBtn = document.getElementById('submit-btn');
const croppedFotoInput = document.getElementById('croppedFoto');
let cropper;

// Handle image input change
imageInput.addEventListener('change', (e) => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = () => {
      preview.src = reader.result;
      preview.style.display = 'block';
      cropBtn.style.display = 'inline';
      submitBtn.disabled = true;

      // Initialize cropper
      if (cropper) cropper.destroy();
      cropper = new Cropper(preview, {
        aspectRatio: 463 / 451, // Set aspect ratio for the desired dimensions
        viewMode: 1,            // Restrict crop box within the canvas
        autoCropArea: 1         // Maximize the crop box within the canvas
      });
    };
    reader.readAsDataURL(file);
  }
});

// Handle cropping
cropBtn.addEventListener('click', () => {
  const canvas = cropper.getCroppedCanvas({
    width: 463,  // Set width to 463px
    height: 451, // Set height to 451px
  });

  // Convert to Blob and Base64
  canvas.toBlob((blob) => {
    const reader = new FileReader();
    reader.onloadend = () => {
      croppedFotoInput.value = reader.result; // Base64 data for form
      preview.src = reader.result;
      cropper.destroy();
      cropBtn.style.display = 'none';
      submitBtn.disabled = false;
    };
    reader.readAsDataURL(blob);
  }, 'image/jpeg', 1.0); // Set image quality to 100%
});

</script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    let cropper; // Declare cropper instance
    const fotoInput = document.getElementById('foto');
    const previewImage = document.getElementById('preview');
    const cropperModal = document.getElementById('cropperModal');
    const image = document.getElementById('image');
    const cancelCropButton = document.getElementById('cancelCrop');
    const saveCropButton = document.getElementById('saveCrop');

    // Show modal and crop when a file is selected
    fotoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Show preview image
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                
                // Show modal for crop
                cropperModal.classList.remove('hidden');
                image.src = e.target.result;
                
                // Initialize Cropper.js
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    preview: '.preview', // Optional: for live preview
                });
            };
            reader.readAsDataURL(file);
        }
    });

    // Cancel crop and close modal
    cancelCropButton.addEventListener('click', function() {
        cropperModal.classList.add('hidden');
        cropper.destroy();
    });
});

</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
            $('#jenis_kelamin').select2({
                placeholder: "Pilih Jenis Kelamin",
                width: '100%'
            });
            $('#agama').select2({
                placeholder: "Agama",
                width: '100%'
            });
            $('#status_perkawinan').select2({
                placeholder: "Status Perkawinan",
                width: '100%'
            });
            $('#kewarganegaraan').select2({
                placeholder: "kewarganegaraan",
                width: '100%'
            });
            $('#provinsi').select2({
                placeholder: "Pilih Provinsi",
                width: '100%'
            });
            $('#kabupaten').select2({
                placeholder: "Pilih Kabupaten / Kota",
                width: '100%'
            });
            $('#kecamatan').select2({
                placeholder: "Pilih Kecamatan",
                width: '100%'
            });
            $('#desa').select2({
                placeholder: "Pilih Desa",
                width: '100%'
            });
        });
</script>

<script>
    document.addEventListener('alpine:init', () => {
    Alpine.data('modals', () => ({
        open: false,
        cropper: null,

        init() {
            this.$nextTick(() => {
                // Inisialisasi Cropper setelah modal muncul
                const image = document.getElementById('image');
                this.cropper = new Cropper(image, {
                    aspectRatio: 1, // Ubah sesuai kebutuhan
                    viewMode: 1,
                    autoCropArea: 0.8,
                    responsive: true,
                    modal: true,
                });
            });
        },

        toggle() {
            this.open = !this.open;
        },

        close() {
            this.open = false;
            // Hapus cropper dan reset gambar jika modal ditutup
            if (this.cropper) {
                this.cropper.destroy();
            }
        },

        saveCrop() {
            const croppedCanvas = this.cropper.getCroppedCanvas(); // Ambil gambar hasil crop

            // Ubah ke base64
            const croppedImage = croppedCanvas.toDataURL();

            // Kirim hasil gambar ke controller atau API
            this.uploadCroppedImage(croppedImage);
        },

        uploadCroppedImage(croppedImage) {
            // Contoh upload menggunakan fetch (AJAX)
            const formData = new FormData();
            formData.append('foto', croppedImage);

            fetch("{{ route('ikm.store') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}", // CSRF Token untuk keamanan
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Foto berhasil disimpan!');
                    this.close(); // Tutup modal setelah berhasil
                } else {
                    alert('Terjadi kesalahan saat menyimpan foto.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim data.');
            });
        }
    }));
});

</script>

<script>
    $(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
    

        $(function (){
            $('#provinsi').on('change',function(){
                let id_provinsi = $('#provinsi').val();

                $.ajax({
                    type : 'POST',
                    url : "{{route('getkabupaten')}}",
                    data : {id_provinsi:id_provinsi},
                    cache : false,

                    success: function(msg){
                        $('#kabupaten').removeAttr('disabled');
                        $('#kabupaten').html(msg);
                        $('#kecamatan').html('');
                        $('#desa').html('');

                    },
                    error: function(data) {
                        console.log('error:',data)
                    },
                })
            })


            $('#kabupaten').on('change',function(){
                let id_kabupaten = $('#kabupaten').val();

                $.ajax({
                    type : 'POST',
                    url : "{{route('getkecamatan')}}",
                    data : {id_kabupaten:id_kabupaten},
                    cache : false,

                    success: function(msg){
                        $('#kecamatan').removeAttr('disabled');
                        $('#kecamatan').html(msg);
                        $('#desa').html('');


                    },
                    error: function(data) {
                        console.log('error:',data)
                    },
                })
            })

            $('#kecamatan').on('change',function(){
                let id_kecamatan = $('#kecamatan').val();

                $.ajax({
                    type : 'POST',
                    url : "{{route('getdesa')}}",
                    data : {id_kecamatan:id_kecamatan},
                    cache : false,

                    success: function(msg){
                        $('#desa').removeAttr('disabled');
                        $('#desa').html(msg);


                    },
                    error: function(data) {
                        console.log('error:',data)
                    },
                })
            })
        })
    });
</script>
@endsection