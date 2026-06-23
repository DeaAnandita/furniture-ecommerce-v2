<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Budi Alumunium</title>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #e6ecf5;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
        }

        .primary-btn {
            background: #182d5c;
            transition: .3s;
        }

        .primary-btn:hover {
            background: #2d3a6f;
        }
    </style>
</head>

<body class="min-h-screen">

    <div class="min-h-screen grid lg:grid-cols-2">
        

        <!-- LEFT -->
        <div class="hidden lg:block relative">

            <img src="{{ asset('hero.png') }}"
                class="absolute inset-0 w-full h-full object-cover">
                

            <div class="absolute inset-0 bg-black/35"></div>

            <div class="relative z-10 h-full flex flex-col justify-center px-16 text-white">

                <p class="uppercase tracking-[3px] text-xs md:text-sm mb-3 md:mb-4">
                    Furniture Modern
                </p>

                <h1 class="hero-title text-3xl md:text-6xl font-bold leading-tight mb-4 md:mb-6">
                    Ruang Nyaman, Hidup Lebih Bermakna
                </h1>

                <p class="text-sm md:text-lg text-gray-200 mb-6 md:mb-8">
                    Melayani pembuatan kusen, pintu, jendela, partisi kaca, etalase dan berbagai kebutuhan alumunium untuk rumah maupun bangunan komersial.
                </p>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="flex items-center justify-center px-6 py-10">
            

            <div class="w-full max-w-md bg-white rounded-[32px] shadow-xl p-8 md:p-10">

                
                <!-- LOGO -->
                <div class="mb-8 text-center">

                    {{-- <h2 class="text-3xl font-bold text-[#2B2B2B]">
                        Budi Alumunium
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Furniture modern & aesthetic
                    </p> --}}
                </div>

                {{ $slot }}

            </div>

        </div>

    </div>

</body>

</html>