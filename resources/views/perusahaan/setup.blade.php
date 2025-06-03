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
            <dotlottie-player src="https://lottie.host/f1ec6b22-384b-46b2-b95e-a0d071ad6d8a/5f2Twos7f8.lottie"
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
                Sedikit Lagi Hampir Siap..!!
            </h1>
            <p class="mb-8 text-[#334155] text-base">
                Masukan identitas perusahaan yang anda kelola
            </p>
            <form class="space-y-5" action="{{ route('perusahaan.create') }}" method="POST">
             
                    @csrf
                    <label class="block relative">
                        <span class="flex text-[#64748b] absolute inset-y-0 left-4 items-center">
                            <i class="fas fa-user"></i>
                        </span>
                        <input id="name" name="name"
                            class="w-full pl-12 pr-4 py-3 text-[#334155] placeholder-[#64748b] bg-[#f8fafc] rounded-lg border @error('name') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="Nama Perusahaan" type="text" value="{{ old('name') }}" />

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
                            placeholder="Nomor Telepon Perusahaan" type="tel" value="{{ auth()->user()->phone ?? old('phone') }}"
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
                            placeholder="Email Perusahaan" type="email" value="{{auth()->user()->email ??  old('email') }}" />

                    </label>
                    @error('email')
                        <div class="text-red-500  text-sm">{{ $message }}</div>
                    @enderror
                    <label class="block relative">
                        <span class="flex text-[#64748b] absolute inset-y-0 left-4 items-center">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input id="password" name="alamat"
                            class="w-full pl-12 pr-12 py-3 text-[#334155] placeholder-[#64748b] bg-[#f8fafc] rounded-lg border @error('password') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            placeholder="Alamat Perusahaan" type="text" />

                    </label>
                    @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
   
                    <button
                        class="w-full py-3 text-white font-semibold bg-blue-600 rounded-lg transition-colors hover:bg-blue-700"
                        type="submit" id="signup-button">
                        <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2" id="signup-icon"></i>
                        Ayo Mulai!
                    </button>
                </form>

        </section>
    </main>


    <script>
        document.getElementById('phone').addEventListener('input', function(event) {
            // Membatasi hanya angka yang dapat dimasukkan
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
    

</body>

</html>
