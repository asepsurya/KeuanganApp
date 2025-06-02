@extends('layout.main')
@section('title', 'Data Akun')
@section('container')
    <div class="px-2 py-1 mb-4 flex items-center justify-between">
        <h2 class="text-lg font-semibold">History Rekening</h2>
        <a href="" target="_blank" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8.828a2 2 0 0 0-.586-1.414l-4.828-4.828A2 2 0 0 0 13.172 2H6zm7 1.414L19.586 10H15a2 2 0 0 1-2-2V3.414zM8 15h8v2H8v-2zm0-4h8v2H8v-2z" fill="currentColor"/>
            </svg>
            Cetak PDF
        </a>
    </div>
    <div class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-5 rounded-md">
    <table class="table table-bordered  mt-3">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($histories as $index => $history)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $history->tanggal }}</td>
                <td>{{ $history->keterangan }}</td>
                <td>{{ number_format($history->debit, 0, ',', '.') }}</td>
                <td>{{ number_format($history->kredit, 0, ',', '.') }}</td>
                <td>{{ number_format($history->saldo, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data history rekening.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection