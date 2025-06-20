<nav class="sidebar fixed top-0 bottom-0 left-0 z-40 bg-white dark:bg-gray-900 w-[212px] border-r border-black/10 dark:border-white/10 transition-all duration-300" >
  <!-- sidebar content -->
    <div class="bg-white dark:bg-black h-full">
        <!-- Start Logo -->
   <div class="flex items-center p-4">
    <!-- Logo Bulat -->
    
       
    <div
    class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0 bg-white dark:bg-transparent border border-gray-200 dark:border-white/20 flex items-center justify-center">
    
    <!-- Logo normal (light mode) -->
    <img src="{{ $perusahaan_sidebar->logo ? asset('storage/' . $perusahaan_sidebar->logo) : asset('assets/default_logo.png') }}" 
         alt="logo"
         class="w-full h-full object-contain block dark:hidden" />

    <!-- Logo dark mode -->
    <img src="{{ $perusahaan_sidebar->logo ? asset('storage/' . $perusahaan_sidebar->logo) : asset('assets/default_logo.png') }}" 
         alt="logo"
         class="w-full h-full object-contain hidden dark:block" />
</div>

<!-- Nama Perusahaan dengan tooltip -->
<div class="ml-3 flex-1 max-w-full group flex items-center">
    <span
        class="block font-semibold text-gray-800 dark:text-white text-sm leading-snug line-clamp-2 cursor-default"
        title="{{ $perusahaan_sidebar->nama_perusahaan }}">
        {{ $perusahaan_sidebar->nama_perusahaan }}
    </span>
</div>

