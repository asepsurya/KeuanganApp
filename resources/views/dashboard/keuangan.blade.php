@extends('layout.main')
@section('title', 'Dashboard Keuangan')
@section('css')
@endsection
@section('container')
  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg sm:text-xl font-bold ">Ringkasan Keuangan</h2>
    <a href="{{ route('index.keuangan') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
        Lihat Transaksi
        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
    </a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-7 mb-4">
    <div class="bg-lightblue-100 rounded-2xl p-4 sm:p-6">
        <p class="text-sm font-semibold text-black mb-2">Pemasukan</p>
        <div class="flex items-center justify-between flex-wrap">
            <h2 class="text-xl sm:text-2xl leading-8 sm:leading-9 font-semibold text-black">
                @php
                    $totalPemasukan = $transaksi->where('tipe', 'pemasukan')->sum('total');
                @endphp
                Rp.{{ number_format($totalPemasukan, 0, ',', '.') }}
            </h2>
            <div class="flex items-center gap-1 mt-2 sm:mt-0">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.45488 5.60777L14 4L12.6198 9.6061L10.898 7.9532L8.12069 10.8463C8.02641 10.9445 7.89615 11 7.76 11C7.62385 11 7.49359 10.9445 7.39931 10.8463L5.36 8.72199L2.36069 11.8463C2.16946 12.0455 1.85294 12.0519 1.65373 11.8607C1.45453 11.6695 1.44807 11.3529 1.63931 11.1537L4.99931 7.65373C5.09359 7.55552 5.22385 7.5 5.36 7.5C5.49615 7.5 5.62641 7.55552 5.72069 7.65373L7.76 9.77801L10.1766 7.26067L8.45488 5.60777Z"
                        fill="#1C1C1C"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="bg-lightpurple-100 rounded-2xl p-4 sm:p-6">
        <p class="text-sm font-semibold text-black mb-2">Pengeluaran</p>
        <div class="flex items-center justify-between flex-wrap">
            <h2 class="text-xl sm:text-2xl leading-8 sm:leading-9 font-semibold text-black">
                @php
                    $totalPengeluaran = $transaksi->where('tipe', 'pengeluaran')->sum('total');
                @endphp
                Rp.{{ number_format($totalPengeluaran, 0, ',', '.') }}
            </h2>
            <div class="flex items-center gap-1 mt-2 sm:mt-0">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.54512 10.3922L2 12L3.3802 6.3939L5.10201 8.0468L7.87931 5.1537C7.97359 5.05548 8.10385 5 8.24 5C8.37615 5 8.50641 5.05548 8.60069 5.1537L10.64 7.27801L13.6393 4.1537C13.8305 3.95447 14.1471 3.94807 14.3463 4.13931C14.5455 4.33054 14.5519 4.64706 14.3607 4.8463L11.0007 8.34627C10.9064 8.44448 10.7762 8.5 10.64 8.5C10.5038 8.5 10.3736 8.44448 10.2793 8.34627L8.24 6.22199L5.82341 8.73933L7.54512 10.3922Z"
                        fill="#E53E3E"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="bg-lightblue-100 rounded-2xl p-4 sm:p-6">
        <p class="text-sm font-semibold text-black mb-2">Saldo</p>
        <div class="flex items-center justify-between flex-wrap">
            <h2 class="text-xl sm:text-2xl leading-8 sm:leading-9 font-semibold text-black">
                @php
                    $totalPemasukan = $transaksi->where('tipe', 'pemasukan')->sum('total');
                    $totalPengeluaran = $transaksi->where('tipe', 'pengeluaran')->sum('total');
                    $labaBersih = $totalPemasukan - $totalPengeluaran;
                @endphp
                Rp.{{ number_format($labaBersih, 0, ',', '.') }}
            </h2>
            <div class="flex items-center gap-1 mt-2 sm:mt-0">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="10" stroke="#2563eb" stroke-width="2" fill="#e0f2fe"/>
                    <path d="M8 12h8M12 8v8" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="w-full mt-6 sm:mt-8 mb-6 sm:mb-8">
    <h3 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4 text-center">Grafik Pemasukan & Pengeluaran</h3>
    <div class="w-full overflow-x-auto">
        <canvas id="lineChart" height="120"></canvas>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-7">
    <!-- Left: Donut Chart & Account Info -->
    <div class="bg-lightwhite dark:bg-white/5 p-4 sm:p-6 rounded-2xl flex flex-col items-center shadow-md">
        <h3 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">Pengeluaran per Akun</h3>
        <div class="w-full flex justify-center">
            <canvas id="donutChart" width="220" height="220" class="max-w-[220px] w-full h-auto"></canvas>
        </div>

        <div class="w-full mt-6">
            <h3 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4 text-center">Grafik Boundaries Penggunaan Rekening</h3>
            <div class="w-full overflow-x-auto">
                <canvas id="boundariesLineChart" height="120"></canvas>
            </div>
        </div>
        <script>
        window.addEventListener('load', function () {
            const boundariesChartCanvas = document.getElementById('boundariesLineChart');
            if (boundariesChartCanvas && window.Chart) {
                // Data: labels = nama akun, data = total transaksi per akun
                const akunLabels = @json($akun->pluck('nama_akun'));
                const akunTotals = @json(
                    $akun->map(function($a) use ($transaksi) {
                        return $transaksi->where('id_akun', $a->id)->sum('total');
                    })
                );
                const colors = ['#2563eb', '#a78bfa', '#fbbf24', '#ef4444', '#10b981', '#f472b6', '#f59e42', '#6366f1'];

                new Chart(boundariesChartCanvas.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: akunLabels,
                        datasets: [{
                            label: 'Total Penggunaan Rekening',
                            data: akunTotals,
                            borderColor: '#2563eb',
                            backgroundColor: 'rgba(37,99,235,0.1)',
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: colors,
                            pointBorderColor: colors,
                            pointRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp.' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
        </script>
    </div>

    <!-- Right: Progress Table -->
    <div class="bg-lightwhite dark:bg-white/5 p-4 sm:p-6 rounded-2xl shadow-md overflow-x-auto">
        <h3 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">Persentase Penggunaan Akun</h3>
        @php
            $totalPengeluaran = $transaksi->where('tipe', 'pengeluaran')->sum('total');
        @endphp
        <table class="w-full min-w-[320px]">
            <thead>
                <tr>
                    <th class="text-left py-2 text-gray-700 dark:text-gray-200">Akun</th>
                    <th class="text-left py-2 text-gray-700 dark:text-gray-200">Persentase</th>
                    <th class="text-left py-2 text-gray-700 dark:text-gray-200">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($akun as $a)
                    @php
                        $totalAkun = $transaksi->where('id_akun', $a->id)->where('tipe', 'pengeluaran')->sum('total');
                        $percent = $totalPengeluaran > 0 ? ($totalAkun / $totalPengeluaran) * 100 : 0;
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition cursor-pointer" onclick="showAkunDetailModal({{ $a->id }})">
                        <td class="py-2 text-gray-800 dark:text-gray-100">{{ $a->nama_akun }}</td>
                        <td class="py-2 w-2/5">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                <div class="h-3 rounded-full transition-all duration-300" style="width: {{ $percent }}%; background-color: #2563eb;"></div>
                            </div>
                            <span class="text-xs text-gray-600 dark:text-gray-400">{{ number_format($percent, 1) }}%</span>
                        </td>
                        <td class="py-2 text-gray-800 dark:text-gray-100">Rp.{{ number_format($totalAkun, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                <!-- Modal Detail Akun -->
                <div id="akunDetailModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
                        <button onclick="closeAkunDetailModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                            &times;
                        </button>
                        <h3 class="text-lg font-semibold mb-4" id="akunDetailTitle">Detail Akun</h3>
                        <div id="akunDetailContent">
                            <!-- Konten detail akun akan dimuat di sini -->
                        </div>
                    </div>
                </div>

                <script>
                function showAkunDetailModal(akunId) {
                    // Ambil data transaksi akun dari variabel JS yang di-generate dari PHP
                    const akunData = window.akunTransaksiData[akunId] || [];
                    const akunName = window.akunNamaData[akunId] || 'Akun';
                    document.getElementById('akunDetailTitle').textContent = 'Detail Akun: ' + akunName;

                    let html = '';
                    if (akunData.length === 0) {
                        html = '<div class="text-gray-500 text-center py-4">Tidak ada transaksi untuk akun ini.</div>';
                    } else {
                        html = `
                            <table class="w-full text-sm">
                                <thead>
                                    <tr>
                                        <th class="py-2 text-left">Tanggal</th>
                                        <th class="py-2 text-left">Deskripsi</th>
                                        <th class="py-2 text-right">Total</th>
                                        <th class="py-2 text-left">Tipe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${akunData.map(trx => `
                                        <tr>
                                            <td class="py-1">${trx.tanggal}</td>
                                            <td class="py-1">${trx.deskripsi || '-'}</td>
                                            <td class="py-1 text-right">Rp.${Number(trx.total).toLocaleString('id-ID')}</td>
                                            <td class="py-1">${trx.tipe}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        `;
                    }
                    document.getElementById('akunDetailContent').innerHTML = html;
                    // Tambahkan overlay gelap pada background modal
                    const modal = document.getElementById('akunDetailModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    modal.style.background = 'rgba(0,0,0,0.5)';
                    modal.style.zIndex = '9999'; // Tambah z-index agar modal di depan
                }
                function closeAkunDetailModal() {
                    document.getElementById('akunDetailModal').classList.add('hidden');
                }

                // Data transaksi per akun untuk modal (di-generate dari PHP)
                   window.akunTransaksiData = {};
                    window.akunNamaData = {};

                    @foreach($akun as $a)
                        window.akunTransaksiData[{{ $a->id }}] = {!! json_encode(
                            $transaksi->where('id_akun', $a->id)->map(function($trx) {
                                return [
                                    'tanggal' => $trx->tanggal,
                                    'deskripsi' => $trx->deskripsi,
                                    'total' => $trx->total,
                                    'tipe' => $trx->tipe,
                                ];
                            })->values()
                        ) !!};

                        window.akunNamaData[{{ $a->id }}] = {!! json_encode($a->nama_akun) !!};
                    @endforeach
                </script>
            </tbody>
        </table>
    </div>
</div>

<div class="bg-lightwhite dark:bg-white/5 p-4 sm:p-6 rounded-2xl shadow-md mt-6 sm:mt-8 overflow-x-auto">
    <h3 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">Total Transaksi per Akun</h3>
    <table class="w-full min-w-[320px]">
        <thead>
            <tr>
                <th class="text-left py-2 text-gray-700 dark:text-gray-200">Akun</th>
                <th class="text-left py-2 text-gray-700 dark:text-gray-200">Warna</th>
                <th class="text-left py-2 text-gray-700 dark:text-gray-200">Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $colors = ['#2563eb', '#a78bfa', '#fbbf24', '#ef4444', '#10b981', '#f472b6', '#f59e42', '#6366f1'];
            @endphp
            @foreach($akun as $i => $a)
                @php
                    $totalAkun = $transaksi->where('id_akun', $a->id)->whereIn('tipe', ['pemasukan', 'pengeluaran'])->sum('total');
                    $color = $colors[$i % count($colors)];
                @endphp
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    <td class="py-2 text-gray-800 dark:text-gray-100">{{ $a->nama_akun }}</td>
                    <td class="py-2">
                        <span class="inline-block w-4 h-4 rounded-full" style="background: {{ $color }}"></span>
                    </td>
                    <td class="py-2 text-gray-800 dark:text-gray-100">Rp.{{ number_format($totalAkun, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
window.addEventListener('load', function () {
    // Donut Chart (Pengeluaran per Akun)
    const chartCanvas = document.getElementById('donutChart');
    if (chartCanvas && window.Chart) {
        const ctx = chartCanvas.getContext('2d');
        const akunLabels = @json($akun->pluck('nama_akun'));
        const akunTotals = @json(
            $akun->map(function($a) use ($transaksi) {
                return $transaksi->where('id_akun', $a->id)->where('tipe', 'pengeluaran')->sum('total');
            })
        );
        const colors = ['#2563eb', '#a78bfa', '#fbbf24', '#ef4444', '#10b981', '#f472b6', '#f59e42', '#6366f1'];

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: akunLabels,
                datasets: [{
                    data: akunTotals,
                    backgroundColor: colors,
                    borderWidth: 1
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Line Chart (Pemasukan & Pengeluaran per bulan)
    const lineChartCanvas = document.getElementById('lineChart');
    if (lineChartCanvas && window.Chart) {
        const bulanLabels = @json($bulanLabels);
        const pemasukanData = @json($pemasukanPerBulan);
        const pengeluaranData = @json($pengeluaranPerBulan);

        new Chart(lineChartCanvas.getContext('2d'), {
            type: 'line',
            data: {
                labels: bulanLabels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: pemasukanData,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Pengeluaran',
                        data: pengeluaranData,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239,68,68,0.1)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp.' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>

@endsection
