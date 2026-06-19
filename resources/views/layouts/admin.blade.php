<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>
        Admin Panel
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ALPINE -->
    <script defer
            src="//unpkg.com/alpinejs"></script>

    <!-- GOOGLE FONT -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
          rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background: #F6F1EA;
            color: #2B2B2B;
        }

        .hero-title{
            font-family: 'Playfair Display', serif;
        }

        [x-cloak]{
            display: none !important;
        }

        .sidebar-link{
            transition: all .25s ease;
        }

        .sidebar-link:hover{
            background: rgba(255,255,255,.08);
            transform: translateX(4px);
        }

        .sidebar-active{
            background: linear-gradient(135deg,#A67B5B,#7D5548);
            box-shadow: 0 10px 25px rgba(0,0,0,.15);
        }

        .glass-card{
            backdrop-filter: blur(14px);
            background: rgba(255,255,255,0.75);
        }

        ::-webkit-scrollbar{
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-thumb{
            background: #D2B8A3;
            border-radius: 999px;
        }

    </style>

</head>

<body class="antialiased">

<div class="min-h-screen lg:flex">

    <!-- SIDEBAR DESKTOP -->
    <aside class="hidden lg:flex w-[290px] min-h-screen bg-gradient-to-b from-[#4B3228] via-[#5D4037] to-[#7D5548] text-white flex-col relative overflow-hidden">

        <!-- BG EFFECT -->
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>

        <div class="absolute bottom-0 left-0 w-52 h-52 bg-[#C6A58A]/20 rounded-full blur-3xl"></div>

        <!-- LOGO -->
        <div class="relative z-10 px-8 pt-10 pb-8 border-b border-white/10">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-3xl bg-white/10 backdrop-blur-md border border-white/10 flex items-center justify-center text-2xl shadow-lg">
                    ✦
                </div>

                <div>

                    <h1 class="hero-title text-3xl font-bold leading-none">
                        Admin
                    </h1>

                    <p class="text-[11px] uppercase tracking-[3px] text-white/60 mt-2">
                        Budi Alumunium
                    </p>

                </div>

            </div>

        </div>

        

        <!-- MENU -->
        <nav class="relative z-10 flex-1 px-5 py-2 space-y-3">

            <!-- DASHBOARD -->
            <a href="/admin/dashboard"
               class="sidebar-link {{ request()->is('admin/dashboard') ? 'sidebar-active' : '' }}
               flex items-center gap-4 px-5 py-4 rounded-2xl">

                <div class="w-11 h-11 rounded-2xl bg-white/10 flex items-center justify-center text-lg">
                    📊
                </div>

                <div>

                    <h3 class="font-medium">
                        Dashboard
                    </h3>

                    <p class="text-xs text-white/60">
                        Overview store
                    </p>

                </div>

            </a>

            <!-- PRODUCT -->
            <a href="/admin/products"
               class="sidebar-link {{ request()->is('admin/products*') ? 'sidebar-active' : '' }}
               flex items-center gap-4 px-5 py-4 rounded-2xl">

                <div class="w-11 h-11 rounded-2xl bg-white/10 flex items-center justify-center text-lg">
                    📦
                </div>

                <div>

                    <h3 class="font-medium">
                        Produk
                    </h3>

                    <p class="text-xs text-white/60">
                        Kelola furniture
                    </p>

                </div>

            </a>

            <!-- ORDER -->
            <a href="/admin/orders"
               class="sidebar-link {{ request()->is('admin/orders*') ? 'sidebar-active' : '' }}
               flex items-center gap-4 px-5 py-4 rounded-2xl">

                <div class="w-11 h-11 rounded-2xl bg-white/10 flex items-center justify-center text-lg">
                    🛒
                </div>

                <div>

                    <h3 class="font-medium">
                        Orders
                    </h3>

                    <p class="text-xs text-white/60">
                        Customer checkout
                    </p>

                </div>

            </a>

            <!-- REPORT -->
            <a href="/admin/reports"
               class="sidebar-link {{ request()->is('admin/reports*') ? 'sidebar-active' : '' }}
               flex items-center gap-4 px-5 py-4 rounded-2xl">

                <div class="w-11 h-11 rounded-2xl bg-white/10 flex items-center justify-center text-lg">
                    📈
                </div>

                <div>

                    <h3 class="font-medium">
                        Reports
                    </h3>

                    <p class="text-xs text-white/60">
                        Sales analytics
                    </p>

                </div>

            </a>

        </nav>

        <!-- FOOT -->
        <div class="relative z-10 p-5 border-t border-white/10">

            <form action="{{ route('logout') }}"
                  method="POST">

                @csrf

                <button type="submit"
                        class="w-full bg-white/10 hover:bg-red-500 border border-white/10 hover:border-red-400 text-white py-4 rounded-2xl font-medium transition-all duration-300">

                    Logout

                </button>

            </form>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 min-w-0">

        <!-- MOBILE HEADER -->
        <div class="lg:hidden sticky top-0 z-50 backdrop-blur-xl bg-[#F6F1EA]/90 border-b border-[#E7DED3]"
             x-data="{ open:false }">

            <div class="flex items-center justify-between px-4 py-4">

                <!-- LEFT -->
                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#7D5548] to-[#5D4037] text-white flex items-center justify-center shadow-lg">
                        ✦
                    </div>

                    <div>

                        <h1 class="hero-title text-2xl font-bold leading-none">
                            Admin
                        </h1>

                        <p class="text-[10px] tracking-[3px] uppercase text-[#8B5E3C] mt-1">
                            Furniture Store
                        </p>

                    </div>

                </div>

                <!-- BUTTON -->
                <button @click="open = !open"
                        class="w-11 h-11 rounded-2xl bg-white border border-[#E7DED3] shadow-sm flex items-center justify-center text-lg">

                    ☰

                </button>

            </div>

            <!-- MOBILE MENU -->
            <div x-show="open"
                 x-transition
                 x-cloak
                 class="px-4 pb-4">

                <div class="bg-white rounded-[30px] border border-[#E7DED3] shadow-xl p-3 space-y-2">

                    <a href="/admin/dashboard"
                       class="flex items-center gap-3 px-4 py-4 rounded-2xl
                       {{ request()->is('admin/dashboard') ? 'bg-[#7D5548] text-white' : 'hover:bg-[#F8F3EC]' }}">

                        <span class="text-lg">
                            📊
                        </span>

                        Dashboard

                    </a>

                    <a href="/admin/products"
                       class="flex items-center gap-3 px-4 py-4 rounded-2xl
                       {{ request()->is('admin/products*') ? 'bg-[#7D5548] text-white' : 'hover:bg-[#F8F3EC]' }}">

                        <span class="text-lg">
                            📦
                        </span>

                        Kelola Produk

                    </a>

                    <a href="/admin/orders"
                       class="flex items-center gap-3 px-4 py-4 rounded-2xl
                       {{ request()->is('admin/orders*') ? 'bg-[#7D5548] text-white' : 'hover:bg-[#F8F3EC]' }}">

                        <span class="text-lg">
                            🛒
                        </span>

                        Kelola Order

                    </a>

                    <a href="/admin/reports"
                       class="flex items-center gap-3 px-4 py-4 rounded-2xl
                       {{ request()->is('admin/reports*') ? 'bg-[#7D5548] text-white' : 'hover:bg-[#F8F3EC]' }}">

                        <span class="text-lg">
                            📈
                        </span>

                        Laporan

                    </a>

                    <!-- LOGOUT -->
                    <form action="{{ route('logout') }}"
                          method="POST"
                          class="pt-2">

                        @csrf

                        <button type="submit"
                                class="w-full bg-red-50 hover:bg-red-100 text-red-500 py-4 rounded-2xl font-medium transition">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

        

        <!-- CONTENT -->
        <div class="px-4 sm:px-6 lg:px-8 pb-6 lg:pb-10">

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>