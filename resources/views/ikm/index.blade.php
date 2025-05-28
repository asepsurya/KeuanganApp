@extends('layout.main')
@section('title', 'Data IKM')
@section('css')
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/simple-datatables.css') }}" />
@endsection
@section('container')
<div class="px-2 py-1 mb-4 flex items-center justify-between">
    <h2 class="text-lg font-semibold">Peoples <span class="px-1 bg-lightgreen-100 text-xs text-black rounded ml-1">2</span></h2>
    <a href="{{ route('ikm.create') }}" class="px-2 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
        + Tambah Produk Baru
    </a>
</div>
<div x-data="main" x-init="init()" class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-5 rounded-md">
    <div class="mb-1">
        <p class="text-sm font-semibold">Captions with icon</p>
    </div>
    <div class="overflow-auto">
        <table id="myTable" class="whitespace-nowrap table-hover table-bordered w-full"></table>
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
                        headings: ["No", "Nama", "Alamat", "No. Telepon", "Email"],
                        data: numberedData,
                    }
                    , sortable: false
                    , searchable: true
                    , perPage: 5
                    , perPageSelect: [5, 10, 20, 50, 100]
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