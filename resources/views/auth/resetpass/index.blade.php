<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Aktivasi Email</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }

        .icon svg {
            width: 80px;
            height: 80px;
            fill: #2563eb;
        }

        .btn {
            display: inline-block;
            padding: 10px 24px;
            background-color: #2563eb;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
        }

        .btn:hover {
            background-color: #1e40af;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

    <main class="bg-white w-full rounded-lg flex flex-col md:flex-row overflow-hidden max-w-5xl ">

        <!-- Side Image / Animation -->
        <section class="hidden md:flex md:w-1/2 bg-[#f0f5ff] items-center justify-center relative">
            <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module">
            </script>
            <dotlottie-player src="https://lottie.host/3b67f67b-d617-4a7c-9528-e4640e808132/6XAxleY8Vu.lottie"
                background="transparent" speed="1" style="width: 100%; height: auto;" loop autoplay>
            </dotlottie-player>
        </section>

        <!-- Content Section -->
        <section class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center items-center text-center">

            <!-- Logo & App Name -->
            <div class="flex items-center space-x-2 mb-8">
                <img src="https://storage.googleapis.com/a1aa/image/891a7e97-6121-4aef-40de-7fe839698707.jpg"
                    alt="WowDash Logo" class="w-10 h-10 rounded" />
                <span class="font-semibold text-xl text-[#0f172a]">WowDash</span>
            </div>


            <!-- Message Container -->
            <div class="max-w-sm w-full">
                <h2 class="text-2xl font-semibold text-[#111827] mb-4">Reset Password</h2>
                <form class="mb-3 max-w-md mx-auto space-y-6">
                    <div>
                        <label class="relative block">
                            <span class="absolute inset-y-0 left-4 flex items-center text-[#64748b]">
                               <i class="fas fa-envelope"></i>
                            </span>
                            <input name="email" class=" w-full pl-12 pr-4 py-3 rounded-lg border  bg-[#f8fafc] text-[#334155] placeholder-[#64748b] focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Masukan Email" type="text">
                        </label>
                        
                    </div>

                    <div class="border border-gray-300 rounded-lg p-4" id="captcha-box">
                        <div class="flex justify-between items-center mb-3">
                            <h2 id="captcha-word"
                                class="text-[#9AEBA3] font-serif font-bold text-3xl leading-none select-none"
                                style="text-shadow: 0 0 3px #9AEBA3;">
                                <!-- Nama kota di sini -->
                            </h2>
                            <button type="button" onclick="generateCaptcha()"
                                class="flex items-center text-blue-600 font-semibold text-base">
                                <i class="fas fa-sync-alt mr-1"></i>
                                Ganti Nama
                            </button>
                        </div>
                        <input type="text" id="captcha-input" placeholder="Ketik nama di atas..."
                            class="w-full pl-5 pr-4 py-3 rounded-lg border  bg-[#f8fafc] text-[#334155] placeholder-[#64748b] focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                        <button onclick="validateCaptcha()" hidden
                            class="mt-3 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                            Verifikasi
                        </button>
                        <p id="captcha-result" class="mt-2 text-sm font-semibold"></p>
                    </div>

                    <button type="button" id="resendBtn" class="w-full btn">Reset Password </button>
                </form>
                <small>Sudah Punya Akun? <a href="/login">Login</a></small>
            </div>
        </section>
    </main>
    <script>
        const kotaList = ['Balangan', 'Banjarbaru', 'Samarinda', 'Banjarmasin', 'Barabai', 'Palangkaraya', 'Martapura'];
    let currentCaptcha = '';

    function generateCaptcha() {
        const index = Math.floor(Math.random() * kotaList.length);
        currentCaptcha = kotaList[index];
        document.getElementById('captcha-word').innerText = currentCaptcha;
        document.getElementById('captcha-result').innerText = '';
        document.getElementById('captcha-input').value = '';
    }

    function validateCaptcha() {
        const userInput = document.getElementById('captcha-input').value.trim();
        const resultText = document.getElementById('captcha-result');

        if (userInput.toLowerCase() === currentCaptcha.toLowerCase()) {
            resultText.innerText = '✅ Verifikasi berhasil!';
            resultText.classList.remove('text-red-500');
            resultText.classList.add('text-green-600');
        } else {
            resultText.innerText = '❌ Nama tidak cocok. Coba lagi!';
            resultText.classList.remove('text-green-600');
            resultText.classList.add('text-red-500');
        }
    }

    // Inisialisasi pertama
    generateCaptcha();
    </script>
</body>

</html>