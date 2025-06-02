
@extends('layout.main')
@section('title', 'Data Akun')
@section('container')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
<style>
/* FullCalendar border color for dark mode */
.dark .fc-theme-standard .fc-scrollgrid,
.dark .fc-theme-standard td,
.dark .fc-theme-standard th,
.dark .fc-theme-standard .fc-daygrid-day,
.dark .fc-theme-standard .fc-daygrid-day-frame,
.dark .fc-theme-standard .fc-col-header-cell,
.dark .fc-theme-standard .fc-daygrid-day-top,
.dark .fc-theme-standard .fc-scrollgrid-section,
.dark .fc-theme-standard .fc-scrollgrid-sync-table,
.dark .fc-theme-standard .fc-scrollgrid-sync-inner {
    border-color: #343434 !important;
}
</style>
<div class="flex flex-col md:flex-row justify-between items-center mb-6 border-b border-gray-300 dark:border-[#343434] pb-4 gap-4">
    <div>
        <h1 class="text-2xl font-bold mb-1 text-gray-800 dark:text-gray-100">Kalender Keuangan</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Pantau pemasukan dan pengeluaran Anda setiap hari dalam satu tampilan kalender.</p>
    </div>
    <div class="flex items-center gap-3">
        <label for="monthPicker" class="font-medium text-gray-700 dark:text-gray-200">Filter Bulan:</label>
        <select id="monthPicker" class="form-select py-2.5 px-4 w-full text-black dark:text-white border border-black/10 dark:border-white/10 rounded-lg placeholder:text-black/20 dark:placeholder:text-white/20 focus:border-black dark:focus:border-white/10 focus:ring-0 focus:shadow-none;" style="width: 220px;">
            @for ($i = 1; $i <= 12; $i++)
                @php
                    $val = date('Y') . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                @endphp
                <option value="{{ $val }}" {{ now()->format('Y-m') === $val ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::createFromFormat('Y-m', date('Y') . '-' . str_pad($i, 2, '0', STR_PAD_LEFT))->translatedFormat('F Y') }}
                </option>
            @endfor
        </select>
    </div>
</div>

<div id="calendar" class="rounded-md  rounded-lg shadow-md p-2"></div>

