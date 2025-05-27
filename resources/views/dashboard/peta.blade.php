@extends('layout.main')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #location-cards {
            scroll-behavior: smooth;
        }
        #map {
            height: 500px;
        }
    </style>
@endsection

@section('title', 'Peta Pemasaran')

@section('container')
    <div class="px-2 py-1 mb-4">
        <h2 class="text-lg font-semibold">Peta Pemasaran Saya</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-7 mb-5">
        <div class="bg-lightblue-100 rounded-2xl p-6">
            <p class="text-sm font-semibold text-black mb-2">Jumlah Titik Lokasi</p>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl leading-9 font-semibold text-black">721K</h2>
                <div class="flex items-center gap-1">
                    <p class="text-xs leading-[18px] text-black">+11.01%</p>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.45488 5.60777L14 4L12.6198 9.6061L10.898 7.9532L8.12069 10.8463C8.02641 10.9445 7.89615 11 7.76 11C7.62385 11 7.49359 10.9445 7.39931 10.8463L5.36 8.72199L2.36069 11.8463C2.16946 12.0455 1.85294 12.0519 1.65373 11.8607C1.45453 11.6695 1.44807 11.3529 1.63931 11.1537L4.99931 7.65373C5.09359 7.55552 5.22385 7.5 5.36 7.5C5.49615 7.5 5.62641 7.55552 5.72069 7.65373L7.76 9.77801L10.1766 7.26067L8.45488 5.60777Z" fill="#1C1C1C"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-lightpurple-100 rounded-2xl p-6">
            <p class="text-sm font-semibold text-black mb-2">Jumlah Mitra</p>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl leading-9 font-semibold text-black">367K</h2>
                <div class="flex items-center gap-1">
                    <p class="text-xs leading-[18px] text-black">+9.15%</p>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.45488 5.60777L14 4L12.6198 9.6061L10.898 7.9532L8.12069 10.8463C8.02641 10.9445 7.89615 11 7.76 11C7.62385 11 7.49359 10.9445 7.39931 10.8463L5.36 8.72199L2.36069 11.8463C2.16946 12.0455 1.85294 12.0519 1.65373 11.8607C1.45453 11.6695 1.44807 11.3529 1.63931 11.1537L4.99931 7.65373C5.09359 7.55552 5.22385 7.5 5.36 7.5C5.49615 7.5 5.62641 7.55552 5.72069 7.65373L7.76 9.77801L10.1766 7.26067L8.45488 5.60777Z" fill="#1C1C1C"></path>
                    </svg>
                </div>
            </div>
        </div>
    
    </div>
    <!-- Peta -->

    <div id="map" class="rounded w-full"></div>
    

    <!-- Kartu Lokasi -->
    <div id="location-cards" class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 pb-2 px-1">
        <!-- Diisi via JS -->
    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center gap-2 mt-4" id="pagination-controls">
        <button id="prev-btn" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Prev</button>
        <span id="page-info" class="text-sm text-gray-600">Page 1</span>
        <button id="next-btn" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Next</button>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Define map layers
        const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        });

        const satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles © Esri'
        });

        const dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '© CartoDB'
        });

        // Inisialisasi map
        const map = L.map('map', {
            center: [-6.200000, 106.816666],
            zoom: 10,
            layers: [osm]
        });

        const baseMaps = {
            "OpenStreetMap": osm,
            "Satelit": satellite,
            "Dark Mode": dark
        };

        L.control.layers(baseMaps).addTo(map);

        // Data lokasi
        const titikAwal = [
            { lat: -6.2, lng: 106.8, label: "Lokasi A" },
            { lat: -6.3, lng: 106.85, label: "Lokasi B" },
            { lat: -6.25, lng: 106.75, label: "Lokasi C" },
            { lat: -6.26, lng: 106.76, label: "Lokasi D" },
            { lat: -6.27, lng: 106.77, label: "Lokasi E" },
            { lat: -6.28, lng: 106.78, label: "Lokasi F" },
            { lat: -6.29, lng: 106.79, label: "Lokasi G" },
            { lat: -6.30, lng: 106.80, label: "Lokasi H" },
            { lat: -6.31, lng: 106.81, label: "Lokasi I" },
            { lat: -6.32, lng: 106.82, label: "Lokasi J" },
            { lat: -6.33, lng: 106.83, label: "Lokasi K" },
            { lat: -6.34, lng: 106.84, label: "Lokasi L" },
            { lat: -6.35, lng: 106.85, label: "Lokasi M" },
        ];

        const locationCardsContainer = document.getElementById('location-cards');
        const pageInfo = document.getElementById('page-info');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');

        const perPage = 12;
        let currentPage = 1;
        const totalPages = Math.ceil(titikAwal.length / perPage);

        function renderPage(page) {
            locationCardsContainer.innerHTML = '';
            map.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            const start = (page - 1) * perPage;
            const end = start + perPage;
            const pageData = titikAwal.slice(start, end);

            pageData.forEach((titik) => {
                const marker = L.marker([titik.lat, titik.lng]).addTo(map).bindPopup(titik.label);

                const card = document.createElement('div');
                card.className = "border border-black/10 dark:border-white/10 p-5 rounded-md shadow-sm hover:shadow-md cursor-pointer transition-all duration-300";
                card.innerHTML = `
                    <div class="font-semibold text-gray-800">${titik.label}</div>
                    <div class="text-sm text-gray-500">${titik.lat.toFixed(3)}, ${titik.lng.toFixed(3)}</div>
                `;
                card.addEventListener('click', () => {
                    map.setView([titik.lat, titik.lng], 14);
                    marker.openPopup();
                });

                locationCardsContainer.appendChild(card);
            });

            pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage === totalPages;
        }

        prevBtn.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderPage(currentPage);
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderPage(currentPage);
            }
        });

        renderPage(currentPage);
    </script>
@endsection
