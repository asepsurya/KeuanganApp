@extends('layout.main')
@section('title', 'Data IKM')
@section('css')
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/simple-datatables.css') }}" />
<style>
     @media (max-width: 768px) {
            .mobile {
                display: none;
            }
        }
        @media (max-width: 768px) {
            #myTable th:nth-child(4),
            #myTable td:nth-child(4),
            #myTable th:nth-child(5),
            #myTable td:nth-child(5),
            #myTable th:nth-child(6),
            #myTable td:nth-child(6) {
            display: none !important;
            }
}
</style>
@endsection
@section('container')
<div class="px-2 py-1 mb-4 flex items-center justify-between">
    <h2 class="text-lg font-semibold">Peoples</h2>
    <a href="{{ route('ikm.create') }}" class="px-2 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
        + Tambah Pengguna Baru
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-7 mb-4">
    <div class="bg-lightblue-100 rounded-2xl p-6">
        <p class="text-sm font-semibold text-black mb-2">Jumlah UMKM</p>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl leading-9 font-semibold text-black">{{ $ikm->count() }}</h2>
             <div class="flex items-center gap-1">
                <p class="text-xs leading-[18px] text-black">Pengguna</p>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.45488 5.60777L14 4L12.6198 9.6061L10.898 7.9532L8.12069 10.8463C8.02641 10.9445 7.89615 11 7.76 11C7.62385 11 7.49359 10.9445 7.39931 10.8463L5.36 8.72199L2.36069 11.8463C2.16946 12.0455 1.85294 12.0519 1.65373 11.8607C1.45453 11.6695 1.44807 11.3529 1.63931 11.1537L4.99931 7.65373C5.09359 7.55552 5.22385 7.5 5.36 7.5C5.49615 7.5 5.62641 7.55552 5.72069 7.65373L7.76 9.77801L10.1766 7.26067L8.45488 5.60777Z" fill="#1C1C1C"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="bg-lightpurple-100 rounded-2xl p-6">
        <p class="text-sm font-semibold text-black mb-2">Jumlah Laki-Laki</p>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl leading-9 font-semibold text-black">{{  $jumlah['L'] ?? 0; }}</h2>
            <div class="flex items-center gap-1">
                <p class="text-xs leading-[18px] text-black">Pengguna</p>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.45488 5.60777L14 4L12.6198 9.6061L10.898 7.9532L8.12069 10.8463C8.02641 10.9445 7.89615 11 7.76 11C7.62385 11 7.49359 10.9445 7.39931 10.8463L5.36 8.72199L2.36069 11.8463C2.16946 12.0455 1.85294 12.0519 1.65373 11.8607C1.45453 11.6695 1.44807 11.3529 1.63931 11.1537L4.99931 7.65373C5.09359 7.55552 5.22385 7.5 5.36 7.5C5.49615 7.5 5.62641 7.55552 5.72069 7.65373L7.76 9.77801L10.1766 7.26067L8.45488 5.60777Z" fill="#1C1C1C"></path>
                </svg>
            </div>
        </div>
    </div>
     <div class="bg-lightblue-100 rounded-2xl p-6">
        <p class="text-sm font-semibold text-black mb-2">Jumlah Perempuan</p>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl leading-9 font-semibold text-black">{{  $jumlah['P'] ?? 0; }}</h2>
             <div class="flex items-center gap-1">
                <p class="text-xs leading-[18px] text-black">Pengguna</p>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.45488 5.60777L14 4L12.6198 9.6061L10.898 7.9532L8.12069 10.8463C8.02641 10.9445 7.89615 11 7.76 11C7.62385 11 7.49359 10.9445 7.39931 10.8463L5.36 8.72199L2.36069 11.8463C2.16946 12.0455 1.85294 12.0519 1.65373 11.8607C1.45453 11.6695 1.44807 11.3529 1.63931 11.1537L4.99931 7.65373C5.09359 7.55552 5.22385 7.5 5.36 7.5C5.49615 7.5 5.62641 7.55552 5.72069 7.65373L7.76 9.77801L10.1766 7.26067L8.45488 5.60777Z" fill="#1C1C1C"></path>
                </svg>
            </div>
        </div>
    </div>
</div>
<div x-data="main" x-init="init()" class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-5 rounded-md">
    <div class="mb-1">
        <p class="text-sm font-semibold">Data Pengguna / UMKM</p>
    </div>
    <div class="border bg-white dark:bg-black border-black/10 dark:border-white/10 p-5 rounded-md" >
        <div class="table-responsive">
            <table id="myTable" class="whitespace-nowrap table-hover table-bordered "></table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/js/simple-datatables.js') }}"></script>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data('main', () => ({
            init() {
                this.loadData();
            }
            , loadData() {
                const rawData = @json($ikm);
                 // Tambahkan nomor urut di depan setiap baris
                const numberedData = rawData.map((row, index) => {
                    return [index + 1, ...row];
                });
                const table = new simpleDatatables.DataTable("#myTable", {
                    data: {
                        headings: ["No", "Nama","Gender","Alamat Kota", "No. Telepon", "Email"],
                        data: numberedData,
                    }
                    
                    , sortable: false
                    , searchable: true
                    , perPage: 10
                    , perPageSelect: [ 10, 20, 50, 100]
                    , firstLast: false
                    , firstText: `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
              <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
              <path opacity="0.5" d="M17 19L11 12L17 5" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>`
                    , lastText: `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
              <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
              <path opacity="0.5" d="M7 19L13 12L7 5" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>`
                    , prevText: `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
              <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
            </svg>`
                    , nextText: `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
              <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
            </svg>`
                    , labels: {
                        perPage: '{select}'
                    , }
                    , layout: {
                        top: '{select}{search}'
                        , bottom: '{info}{pager}'
                    , }
                , });
            }
        }));
    });

</script>
@endsection