<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Animasi berputar */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .spin {
            animation: spin 1s linear infinite;
        }

        .border-red {
            border-color: #f40606;
            /* Warna merah terang */
        }
    </style>
</head>

<body>
    <main class="flex flex-col overflow-hidden w-full min-h-screen bg-white rounded-lg md:flex-row">

        <section class="hidden bg-[#f0f5ff] items-center justify-center relative md:flex md:w-1/2">
            <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
            <dotlottie-player src="https://lottie.host/63d803ea-611b-4fa9-b867-4ee920f62c72/wO6aJjUNr8.lottie"
                background="transparent" speed="1" style="width: 100%; height: auto;" loop
                autoplay></dotlottie-player>
        </section>
        <section class="w-full p-8 md:w-1/2 md:p-16">
            <div class="flex space-x-2 mb-10 items-center">
                <img alt="WowDash logo icon with blue background and white W letter" class="w-10 h-10" height="40"
                    src="https://storage.googleapis.com/a1aa/image/891a7e97-6121-4aef-40de-7fe839698707.jpg"
                    width="40" />
                <span class="font-semibold text-xl text-[#0f172a]">WowDash</span>
            </div>
            <h1 class="mb-2 text-[#0f172a] text-3xl font-semibold leading-tight">
                Daftarkan Akun Anda
            </h1>
            <p class="mb-8 text-[#334155] text-base">
                Selamat datang kembali! Silakan masukkan detail Anda.
            </p>
            <form class="space-y-5" action="{{ route('register.add') }}" method="POST">
                @csrf
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <label class="block relative">
                        <span class="flex text-[#64748b] absolute inset-y-0 left-4 items-center">
                            <i class="fas fa-user"></i>
                        </span>
                        <input id="name" name="name"
                            class="w-full pl-12 pr-4 py-3 text-[#334155] placeholder-[#64748b] bg-[#f8fafc] rounded-lg border @error('name') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="Nama Lengkap Anda" type="text" value="{{ old('name') }}" />

                    </label>
                    @error('name')
                        <div class="text-red-500  text-sm">{{ $message }}</div>
                    @enderror
                    <label class="block relative">
                        <span class="flex text-[#64748b] absolute inset-y-0 left-4 items-center">
                            <i class="fas fa-phone"></i>
                        </span>
                        <input id="phone" name="phone"
                            class="w-full pl-12 pr-4 py-3 text-[#334155] placeholder-[#64748b] bg-[#f8fafc] rounded-lg border @error('phone') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="Nomor Telepon" type="tel" value="{{ old('phone') }}"
                            pattern="[0-9]{10,15}" title="Hanya angka yang diizinkan dan panjang nomor 10-15 digit" />
                    </label>

                    @error('phone')
                        <div class="text-red-500  text-sm">{{ $message }}</div>
                    @enderror
                   <label class="block relative">
                        <span class="flex text-[#64748b] absolute inset-y-0 left-4 items-center">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input id="email" name="email"
                            class="w-full pl-12 pr-4 py-3 text-[#334155] placeholder-[#64748b] bg-[#f8fafc] rounded-lg border @error('email') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="Email" type="email" value="{{ old('email') }}" />

                    </label>

                        {{-- Loading dan pesan error --}}
                        <div id="email-status" class="text-sm mt-1 pl-1">
                            <p id="email-loading" class="text-blue-500 hidden">Memeriksa email...</p>
                            <p id="email-error" class="text-red-500 hidden">Email sudah terdaftar, Silahakan Login dengan email tersebut</p>
                        </div>
                    @error('email')
                        <div class="text-red-500  text-sm">{{ $message }}</div>
                    @enderror
                    <label class="block relative">
                        <span class="flex text-[#64748b] absolute inset-y-0 left-4 items-center">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input id="password" name="password"
                            class="w-full pl-12 pr-12 py-3 text-[#334155] placeholder-[#64748b] bg-[#f8fafc] rounded-lg border @error('password') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="Password" type="password" />

                    </label>
                    @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                    <label class="block relative">
                        <span class="flex text-[#64748b] absolute inset-y-0 left-4 items-center">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input id="cpassword" name="cpassword"
                            class="w-full pl-12 pr-12 py-3 text-[#334155] placeholder-[#64748b] bg-[#f8fafc] rounded-lg border @error('cpassword') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="Masukan Kembali Password Anda" type="password" />

                    </label>
                    @error('cpassword')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Kolom 1: Captcha Image -->
                        <div>
                            <img src="{{ captcha_src() }}" alt="captcha" class="w-full" />
                        </div>

                        <!-- Kolom 2: Input Captcha -->
                        <div>
                            <input type="text" name="captcha"
                                class="w-full @error('captcha') border-red-500 @enderror pl-5 py-3 text-[#334155] placeholder-[#64748b] bg-[#f8fafc] rounded-lg border  focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('captcha') is-invalid @enderror"
                                placeholder="Please Insert Captcha" />

                            @error('captcha')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <label class="inline-flex space-x-2 mb-8 text-[#475569] text-sm items-start">
                        <input class="mt-1" type="checkbox" />
                        <span>
                            Dengan membuat akun, berarti Anda setuju dengan Syarat & Ketentuan
                            dan Kebijakan Privasi kami.
                        </span>
                    </label>
                    <button
                        class="w-full py-3 text-white font-semibold bg-blue-600 rounded-lg transition-colors hover:bg-blue-700"
                        type="submit" id="signup-button">
                        <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2" id="signup-icon"></i>
                        Mendaftar
                    </button>
                </form>

                <p class="mt-10 text-center text-[#64748b] text-sm">
                    Sudah memiliki akun?
                    <a class="text-blue-600 font-semibold hover:underline" href="/login">
                        Masuk
                    </a>
                </p>
        </section>
    </main>


    <script>
        document.getElementById('phone').addEventListener('input', function(event) {
            // Membatasi hanya angka yang dapat dimasukkan
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
    <script>
        function togglePasswordVisibility(inputId) {
            const passwordField = document.getElementById(inputId);
            const eyeIcon = document.getElementById('eye-icon-' + inputId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
    <script>
    const emailInput = document.getElementById('email');
    const loadingMsg = document.getElementById('email-loading');
    const errorMsg = document.getElementById('email-error');

    let timer = null;

    emailInput.addEventListener('input', function () {
        // Clear timeout jika user masih mengetik
        clearTimeout(timer);

        // Mulai loading
        loadingMsg.classList.remove('hidden');
        errorMsg.classList.add('hidden');

        // Tunggu 700ms setelah terakhir diketik
        timer = setTimeout(() => {
            fetch('{{ route("check.email") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: this.value })
            })
            .then(res => res.json())
            .then(data => {
                loadingMsg.classList.add('hidden');
                if (data.exists) {
                    errorMsg.classList.remove('hidden');
                } else {
                    errorMsg.classList.add('hidden');
                }
            })
            .catch(() => {
                loadingMsg.classList.add('hidden');
                errorMsg.textContent = 'Terjadi kesalahan saat memeriksa email.';
                errorMsg.classList.remove('hidden');
            });
        }, 700);
    });
</script>



</body>

</html>