</div>




        <!-- End Logo -->
        <!-- Start Menu -->
        <ul class="relative h-[calc(100vh-58px)] flex flex-col gap-1 overflow-y-auto overflow-x-hidden p-4 py-0"
            x-data="{ activeMenu: '{{ $activeMenu }}' }" id="menu">
            <li class="menu nav-item mb-3">
                @include('layout.partial.seachmenu')
            </li>

            {{-- Dashboard --}}

            <li class="menu nav-item">
                <a href="javaScript:;" class="nav-link group text-black dark:text-white active"
                    :class="{ 'active': activeMenu === 'dashboard' }"
                    @click="activeMenu === 'dashboard' ? activeMenu = null : activeMenu = 'dashboard'">
                    <div class="text-black/50 dark:text-white/20 w-4 h-4 flex items-center justify-center !rotate-90":class="{ 'active': open }"
                        @click="open = !open">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.659675 9.35355C0.446775 9.15829 0.446775 8.84171 0.659675 8.64645L4.25 5.35355C4.4629 5.15829 4.4629 4.84171 4.25 4.64645L0.659675 1.35355C0.446776 1.15829 0.446776 0.841709 0.659675 0.646446C0.872575 0.451184 1.21775 0.451185 1.43065 0.646446L5.02098 3.93934C5.65967 4.52513 5.65968 5.47487 5.02098 6.06066L1.43065 9.35355C1.21775 9.54882 0.872574 9.54882 0.659675 9.35355Z"
                                fill="currentcolor"></path>
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <x-icon name="dashboard" class="text-gray-600" />
                        <span class="pl-1">Dashboard</span>
                    </div>
                </a>
                <ul x-show="activeMenu === 'dashboard'" x-collapse=""
                    class="sub-menu flex flex-col gap-1 text-black dark:text-white/80">
                    <li><a href="{{ route('dashboard') }}"
                            class="{{ $active === 'dashboard' ? 'active' : '' }}">Penjualan</a></li>
                    <li><a href="{{ route('dashboard.keuangan') }}"
                            class="{{ $active === 'dahboardkeuangan' ? 'active' : '' }}">Keuangan</a></li>
                    <li><a href="{{ route('dashboard.peta') }}"
                            class="{{ $active === 'peta' ? 'active' : '' }}">Peta</a></li>
                </ul>
            </li>
            {{-- Data Keuangan --}}
            <li class="menu nav-item" x-data="{ open: {{ in_array($active ?? '', ['keuangan', 'akun', 'rekening']) ? 'true' : 'false' }} }">
                <a href="javascript:;" class="nav-link group text-black dark:text-white" :class="{ 'active': open }"
                    @click="open = !open">
                    <div class="text-black/50 dark:text-white/20 w-4 h-4 flex items-center justify-center transition-transform duration-300"
                        :class="{ '!rotate-90': open }">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.659675 9.35355C0.446775 9.15829 0.446775 8.84171 0.659675 8.64645L4.25 5.35355C4.4629 5.15829 4.4629 4.84171 4.25 4.64645L0.659675 1.35355C0.446776 1.15829 0.446776 0.841709 0.659675 0.646446C0.872575 0.451184 1.21775 0.451185 1.43065 0.646446L5.02098 3.93934C5.65967 4.52513 5.65968 5.47487 5.02098 6.06066L1.43065 9.35355C1.21775 9.54882 0.872574 9.54882 0.659675 9.35355Z"
                                fill="currentcolor"></path>
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            viewBox="0 0 24 24">
                            <rect x="3" y="7" width="18" height="10" rx="2" stroke="currentColor"
                                stroke-width="1.5" fill="none" />
                            <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.5"
                                fill="none" />
                            <path d="M7 12h.01M17 12h.01" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                        <span class="pl-1">Keuangan</span>
                    </div>
                </a>
                <ul x-show="open" x-collapse class="sub-menu flex flex-col gap-1 text-black dark:text-white/80">
                    <li><a href="{{ route('index.keuangan') }}"
                            class="{{ $active === 'keuangan' ? 'active' : '' }}">Buku Kas</a></li>
                    <li><a href="{{ route('index.akun') }}" class="{{ $active === 'akun' ? 'active' : '' }}">Akun</a>
                    </li>
                    <li><a href="{{ route('akun.rekening') }}"
                            class="{{ $active === 'rekening' ? 'active' : '' }}">Rekening</a></li>
                </ul>
            </li>

            <h2 class="pl-3 my-2 text-black/60 dark:text-white/40 text-sm"><span>Administrasi</span></h2>

            {{-- Data Mitra --}}
            <li class="menu nav-item">
                <a href="{{ route('index.mitra') }}" class="{{ $active === 'mitra' ? 'active' : '' }}">
                    <div class="flex pl-5 items-center">
                        <x-icon name="supplier" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Data Mitra</span>
                    </div>
                </a>
            </li>

            {{-- Penjualan --}}
            <li class="menu nav-item">
                <a class="nav-link group {{ $active === 'transaksi' ? 'active' : '' }}"
                    href="{{ route('transaksi.index') }}">
                    <div class="flex pl-5 items-center">
                        <x-icon name="layer" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Transaksi</span>
                    </div>
                </a>
            </li>

            {{-- Nota dan Kwitansi --}}
            <li class="menu nav-item">
                <a class="nav-link group {{ $active === 'nota' ? 'active' : '' }}" href="{{ route('nota.index') }}">
                    <div class="flex pl-5 items-center">
                        <x-icon name="document" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Nota dan Kwitansi</span>
                    </div>
                </a>
            </li>

            <li class="menu nav-item" x-data="{ open: {{ in_array($active ?? '', ['add_produk', 'produk', 'category']) ? 'true' : 'false' }} }">
                <a href="javascript:;" class="nav-link group text-black dark:text-white" :class="{ 'active': open }"
                    @click="open = !open">
                    <div class="text-black/50 dark:text-white/20 w-4 h-4 flex items-center justify-center transition-transform duration-300"
                        :class="{ '!rotate-90': open }">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.659675 9.35355C0.446775 9.15829 0.446775 8.84171 0.659675 8.64645L4.25 5.35355C4.4629 5.15829 4.4629 4.84171 4.25 4.64645L0.659675 1.35355C0.446776 1.15829 0.446776 0.841709 0.659675 0.646446C0.872575 0.451184 1.21775 0.451185 1.43065 0.646446L5.02098 3.93934C5.65967 4.52513 5.65968 5.47487 5.02098 6.06066L1.43065 9.35355C1.21775 9.54882 0.872574 9.54882 0.659675 9.35355Z"
                                fill="currentcolor"></path>
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <x-icon name="forms" class="text-gray-600" />
                        <span class="pl-1">Data Produk</span>
                    </div>
                </a>
                <ul x-show="open" x-collapse class="sub-menu flex flex-col gap-1 text-black dark:text-white/80">
                    <li><a href="{{ route('index.create.produk') }}"
                            class="{{ $active === 'add_produk' ? 'active' : '' }}">Tambah Data</a></li>
                    <li><a href="{{ route('index.produk') }}"
                            class="{{ $active === 'produk' ? 'active' : '' }}">Data Produk</a></li>
                    <li><a href="{{ route('produk.category') }}"
                            class="{{ $active === 'category' ? 'active' : '' }}">Kategori</a></li>
                </ul>
            </li>

         

            {{-- Data IKM --}}
            @if (auth()->check() && auth()->user()->role === 'admin')
               <h2 class="pl-3 my-2 text-black/60 dark:text-white/40 text-sm"><span>Master Data</span></h2>
                <li class="menu nav-item" x-data="{ open: {{ in_array($active ?? '', ['ikm', 'ikm_create', 'ikm_update']) ? 'true' : 'false' }} }">
                    <a href="javascript:;" class="nav-link group text-black dark:text-white"
                        :class="{ 'active': open }" @click="open = !open">
                        <div class="text-black/50 dark:text-white/20 w-4 h-4 flex items-center justify-center transition-transform duration-300"
                            :class="{ '!rotate-90': open }">
                            <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.659675 9.35355C0.446775 9.15829 0.446775 8.84171 0.659675 8.64645L4.25 5.35355C4.4629 5.15829 4.4629 4.84171 4.25 4.64645L0.659675 1.35355C0.446776 1.15829 0.446776 0.841709 0.659675 0.646446C0.872575 0.451184 1.21775 0.451185 1.43065 0.646446L5.02098 3.93934C5.65967 4.52513 5.65968 5.47487 5.02098 6.06066L1.43065 9.35355C1.21775 9.54882 0.872574 9.54882 0.659675 9.35355Z"
                                    fill="currentcolor"></path>
                            </svg>
                        </div>
                        <div class="flex items-center">
                            <x-icon name="user" class="text-gray-600" />
                            <span class="pl-1">Data Pengguna</span>
                        </div>
                    </a>
                    <ul x-show="open" x-collapse class="sub-menu flex flex-col gap-1 text-black dark:text-white/80">
                        <li><a href="{{ route('ikm.create') }}"
                                class="{{ $active === 'ikm_create' ? 'active' : '' }}">Tambah Data</a></li>
                        <li><a href="{{ route('index.ikm') }}" class="{{ $active === 'ikm' ? 'active' : '' }}">Data
                                Pengguna</a></li>
                    </ul>
                </li>
            @endif
             <h2 class="pl-3 my-2 text-black/60 dark:text-white/40 text-sm"><span>Setelan</span></h2>
            <li class="menu nav-item">
                <a class="nav-link group" href="{{ route('perusahaan.setting') }}">
                    <div class="flex pl-5 items-center">
                       <x-icon name="tools" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Setelan Aplikasi</span>
                    </div>
                </a>
            </li>

        <!-- End Menu -->
    </div>
