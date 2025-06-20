<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        Login
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body>
    <main class="bg-white w-full rounded-lg flex flex-col md:flex-row overflow-hidden min-h-screen">
        <section class="hidden md:flex md:w-1/2 bg-[#f0f5ff] items-center justify-center relative">
            <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module">
            </script>

            <dotlottie-player src="https://lottie.host/f1ec6b22-384b-46b2-b95e-a0d071ad6d8a/5f2Twos7f8.lottie"
                background="transparent" speed="1" style="width: 100%; height: auto;" loop autoplay>
            </dotlottie-player>
        </section>
        <section class="w-full md:w-1/2 p-8 md:p-16">
            <div class="flex items-center space-x-2 mb-10">
                <img alt="WowDash logo icon with blue background and white W letter" class="w-10 h-10" height="40"
                    src="https://storage.googleapis.com/a1aa/image/891a7e97-6121-4aef-40de-7fe839698707.jpg"
                    width="40" />
                <span class="font-semibold text-xl text-[#0f172a]">
                    WowDash
                </span>
            </div>
            <h1 class="text-[#0f172a] text-3xl font-semibold mb-2 leading-tight">
                Masuk ke Akun Anda
            </h1>
            <p class="text-[#334155] mb-8 text-base">
                Selamat datang kembali! Silakan masukkan detail Anda.
            </p>
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="space-y-5" method="POST" action="/login" onsubmit="showLoading()">
                @csrf
                <label class="relative block">
                    <span class="absolute inset-y-0 left-4 flex items-center text-[#64748b]">
                        <i class="fas fa-user">
                        </i>
                    </span>
                    <input name="email"
                        class="@error('email') border-red-500 @enderror w-full pl-12 pr-4 py-3 rounded-lg border  bg-[#f8fafc] text-[#334155] placeholder-[#64748b] focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        placeholder="Username, Telepon, Email" type="text" />
                </label>

                <label class="relative block">
                    <span class="absolute inset-y-0 left-4 flex items-center text-[#64748b]">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input name="password" id="password"
                        class=" @error('password') border-red-500 @enderror w-full pl-12 pr-12 py-3 rounded-lg border  bg-[#f8fafc] text-[#334155] placeholder-[#64748b] focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        placeholder="Password" type="password" />
                    <span onclick="togglePasswordVisibility('password')"
                        class="absolute inset-y-0 right-4 flex items-center text-[#64748b] cursor-pointer">
                        <i id="eye-icon-password" class="fas fa-eye"></i>
                    </span>
                </label>
                <div class="flex items-start justify-between mb-8 text-sm text-[#475569]">
                    <label class="inline-flex items-start space-x-2 w-1/2">
                        <input class="mt-1" type="checkbox" checked />
                        <span>Setuju dengan <span class="text-blue-600">Syarat & Ketentuan</span> dan <span class="text-blue-600">Kebijakan Privasi</span> kami.
                        </span>
                    </label>

                    <div class="w-1/2 text-right">
                        <a href="{{ route('passReset') }}" class="text-blue-600 hover:underline">Lupa Password..?</a>
                    </div>
                </div>
                <button id="submit-btn" type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors flex items-center justify-center">
                    <span id="btn-spinner" class="hidden mr-2">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                    <span id="btn-text">Masuk</span>
                </button>
            </form>
            <script>
                function showLoading() {
                    const btn = document.getElementById('submit-btn');
                    const text = document.getElementById('btn-text');
                    const spinner = document.getElementById('btn-spinner');

                    text.textContent = 'Memproses...';
                    spinner.classList.remove('hidden');

                    // Nonaktifkan tombol untuk cegah submit dobel
                    btn.disabled = true;
                    btn.classList.add('opacity-70', 'cursor-not-allowed');
                }
            </script>

            <p class="text-center text-[#64748b] text-sm mt-10">
                Belum memiliki akun?
                <a class="text-blue-600 font-semibold hover:underline" href="/register">
                    Mendaftar
                </a>
            </p>
        </section>
    </main>
    <script>
        function togglePasswordVisibility(inputId) {
            const passwordField = document.getElementById(inputId);
            const eyeIcon = document.getElementById('eye-icon-' + inputId);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>