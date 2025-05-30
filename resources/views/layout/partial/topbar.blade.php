<div class="border-b border-black/10 dark:border-white/10 py-[22px] px-7 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <button type="button" class="text-black dark:text-white" @click="$store.app.toggleSidebar()">
            <x-icon name="sidebar" class="text-gray-600" />
        </button>
        <button type="button" class="text-black dark:text-white">
            <x-icon name="start" class="text-gray-600" />
        </button>
        <div class="hidden sm:block">
            <nav aria-label="breadcrumb" class="w-full py-1 px-2">
                <ol class="flex space-x-2 text-sm">
                    @php
                    $segments = Request::segments();
                    $url = '';
                    @endphp

                    <li>
                        <a href="{{ url('/dashboard') }}"
                            class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white">
                            Home
                        </a>
                    </li>

                    @foreach ($segments as $index => $segment)
                    @php
                    $url .= '/' . $segment;
                    $isLast = $loop->last;

                    // Label khusus jika segmen terakhir di halaman update
                    if ($isLast && Request::is('people/update/*')) {
                    $label = $ikm->nama;
                    }elseif($isLast && Request::is('mitra/detail/*')) {
                      $label = $mitra->nama_mitra;  
                    } else {
                    $label = ucwords(str_replace('-', ' ', $segment));
                    }

                    $isLinkable = !$isLast && $segment !==['update','detail'];
                    @endphp

                    <li class="flex items-center space-x-1">
                        <span class="text-black/40 dark:text-white/40">/</span>
                        @if ($isLinkable)
                        <a href="{{ url($url) }}"
                            class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white">
                            {{ $label }}
                        </a>
                        @else
                        <span class="text-black dark:text-white">{{ $label }}</span>
                        @endif
                    </li>
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
    <div class="flex items-center gap-5">
        <form class="md:flex items-center hidden">
            <label for="voice-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-[6px] pointer-events-none">
                    <x-icon name="search" class="text-gray-600" />
                </div>
                <input type="text" id="voice-search"
                    class="bg-black/5 dark:bg-white/10 border-0 text-black dark:text-white/40 text-sm rounded-lg block max-w-[160px] w-full px-[26px] p-1 focus:ring-0 focus:outline-0"
                    placeholder="Search..." required />
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <x-icon name="microphone" class="text-gray-600" />
                </button>
            </div>
        </form>
        <div class="flex items-center gap-2">
            <div>
                <a href="javascript:;" class="text-black dark:text-white" x-cloak x-show="$store.app.mode === 'light'"
                    @click="$store.app.toggleMode('dark')">
                    <x-icon name="moon" class="text-gray-600" />
                </a>
                <a href="javascript:;" class="text-black dark:text-white" x-cloak x-show="$store.app.mode === 'dark'"
                    @click="$store.app.toggleMode('light')">
                    <x-icon name="sun" class="text-gray-600" />
                </a>
            </div>
            <button type="button" class="relative w-7 h-7 p-1 text-black dark:text-white"
                @click="$store.app.rightSidebar()">
                <x-icon name="notif" class="text-gray-600" />
                <span class="flex absolute w-3 h-3 right-px top-[5px]">
                    <span
                        class="animate-ping absolute -left-[3px] -top-[3px] inline-flex h-full w-full rounded-full bg-black/50 dark:bg-white/50 opacity-75"></span>
                    <span class="relative inline-flex rounded-full w-[6px] h-[6px] bg-black dark:bg-white"></span>
                </span>
            </button>
            <div class="profile" x-data="dropdown" @click.outside="open = false">
                <button type="button" class="flex items-center gap-1.5 xl:gap-0" @click="toggle()">
                    <img class="h-7 w-7 rounded-full xl:mr-2" src="{{ asset('assets/images/byewind-avatar.png') }}"
                        alt="Header Avatar" />
                    <span class="fw-medium hidden xl:block">{{ auth()->user()->name }}</span>
                    <x-icon name="arrow-bottom" class="text-gray-600" />
                </button>
                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms>
                    <li>
                        <div class="flex items-center !p-1">
                            <div class="flex-none">
                                <img class="h-7 w-7 rounded-full object-cover"
                                    src="{{ asset('assets/images/byewind-avatar.png') }}" alt="image" />
                            </div>
                            <div class="pl-2">
                                <h4 class="text-sm text-black dark:text-white font-medium leading-none">
                                    {{ auth()->user()->name }}
                                </h4>
                                @php
                                $email = auth()->user()->email;
                                $maxLength = 18;
                                $displayEmail = strlen($email) > $maxLength ? substr($email, 0, $maxLength) . '...' :
                                $email;
                                @endphp

                                <a href="javascript:;"
                                    class="block max-w-[160px] truncate text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                                    title="{{ $email }}">
                                    {{ $displayEmail }}
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="h-px bg-black/5 block my-1"></li>
                    <li>
                        <a href="javaScript:;" class="flex items-center">
                            <x-icon name="user-rounded" class="text-gray-600" />
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="javaScript:;" class="flex items-center">
                            <x-icon name="gear" class="text-gray-600" />
                            Settings
                        </a>
                    </li>
                    <li>
                        <a href="javaScript:;" class="flex items-center">
                            <x-icon name="chat" class="text-gray-600" />
                            Messages
                        </a>
                    </li>
                    <li>
                        <a href="javaScript:;" class="flex items-center">
                            <x-icon name="users" class="text-gray-600" />
                            Support
                        </a>
                    </li>
                    <li class="h-px bg-black/5 block my-1"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-black dark:text-white flex items-center w-full text-left">
                                <x-icon name="sign-out" class="text-gray-600 mr-2" />
                                Sign Out
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>