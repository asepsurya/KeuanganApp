<!-- Search Menu Input & Overlay -->
<div x-data="menuSearch()" x-init="initMenus()" @keydown.window.ctrl.k.prevent="openOverlay()" class="relative ">
    <!-- Inline Search -->
    <div>
        <div class="relative">
            <input type="text" placeholder="Cari Menu.."
                class="form-input py-2.5 pl-4 pr-20 w-full text-black dark:text-white border border-black/10 dark:border-white/10 rounded-lg placeholder:text-black/20 dark:placeholder:text-white/20 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-0 focus:shadow-none"
                maxlength="50"
                x-model="search" @input="filterMenus" @focus="filterMenus" @keydown.escape="showResults = false"
                autocomplete="off" readonly>
            <span
                class="absolute inset-y-0 right-2 flex items-center pointer-events-none text-[10px] text-gray-400 px-1.5 rounded">
                <kbd class="font-mono">Ctrl</kbd>+<kbd class="font-mono">K</kbd>
            </span>
        </div>
        <template x-if="showResults">
            <ul
                class="absolute z-50 mt-2 w-full bg-white dark:bg-black border border-black/10 dark:border-white/10 rounded-lg shadow-lg">
                <template x-for="item in results" :key="item.url">
                    <li>
                        <a :href="item.url"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 text-black dark:text-white"
                            x-text="item.name"></a>
                    </li>

                </template>
            </ul>
        </template>
    </div>

    <!-- Overlay Search Box (Ctrl+K) -->
    <div x-show="showOverlay" style="display: none;" 
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/40" @keydown.window.escape="closeOverlay()" 
       >
        <div class="bg-white dark:bg-black rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <label for="overlayInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Menu</label>
            <input
                x-ref="overlayInput"
                id="overlayInput"
                type="text"
                placeholder="Ketik nama menu..."
                class="form-input py-3 px-4 w-full text-black dark:text-white border border-gray-300 dark:border-gray-700 rounded-lg placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-0 focus:shadow-none transition"
                x-model="overlaySearch"
                @input="filterOverlayMenus"
                @keydown.escape="closeOverlay()"
            />
            <template x-if="overlaySearch.length > 0">
                <ul
                    class="mt-2 bg-white dark:bg-black border border-black/10 dark:border-white/10 rounded-lg shadow-lg">
                    <template x-for="item in overlayResults" :key="item.url">
                        <li>
                            <a :href="item.url"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 text-black dark:text-white"
                                x-text="item.name" @click="closeOverlay()"></a>
                        </li>
                    </template>
                    <template x-if="overlayResults.length === 0">
                        <li class="px-4 py-2 text-gray-400">Menu tidak ditemukan</li>
                    </template>
                </ul>
            </template>
            <button @click="closeOverlay()"
                class="absolute top-2 right-2 text-gray-400 hover:text-black dark:hover:text-white">&times;</button>
        </div>
    </div>
</div>

<script>
    function menuSearch() {
            return {
                search: '',
                showResults: false,
                results: [],
                overlaySearch: '',
                showOverlay: false,
                overlayResults: [],
                menus: [],
                // Ambil data menu dari ul#menu
                initMenus() {
                    // Ambil semua <a> di dalam ul#menu yang punya text
                    let menuEls = document.querySelectorAll('#menu a');
                    let menus = [];
                    menuEls.forEach(a => {
                        let name = a.textContent.trim();
                        let url = a.getAttribute('href');
                        // Filter menu yang valid
                        if (name && url && url !== 'javascript:;' && url !== 'javaScript:;') {
                            menus.push({ name, url });
                        }
                    });
                    this.menus = menus;
                },
                filterMenus() {
                    if (this.search.length > 0) {
                        this.results = this.menus.filter(m => m.name.toLowerCase().includes(this.search.toLowerCase()));
                        this.showResults = this.results.length > 0;
                    } else {
                        this.showResults = false;
                    }
                },
                openOverlay() {
                    this.showOverlay = true;
                    this.overlaySearch = '';
                    this.overlayResults = [];
                    this.$nextTick(() => {
                        this.$refs.overlayInput.focus();
                    });
                },
                closeOverlay() {
                    this.showOverlay = false;
                    this.overlaySearch = '';
                    this.overlayResults = [];
                },
                filterOverlayMenus() {
                    if (this.overlaySearch.length > 0) {
                        this.overlayResults = this.menus.filter(m => m.name.toLowerCase().includes(this.overlaySearch.toLowerCase()));
                    } else {
                        this.overlayResults = [];
                    }
                }
            }
        }
</script>