<!-- Modal Structure -->
<div id="detailModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); align-items:center; justify-content:center;">
    <div class=" bg-white dark:bg-black relative shadow-3xl border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8 rounded-lg max-w-[500px] w-[90vw] max-h-[80vh] overflow-auto shadow-xl relative transition-colors duration-200">
        <button id="closeModal" class="absolute top-2 right-3 text-2xl text-gray-700 dark:text-gray-200 bg-transparent border-none cursor-pointer" style="background:none;">&times;</button>
        <div class="p-6 pt-8">
            <h5 id="modalTanggal" class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3"></h5>
            <div style="overflow-y:auto; max-height:50vh;">
                <table class="table table-bordered w-full text-sm">
                    <thead >
                        <tr>
                            <th id="modalPemasukan" colspan="2" class="text-left text-green-700 dark:text-green-400 bg-gray-100 dark:bg-black"></th>
                            <th id="modalPengeluaran" class="text-left text-green-700 dark:text-green-400 bg-gray-100 dark:bg-black"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th class="bg-gray-50 dark:bg-[#23272f] text-gray-700 dark:text-gray-200">Tipe</th>
                            <th class="bg-gray-50 dark:bg-[#23272f] text-gray-700 dark:text-gray-200">Deskripsi</th>
                            <th class="bg-gray-50 dark:bg-[#23272f] text-gray-700 dark:text-gray-200">Total</th>
                        </tr>
                    </thead>
                    <tbody id="modalDetailBody" class="text-gray-800 dark:text-gray-100"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const monthPicker = document.getElementById('monthPicker');
    
    // Ambil data JSON dari blade (pastikan $data dikirim dari controller)
    const rawData = @json($data);

    function fetchEvents(tahun, bulan) {
        // Filter dan mapping data sesuai bulan & tahun yang dipilih
        const events = rawData
            .filter(item => {
                // item.tanggal format: d/m/Y
                const [day, mon, yr] = item.tanggal.split('/');
                return mon === bulan && yr === tahun;
            })
            .reduce((acc, item) => {
                // Group by tanggal
                let group = acc.find(g => g.tanggal === item.tanggal);
                if (!group) {
                    group = { tanggal: item.tanggal, detail: [] };
                    acc.push(group);
                }
                group.detail.push({
                    tipe: item.tipe,
                    total: item.total,
                    deskripsi: item.deskripsi
                });
                return acc;
            }, [])
            .map(item => {
                let pemasukan = 0;
                let pengeluaran = 0;
                item.detail.forEach(d => {
                    if (d.tipe === 'pemasukan') pemasukan += Number(d.total);
                    else if (d.tipe === 'pengeluaran') pengeluaran += Number(d.total);
                });
                let title = '';
                if (pemasukan > 0) title += `Masuk : Rp.${pemasukan.toLocaleString()}\n`;
                if (pengeluaran > 0) title += `Keluar : Rp.${pengeluaran.toLocaleString()}`;
                // Convert tanggal d/m/Y ke Y-m-d
                const [day, mon, yr] = item.tanggal.split('/');
                return {
                    title: title.trim(),
                    start: `${yr}-${mon.padStart(2, '0')}-${day.padStart(2, '0')}`,
                    tanggal: item.tanggal,
                    detail: item.detail,
                    allDay: true
                };
            });
        return Promise.resolve(events);
    }

    function loadCalendar() {
        const [tahun, bulan] = monthPicker.value.split('-');
        const calendarEl = document.getElementById('calendar');
        calendarEl.innerHTML = ''; // Reset DOM

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: `${tahun}-${bulan}-01`,
            events: function(fetchInfo, successCallback, failureCallback) {
                fetchEvents(tahun, bulan)
                    .then(events => successCallback(events))
                    .catch(error => failureCallback(error));
            },
            eventDidMount: function(info) {
                const title = info.event.title.replace(/\n/g, '<br>');
                info.el.querySelector('.fc-event-title').innerHTML = title;
            },
            eventClick: function(info) {
                const detail = info.event.extendedProps.detail || [];
                const tanggal = info.event.extendedProps.tanggal;
                // tanggal format: d/m/Y
                const [day, mon, yr] = tanggal.split('/');
                const dateObj = new Date(`${yr}-${mon}-${day}`);
                const hari = dateObj.toLocaleDateString('id-ID', { weekday: 'long' });
                const bulan = dateObj.toLocaleDateString('id-ID', { month: 'long' });
                const formatted = `${hari}, ${day} ${bulan} ${yr}`;
                document.getElementById('modalTanggal').textContent = formatted;
                const tbody = document.getElementById('modalDetailBody');

                let pemasukan = 0;
                let pengeluaran = 0;
                detail.forEach(d => {
                    if (d.tipe === 'pemasukan') pemasukan += Number(d.total);
                    else if (d.tipe === 'pengeluaran') pengeluaran += Number(d.total);
                });
                document.getElementById('modalPemasukan').textContent = `Pemasukan: Rp${pemasukan.toLocaleString()}`;
                document.getElementById('modalPengeluaran').textContent = `Pengeluaran: Rp${pengeluaran.toLocaleString()}`;
                tbody.innerHTML = '';
                detail.forEach(d => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${d.tipe}</td>
                        <td>${d.deskripsi}</td>
                        <td>Rp${Number(d.total).toLocaleString()}</td>
                    `;
                    tbody.appendChild(tr);
                });
                document.getElementById('detailModal').style.display = 'flex';
            }
        });

        calendar.render();
    }

    loadCalendar();
    monthPicker.addEventListener('change', loadCalendar);

    // Modal close
    document.getElementById('closeModal').onclick = () => {
        document.getElementById('detailModal').style.display = 'none';
    };
    document.getElementById('detailModal').onclick = function(e) {
        if (e.target === this) this.style.display = 'none';
    };
});
</script>
@endsection