</nav>
<!-- Bottom Mobile Menu -->
<nav class="w-full fixed bottom-0 inset-x-0 z-40 bg-white dark:bg-black  border-t border-gray-200 dark:border-white/10  md:hidden" >
    <div class="flex justify-between">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex flex-col items-center justify-center w-full py-2 text-xs {{ $active === 'dashboard' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-white/60' }}">
            <x-icon name="dashboard" class="w-5 h-5 mb-1" />
            <span class="text-[10px]">Dashboard</span>
        </a>

        <!-- Transaksi -->
        <a href="{{ route('transaksi.index') }}"
           class="flex flex-col items-center justify-center w-full py-2 text-xs {{ $active === 'transaksi' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-white/60' }}">
            <x-icon name="layer" class="w-5 h-5 mb-1" />
            <span class="text-[10px]">Transaksi</span>
        </a>

        <!-- Nota -->
        <a href="{{ route('nota.index') }}"
           class="flex flex-col items-center justify-center w-full py-2 text-xs {{ $active === 'nota' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-white/60' }}">
            <x-icon name="document" class="w-5 h-5 mb-1" />
            <span class="text-[10px]">Nota</span>
        </a>

        <!-- Keuangan -->
        <a href="{{ route('index.keuangan') }}"
           class="flex flex-col items-center justify-center w-full py-2 text-xs {{ $active === 'keuangan' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-white/60' }}">
            <svg class="w-5 h-5 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <rect x="3" y="7" width="18" height="10" rx="2" stroke="currentColor" stroke-width="1.5"/>
                <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            <span class="text-[10px]">Keuangan</span>
        </a>

        <!-- Pengguna -->
        <a href="{{ route('perusahaan.setting') }}" 
           class="flex flex-col items-center justify-center w-full py-2 text-xs {{ $active === 'setelan' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-white/60' }}">
           <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
            <path d="M226.76,69a8,8,0,0,0-12.84-2.88l-40.3,37.19-17.23-3.7-3.7-17.23,37.19-40.3A8,8,0,0,0,187,29.24,72,72,0,0,0,88,96,72.34,72.34,0,0,0,94,124.94L33.79,177c-.15.12-.29.26-.43.39a32,32,0,0,0,45.26,45.26c.13-.13.27-.28.39-.42L131.06,162A72,72,0,0,0,232,96,71.56,71.56,0,0,0,226.76,69ZM160,152a56.14,56.14,0,0,1-27.07-7,8,8,0,0,0-9.92,1.77L67.11,211.51a16,16,0,0,1-22.62-22.62L109.18,133a8,8,0,0,0,1.77-9.93,56,56,0,0,1,58.36-82.31l-31.2,33.81a8,8,0,0,0-1.94,7.1L141.83,108a8,8,0,0,0,6.14,6.14l26.35,5.66a8,8,0,0,0,7.1-1.94l33.81-31.2A56.06,56.06,0,0,1,160,152Z"></path>
            </svg>
            <span class="text-[10px]">Setelan</span>
        </a>
    </div>
</nav>
