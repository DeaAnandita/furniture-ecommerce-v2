<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>Budi Alumunium</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ALPINE -->
    <script defer src="//unpkg.com/alpinejs"></script>

    <!-- GOOGLE FONT -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
          rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
            background: #e6ebf5;
        }

        [x-cloak]{
            display: none !important;
        }

        .navbar-blur{
            backdrop-filter: blur(14px);
            background: rgba(255,255,255,0.85);
        }

        .nav-link{
            transition: 0.3s;
        }

        .nav-link:hover{
            color: #182d5c;
        }

        .primary-btn{
            background: #182d5c;
            color: white;
            transition: 0.3s;
        }

        .primary-btn:hover{
            background: #182d5c;
        }

        .hero-title{
            font-family: 'Playfair Display', serif;
        }

        nav{
            transition: 0.3s ease;
        }

        nav a{
            font-weight: 500;
        }

    </style>
</head>


<body class="text-[#2B2B2B] antialiased">

<!-- NAVBAR -->
<nav class="sticky top-0 z-[9999] navbar-blur border-b border-[#E7DED3] bg-[#F5EFE6]/80 backdrop-blur-xl">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-[78px]">

            <!-- LEFT -->
            <div class="flex items-center gap-10">

                <!-- LOGO -->
                <a href="/"
                   class="flex items-center gap-3 group">

                    <div class="w-11 h-11 rounded-full bg-[#182d5c] text-white flex items-center justify-center shadow-md text-lg">

                        ✦

                    </div>

                    <div>

                        <h1 class="hero-title text-xl sm:text-xl font-bold leading-none tracking-wide">
                            Budi Alumunium
                        </h1>

                        <p class="text-[10px] uppercase tracking-[3px] text-[#182d5c] mt-1">
                            Elegant Interior
                        </p>

                    </div>

                </a>

                <!-- MENU -->
                <div class="hidden md:flex items-center gap-7 text-[15px]">

                    <a href="/"
                       class="nav-link font-medium hover:text-[#182d5c] transition">
                        Home
                    </a>

                    <a href="#products"
                       class="nav-link font-medium hover:text-[#182d5c] transition">
                        Products
                    </a>

                    <a href="#faq"
                       class="nav-link font-medium hover:text-[#182d5c] transition">
                        FAQ
                    </a>

                    <a href="#instagram"
                       class="nav-link font-medium hover:text-[#182d5c] transition">
                        Contact
                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="hidden md:flex items-center gap-3">

                <!-- SEARCH -->
                <form action="{{ url('/products') }}"
                    method="GET"
                    class="hidden lg:flex items-center bg-white border border-[#cdd7eb] rounded-full px-3 py-2 shadow-sm focus-within:ring-2 focus-within:ring-[#8B5E3C]/20 transition">

                    <!-- ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="w-5 h-5 text-gray-400 ml-1">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m0 0A7.95 7.95 0 1 0 5.4 5.4a7.95 7.95 0 0 0 11.25 11.25Z" />

                    </svg>

                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search furniture..."
                        class="w-44 xl:w-56 bg-transparent border-none focus:ring-0 outline-none text-sm px-3 py-1 placeholder:text-gray-400">

                    <button type="submit"
                            class="bg-[#182d5c] hover:bg-[#445b8c] text-white text-sm px-4 py-2 rounded-full transition">

                        Search

                    </button>

                </form>

                <!-- CART -->
                <a href="/cart"
                   class="relative w-11 h-11 rounded-full bg-[#182d5c] text-white flex items-center justify-center shadow-md hover:scale-105 transition duration-300 shrink-0">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.8"
                         stroke="currentColor"
                         class="w-5 h-5">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M2.25 3h1.386a1.5 1.5 0 0 1 1.464 1.175L5.383 6m0 0h13.867a1.5 1.5 0 0 1 1.464 1.825l-1.5 7.5A1.5 1.5 0 0 1 17.743 16.5H8.257a1.5 1.5 0 0 1-1.471-1.175L5.383 6Zm3.367 13.5a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm9 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />

                    </svg>

                    <!-- BADGE -->
                    <span id="cart-count" class=" cart-badge absolute -top-1 -right-1 bg-[#8d9ec4] text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center shadow transition duration-200">
                        {{ \App\Models\Cart::where('user_id', auth()->id())->count('quantity') }}
                    </span>

                </a>

                @auth

                <!-- DROPDOWN -->
                <div x-data="{ open: false }"
                     class="relative shrink-0">

                    <button @click="open = !open"
                        class="flex items-center gap-3 pl-2 pr-4 py-2 bg-white border border-[#E7DED3] rounded-full shadow-sm hover:shadow-md transition max-w-[180px]">

                    <!-- AVATAR -->
                    <div class="w-10 h-10 rounded-full bg-[#182d5c] text-white flex items-center justify-center text-sm font-semibold shadow-sm shrink-0">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                    <!-- NAME -->
                    <span class="font-medium text-sm truncate">

                        {{ auth()->user()->name }}

                    </span>

                    <!-- ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-4 h-4 transition duration-300 shrink-0"
                            :class="{ 'rotate-180': open }">

                        <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 9l-7 7-7-7" />

                    </svg>

                </button>

                    <!-- MENU -->
                    <div x-show="open"
                         x-transition
                         x-cloak
                         @click.outside="open = false"
                         class="absolute right-0 mt-3 w-60 bg-white rounded-[28px] shadow-2xl border border-[#EFE7DC] overflow-hidden">

                        <div class="p-2">

                            <a href="/profile"
                               class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-[#F8F3EC] transition">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                Profile

                            </a>

                            @if(auth()->user()->role == 'admin')

                            <a href="/admin/products"
                               class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-[#F8F3EC] transition">

                                📦 Admin Panel

                            </a>

                            @endif

                            <form method="POST"
                                  action="{{ route('logout') }}">

                                @csrf

                                <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-red-50 text-red-500 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                    </svg>
                                    Logout

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                @else

                <!-- AUTH BUTTON -->
                <div class="flex items-center gap-3">

                    <a href="/login"
                       class="px-5 py-2.5 rounded-full font-medium border border-[#cdd7eb] bg-white hover:bg-[#e6e7f5] transition text-sm">

                        Login

                    </a>

                    <a href="/register"
                       class="primary-btn px-5 py-2.5 rounded-full font-medium text-sm shadow-sm">

                        Register

                    </a>

                </div>

                @endauth

            </div>

            <!-- MOBILE -->
            <div class="md:hidden flex items-center gap-3"
                x-data="{ mobileOpen: false, searchOpen: false }">

                <!-- SEARCH BUTTON -->
                <button @click="searchOpen = !searchOpen"
                        class="w-10 h-10 rounded-xl bg-white border border-[#E7DED3] flex items-center justify-center shadow-sm">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="w-5 h-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m0 0A7.95 7.95 0 1 0 5.4 5.4a7.95 7.95 0 0 0 11.25 11.25Z" />

                    </svg>

                </button>

                <!-- CART -->
                <a href="/cart"
                class="relative w-10 h-10 rounded-full bg-[#8B5E3C] text-white flex items-center justify-center shadow-md">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="w-5 h-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 3h1.386a1.5 1.5 0 0 1 1.464 1.175L5.383 6m0 0h13.867a1.5 1.5 0 0 1 1.464 1.825l-1.5 7.5A1.5 1.5 0 0 1 17.743 16.5H8.257a1.5 1.5 0 0 1-1.471-1.175L5.383 6Zm3.367 13.5a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm9 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />

                    </svg>

                    <span class="cart-badge absolute -top-1 -right-1 bg-[#D9A066] text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center shadow">
                        {{ \App\Models\Cart::where('user_id', auth()->id())->count('quantity') }}
                    </span>

                </a>

                <!-- MENU BUTTON -->
                <button @click="mobileOpen = !mobileOpen"
                        class="w-10 h-10 rounded-xl bg-white border border-[#E7DED3] flex items-center justify-center shadow-sm">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-6 h-6">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5m-16.5 5.25h16.5m-16.5 5.25h16.5" />

                    </svg>

                </button>

                <!-- SEARCH BOX -->
                <div x-show="searchOpen"
                    x-transition
                    x-cloak
                    @click.outside="searchOpen = false"
                    class="absolute top-20 left-4 right-4 bg-white rounded-3xl shadow-2xl border border-[#EFE7DC] p-4 z-50">

                    <form action="/products"
                        method="GET">

                        <div class="flex items-center bg-[#F8F3EC] rounded-2xl px-4 py-3 border border-[#E7DED3]">

                            <input type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search furniture..."
                                class="w-full bg-transparent border-none focus:ring-0 outline-none text-sm">

                            <button type="submit">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-5 h-5 text-[#8B5E3C]">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m21 21-4.35-4.35m0 0A7.95 7.95 0 1 0 5.4 5.4a7.95 7.95 0 0 0 11.25 11.25Z" />

                                </svg>

                            </button>

                        </div>

                    </form>

                </div>

                <!-- MOBILE MENU -->
                <div x-show="mobileOpen"
                     x-transition
                     x-cloak
                     @click.outside="mobileOpen = false"
                     class="absolute top-20 right-4 w-72 bg-white rounded-[30px] shadow-2xl border border-[#EFE7DC] overflow-hidden">

                    <div class="p-4 space-y-2">

                        <a href="/" class="block px-4 py-3 rounded-2xl hover:bg-[#F5EFE6]">
                            Home
                        </a>

                        <a href="#products" class="block px-4 py-3 rounded-2xl hover:bg-[#F5EFE6]">
                            Products
                        </a>

                        <a href="#faq" class="block px-4 py-3 rounded-2xl hover:bg-[#F5EFE6]">
                            FAQ
                        </a>

                        <a href="#instagram" class="block px-4 py-3 rounded-2xl hover:bg-[#F5EFE6]">
                            Contact
                        </a>

                        @auth

                        <div class="border-t my-2"></div>

                        <div class="px-4 py-2 text-sm text-gray-500">
                            {{ auth()->user()->name }}
                        </div>

                        <a href="/profile"
                           class="block px-4 py-3 rounded-2xl hover:bg-[#F5EFE6]">
                            Profile
                        </a>

                        @if(auth()->user()->role == 'admin')

                        <a href="/admin/products"
                           class="block px-4 py-3 rounded-2xl hover:bg-[#F5EFE6]">
                            Admin Panel
                        </a>

                        @endif

                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                    class="w-full text-left px-4 py-3 rounded-2xl hover:bg-red-50 text-red-500">
                                Logout
                            </button>

                        </form>

                        @else

                        <div class="border-t my-2"></div>

                        <a href="/login"
                           class="block text-center primary-btn px-4 py-3 rounded-2xl font-medium">
                            Login
                        </a>

                        @endauth

                    </div>

                </div>

            </div>

        </div>

    </div>

</nav>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

    @yield('content')

</main>

</body>
</html>