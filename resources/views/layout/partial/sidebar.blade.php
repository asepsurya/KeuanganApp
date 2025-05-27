<nav class="sidebar fixed top-0 bottom-0 z-40 flex-none w-[212px] border-r border-black/10 dark:border-white/10 transition-all duration-300">
    <div class="bg-white dark:bg-black h-full">
        <!-- Start Logo -->
        <div class="flex p-4">
            <a class='main-logo flex-1 w-full' href='index.html'>
                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="block dark:hidden" />
                <img src="{{ asset('assets/images/dark-logo.svg') }}" alt="logo" class="hidden dark:block" />
            </a>
        </div>
        <!-- End Logo -->
        <!-- Start Menu -->
        <ul class="relative h-[calc(100vh-58px)] flex flex-col gap-1 overflow-y-auto overflow-x-hidden p-4 py-0" x-data="{ activeMenu: '{{ $activeMenu }}' }">
            <li class="menu nav-item mb-3">
                <input type="text" placeholder="Cari Menu.." class="form-input py-2.5 px-4 w-full text-black dark:text-white border border-black/10 dark:border-white/10 rounded-lg placeholder:text-black/20 dark:placeholder:text-white/20 focus:border-black dark:focus:border-white/10 focus:ring-0 focus:shadow-none;" required>
            </li>
        
            {{-- Dashboard --}}
           
            <li class="menu nav-item">
                <a href="javaScript:;" class="nav-link group text-black dark:text-white active" :class="{'active' : activeMenu === 'dashboard'}" @click="activeMenu === 'dashboard' ? activeMenu = null : activeMenu = 'dashboard'">
                    <div class="text-black/50 dark:text-white/20 w-4 h-4 flex items-center justify-center !rotate-90":class="{ 'active': open }" @click="open = !open">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.659675 9.35355C0.446775 9.15829 0.446775 8.84171 0.659675 8.64645L4.25 5.35355C4.4629 5.15829 4.4629 4.84171 4.25 4.64645L0.659675 1.35355C0.446776 1.15829 0.446776 0.841709 0.659675 0.646446C0.872575 0.451184 1.21775 0.451185 1.43065 0.646446L5.02098 3.93934C5.65967 4.52513 5.65968 5.47487 5.02098 6.06066L1.43065 9.35355C1.21775 9.54882 0.872574 9.54882 0.659675 9.35355Z" fill="currentcolor"></path>
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <x-icon name="dashboard" class="text-gray-600" />
                        <span class="pl-1">Dashboard</span>
                    </div>
                </a>
                <ul x-show="activeMenu === 'dashboard'" x-collapse="" class="sub-menu flex flex-col gap-1 text-black dark:text-white/80">
                    <li><a href="{{ route('dashboard') }}" class="{{ $active === 'dashboard' ? 'active' : '' }}" >Penjualan</a></li>
                    <li><a href="{{ route('dashboard.keuangan') }}" class="{{ $active === 'keuangan' ? 'active' : '' }}" >Keuangan</a></li>
                    <li><a href="{{ route('dashboard.peta') }}" class="{{ $active === 'peta' ? 'active' : '' }}">Peta</a></li>
                </ul>
            </li>
              {{-- Profile --}}
              <li class="menu nav-item">
                <a class="nav-link group" href="drag-and-drop.html">
                    <div class="flex pl-5 items-center">
                        <x-icon name="user-1" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Profile Saya</span>
                    </div>
                </a>
            </li>
        
            <h2 class="pl-3 my-2 text-black/60 dark:text-white/40 text-sm"><span>Master Data</span></h2>
        
            {{-- Data Mitra --}}
            <li class="menu nav-item" x-data="{ open: {{ in_array($active ?? '', ['mitra', 'tambah']) ? 'true' : 'false' }} }">
                <a href="javascript:;" class="nav-link group text-black dark:text-white" :class="{ 'active': open }" @click="open = !open">
                    <div class="text-black/50 dark:text-white/20 w-4 h-4 flex items-center justify-center transition-transform duration-300" :class="{ '!rotate-90': open }">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.66 9.35C0.45 9.16 0.45 8.84 0.66 8.65L4.25 5.35C4.46 5.16 4.46 4.84 4.25 4.65L0.66 1.35C0.45 1.16 0.45 0.84 0.66 0.65C0.87 0.45 1.22 0.45 1.43 0.65L5.02 3.94C5.66 4.53 5.66 5.47 5.02 6.06L1.43 9.35C1.22 9.55 0.87 9.55 0.66 9.35Z" fill="currentcolor"/></svg>
                    </div>
                    <div class="flex items-center">
                        <x-icon name="supplier" class="text-gray-600" />
                        <span class="pl-1">Data Mitra</span>
                    </div>
                </a>
                <ul x-show="open" x-collapse class="sub-menu flex flex-col gap-1 text-black dark:text-white/80">
                    <li><a href="{{ route('index.mitra') }}" class="{{ $active === 'mitra' ? 'active' : '' }}">Tambah Data</a></li>
                    <li><a href="" class="{{ $active === 'mitra2' ? 'active' : '' }}">Data Mitra</a></li>
                </ul>
            </li>
        
            {{-- Data IKM --}}
            <li class="menu nav-item" x-data="{ open: {{ in_array($active ?? '', ['ikm']) ? 'true' : 'false' }} }">
                <a href="javascript:;" class="nav-link group text-black dark:text-white" :class="{ 'active': open }" @click="open = !open">
                    <div class="text-black/50 dark:text-white/20 w-4 h-4 flex items-center justify-center transition-transform duration-300" :class="{ '!rotate-90': open }">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.659675 9.35355C0.446775 9.15829 0.446775 8.84171 0.659675 8.64645L4.25 5.35355C4.4629 5.15829 4.4629 4.84171 4.25 4.64645L0.659675 1.35355C0.446776 1.15829 0.446776 0.841709 0.659675 0.646446C0.872575 0.451184 1.21775 0.451185 1.43065 0.646446L5.02098 3.93934C5.65967 4.52513 5.65968 5.47487 5.02098 6.06066L1.43065 9.35355C1.21775 9.54882 0.872574 9.54882 0.659675 9.35355Z" fill="currentcolor"></path>
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <x-icon name="user" class="text-gray-600" />
                        <span class="pl-1">Data IKM</span>
                    </div>
                </a>
                <ul x-show="open" x-collapse class="sub-menu flex flex-col gap-1 text-black dark:text-white/80">
                    <li><a href="#" class="{{ $active === 'ikm' ? 'active' : '' }}">Tambah Data</a></li>
                    <li><a href="#">Data IKM</a></li>
                </ul>
            </li>

            <li class="menu nav-item" x-data="{ open: {{ in_array($active ?? '', ['produk']) ? 'true' : 'false' }} }">
                <a href="javascript:;" class="nav-link group text-black dark:text-white" :class="{ 'active': open }" @click="open = !open">
                    <div class="text-black/50 dark:text-white/20 w-4 h-4 flex items-center justify-center transition-transform duration-300" :class="{ '!rotate-90': open }">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.659675 9.35355C0.446775 9.15829 0.446775 8.84171 0.659675 8.64645L4.25 5.35355C4.4629 5.15829 4.4629 4.84171 4.25 4.64645L0.659675 1.35355C0.446776 1.15829 0.446776 0.841709 0.659675 0.646446C0.872575 0.451184 1.21775 0.451185 1.43065 0.646446L5.02098 3.93934C5.65967 4.52513 5.65968 5.47487 5.02098 6.06066L1.43065 9.35355C1.21775 9.54882 0.872574 9.54882 0.659675 9.35355Z" fill="currentcolor"></path>
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <x-icon name="forms" class="text-gray-600" />
                        <span class="pl-1">Data Produk</span>
                    </div>
                </a>
                <ul x-show="open" x-collapse class="sub-menu flex flex-col gap-1 text-black dark:text-white/80">
                    <li><a href="#" class="{{ $active === 'ikm' ? 'active' : '' }}">Tambah Data</a></li>
                    <li><a href="{{ route('index.produk') }}" class="{{ $active === 'produk' ? 'active' : '' }}">Data Produk</a></li>
                </ul>
            </li>
            <li class="menu nav-item">
                <a class="nav-link group" href="#">
                    <div class="flex pl-5 items-center">
                        <x-icon name="document" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Legalitas Usaha</span>
                    </div>
                </a>
            </li>
            <h2 class="pl-3 my-2 text-black/60 dark:text-white/40 text-sm"><span>Administrasi</span></h2>
        
            {{-- Data Keuangan --}}
            <li class="menu nav-item" x-data="{ open: {{ in_array($active ?? '', ['keuangan-data']) ? 'true' : 'false' }} }">
                <a href="javascript:;" class="nav-link group text-black dark:text-white" :class="{ 'active': open }" @click="open = !open">
                    <div class="text-black/50 dark:text-white/20 w-4 h-4 flex items-center justify-center transition-transform duration-300" :class="{ '!rotate-90': open }">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.659675 9.35355C0.446775 9.15829 0.446775 8.84171 0.659675 8.64645L4.25 5.35355C4.4629 5.15829 4.4629 4.84171 4.25 4.64645L0.659675 1.35355C0.446776 1.15829 0.446776 0.841709 0.659675 0.646446C0.872575 0.451184 1.21775 0.451185 1.43065 0.646446L5.02098 3.93934C5.65967 4.52513 5.65968 5.47487 5.02098 6.06066L1.43065 9.35355C1.21775 9.54882 0.872574 9.54882 0.659675 9.35355Z" fill="currentcolor"></path>
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <x-icon name="cart" class="text-gray-600" />
                        <span class="pl-1">Data Keuangan</span>
                    </div>
                </a>
                <ul x-show="open" x-collapse class="sub-menu flex flex-col gap-1 text-black dark:text-white/80">
                    <li><a href="#" class="{{ $active === 'keuangan-data' ? 'active' : '' }}">Tambah Data</a></li>
                    <li><a href="#">Kategori Pemasukan</a></li>
                    <li><a href="#">Kategori Pengeluaran</a></li>
                </ul>
            </li>
        
            {{-- Nota dan Kwitansi --}}
            <li class="menu nav-item">
                <a class="nav-link group" href="#">
                    <div class="flex pl-5 items-center">
                        <x-icon name="document" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Nota dan Kwitansi</span>
                    </div>
                </a>
            </li>
        
            {{-- Penjualan --}}
            <li class="menu nav-item">
                <a class="nav-link group" href="#">
                    <div class="flex pl-5 items-center">
                        <x-icon name="layer" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Transaksi</span>
                    </div>
                </a>
            </li>
        
            <h2 class="pl-3 my-2 text-black/60 dark:text-white/40 text-sm"><span>Pengaturan Aplikasi</span></h2>
        
            {{-- Setelan Aplikasi --}}
            <li class="menu nav-item">
                <a class="nav-link group" href="#">
                    <div class="flex pl-5 items-center">
                        <x-icon name="tools" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Setelan Aplikasi</span>
                    </div>
                </a>
            </li>
        
            {{-- Data Pengguna --}}
            <li class="menu nav-item">
                <a class="nav-link group" href="#">
                    <div class="flex pl-5 items-center">
                        <x-icon name="user-4" class="text-gray-600" />
                        <span class="pl-1 text-black dark:text-white">Data Pengguna</span>
                    </div>
                </a>
            </li>
        </ul>
        
        <!-- End Menu -->
    </div>
</nav>
