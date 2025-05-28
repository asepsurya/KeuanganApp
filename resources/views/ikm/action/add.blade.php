@extends('layout.main')
@section('title', 'Tambah IKM')
@section('container')
<form action="{{ route('ikm.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="px-2 py-1 mb-4 flex items-center justify-between">
        <h2 class="text-lg font-semibold">Tambah IKM</h2>
        <button class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition ">+ Simpan Data</button>
    </div>

    @if ($errors->any())
        <div class="bg-lightyellow/50 dark:bg-lightyellow border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
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
            <div>
            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">NIK</label>
                <input type="text" name="nik" placeholder="NIK" class="form-input" value="{{ old('nik', $item->nik ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Nama</label>
                <input type="text" name="nama" placeholder="Nama" class="form-input" value="{{ old('nama', $item->nama ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="form-input" value="{{ old('tempat_lahir', $item->tempat_lahir ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-input" value="{{ old('tanggal_lahir', $item->tanggal_lahir ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-input">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('jenis_kelamin', $item->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $item->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <!-- Alamat -->
            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Alamat</label>
                <input type="text" name="alamat" placeholder="Alamat" class="form-input" value="{{ old('alamat', $item->alamat ?? '') }}" />
            </div>

            <div class="flex gap-3 mb-3">
                <div class="flex-1 py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                    <label class="block mb-1 text-xs text-black/40 dark:text-white/40">RT</label>
                    <input type="text" name="rt" placeholder="RT" class="form-input" value="{{ old('rt', $item->rt ?? '') }}" />
                </div>
                <div class="flex-1 py-4 px-5 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                    <label class="block mb-1 text-xs text-black/40 dark:text-white/40">RW</label>
                    <input type="text" name="rw" placeholder="RW" class="form-input" value="{{ old('rw', $item->rw ?? '') }}" />
                </div>
            </div>

            <!-- Lokasi (bisa jadi dropdown jika ada data) -->
            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Provinsi (ID)</label>
                <input type="text" name="id_provinsi" placeholder="ID Provinsi" class="form-input" value="{{ old('id_provinsi', $item->id_provinsi ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Kota (ID)</label>
                <input type="text" name="id_kota" placeholder="ID Kota" class="form-input" value="{{ old('id_kota', $item->id_kota ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Kecamatan (ID)</label>
                <input type="text" name="id_kecamatan" placeholder="ID Kecamatan" class="form-input" value="{{ old('id_kecamatan', $item->id_kecamatan ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Desa (ID)</label>
                <input type="text" name="id_desa" placeholder="ID Desa" class="form-input" value="{{ old('id_desa', $item->id_desa ?? '') }}" />
            </div>

            <!-- Lainnya -->
            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Agama</label>
                <input type="text" name="agama" placeholder="Agama" class="form-input" value="{{ old('agama', $item->agama ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Status Perkawinan</label>
                <input type="text" name="status_perkawinan" placeholder="Status Perkawinan" class="form-input" value="{{ old('status_perkawinan', $item->status_perkawinan ?? '') }}" />
            </div>

            <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Pekerjaan</label>
                <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="form-input" value="{{ old('pekerjaan', $item->pekerjaan ?? '') }}" />
            </div>
        </div>
            <div>
               

                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" placeholder="Kewarganegaraan" class="form-input" value="{{ old('kewarganegaraan', $item->kewarganegaraan ?? '') }}" />
                    </div>

                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">No. Telepon</label>
                        <input type="text" name="telp" placeholder="No. Telepon" class="form-input" value="{{ old('telp', $item->telp ?? '') }}" />
                    </div>

                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Sosial Media</label>
                        <input type="text" name="sosmed" placeholder="Sosial Media" class="form-input" value="{{ old('sosmed', $item->sosmed ?? '') }}" />
                    </div>

                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Website</label>
                        <input type="text" name="website" placeholder="Website" class="form-input" value="{{ old('website', $item->website ?? '') }}" />
                    </div>

                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Email</label>
                        <input type="email" name="email" placeholder="Email" class="form-input" value="{{ old('email', $item->email ?? '') }}" />
                    </div>

                    <div class="py-4 px-5 mb-3 bg-white rounded-lg border border-black/10 relative dark:bg-white/5">
                        <label class="block mb-1 text-xs text-black/40 dark:text-white/40">Foto</label>
                        <input type="file" name="foto" class="form-input" />
                        @if (!empty($item->foto))
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="mt-2 w-20 h-20 object-cover rounded" />
                        @endif
                    </div>

               
            </div>

        </div>
    </form>
@endsection
