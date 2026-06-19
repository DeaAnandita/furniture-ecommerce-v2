@extends('layouts.app')

@section('content')

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
      rel="stylesheet">

<style>

    body{
        font-family: 'Poppins', sans-serif;
        background: #F8FAFC;
        color: #142243;
    }

    .product-card{
        border-radius: 24px;
        background: white;
        overflow: hidden;
        transition: 0.3s ease;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }

    .product-card:hover{
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }

    .product-image{
        overflow: hidden;
    }

    .product-image img{
        transition: 0.4s ease;
    }

    .product-card:hover .product-image img{
        transform: scale(1.05);
    }
    .product-card,
    .group{
        position: relative;
        z-index: 1;
    }

    .product-card button,
    .group button{
        position: relative;
        z-index: 20;
    }

    .primary-btn{
        background: #182d5c;
        color: white;
        transition: .3s;
    }


    .primary-btn:hover{
        background: #6b7ea6;
    }

    .hide-scrollbar::-webkit-scrollbar{
        display: none;
    }

    .hide-scrollbar{
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    html{
        scroll-behavior: smooth;
    }

    .add-to-cart-btn{
        transition: 0.25s ease;
    }

    .add-to-cart-btn:active{
        transform: scale(0.95);
    }

</style>

<!-- HERO -->
<section class="relative rounded-[24px] md:rounded-[32px] overflow-hidden mb-10 md:mb-10">

    <img 
        src="{{ asset('hero.png') }}"
        class="w-full h-[350px] md:h-[550px] object-cover"
    >

    <div class="absolute inset-0 bg-black/35 flex items-center">

        <div class="max-w-2xl px-5 md:px-12 text-white">

            <p class="uppercase tracking-[3px] text-xs md:text-sm mb-3 md:mb-4">
                Furniture Modern
            </p>

            <h1 class="hero-title text-3xl md:text-6xl font-bold leading-tight mb-4 md:mb-6">
                Ruang Nyaman, Hidup Lebih Bermakna
            </h1>

            <p class="text-sm md:text-lg text-gray-200 mb-6 md:mb-8">
                Melayani pembuatan kusen, pintu, jendela, partisi kaca, etalase dan berbagai kebutuhan alumunium untuk rumah maupun bangunan komersial.
            </p>

            <a href="#products"
               class="primary-btn px-6 md:px-8 py-3 md:py-4 rounded-full inline-block text-sm md:text-base font-medium">
                Lihat Koleksi
            </a>

        </div>

    </div>

</section>

<!-- FEATURES -->
<section class="mb-8 md:mb-10">

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

        <!-- ITEM -->
        <div class="bg-white rounded-[24px] p-5 md:p-7 border border-[#92a9da] hover:-translate-y-1 transition duration-300">

            <div class="w-11 h-11 md:w-14 md:h-14 rounded-full border border-[#92a9da] flex items-center justify-center mb-4">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="w-5 h-5 md:w-6 md:h-6 text-[#182d5c]">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 6v6h4.5m6.75 0A9.75 9.75 0 1 1 3 12a9.75 9.75 0 0 1 19.5 0Z" />

                </svg>

            </div>

            <h3 class="text-sm md:text-lg font-semibold mb-2">
                Pengukuran Gratis
            </h3>

            <p class="text-xs md:text-sm text-gray-500 leading-relaxed">
                Survey dan pengukuran langsung ke lokasi pelanggan.
            </p>

        </div>

        <!-- ITEM -->
        <div class="bg-white rounded-[24px] p-5 md:p-7 border border-[#92a9da] hover:-translate-y-1 transition duration-300">

            <div class="w-11 h-11 md:w-14 md:h-14 rounded-full border border-[#92a9da] flex items-center justify-center mb-4">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="w-5 h-5 md:w-6 md:h-6 text-[#182d5c]">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M2.25 8.25h19.5M6 15.75h.008v.008H6v-.008Zm3 0h.008v.008H9v-.008Zm3 0h.008v.008H12v-.008Zm3 0h.008v.008H15v-.008Zm3 0h.008v.008H18v-.008ZM3.75 5.25h16.5A1.5 1.5 0 0 1 21.75 6.75v10.5a1.5 1.5 0 0 1-1.5 1.5H3.75a1.5 1.5 0 0 1-1.5-1.5V6.75a1.5 1.5 0 0 1 1.5-1.5Z" />

                </svg>

            </div>

            <h3 class="text-sm md:text-lg font-semibold mb-2">
                Pembayaran Mudah
            </h3>

            <p class="text-xs md:text-sm text-gray-500 leading-relaxed">
                Mendukung transfer bank dan pembayaran digital.
            </p>

        </div>

        <!-- ITEM -->
        <div class="bg-white rounded-[24px] p-5 md:p-7 border border-[#92a9da] hover:-translate-y-1 transition duration-300">

            <div class="w-11 h-11 md:w-14 md:h-14 rounded-full border border-[#92a9da] flex items-center justify-center mb-4">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="w-5 h-5 md:w-6 md:h-6 text-[#182d5c]">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M8.625 9.75a3.375 3.375 0 1 1 6.75 0c0 1.12-.554 2.11-1.403 2.72-.596.427-.972 1.073-.972 1.807v.223m-3.75 0h3.75m-8.25 3.75h12a2.25 2.25 0 0 0 2.25-2.25V7.5A2.25 2.25 0 0 0 16.5 5.25h-9A2.25 2.25 0 0 0 5.25 7.5v8.25A2.25 2.25 0 0 0 7.5 18Z" />

                </svg>

            </div>

            <h3 class="text-sm md:text-lg font-semibold mb-2">
                Material Berkualitas
            </h3>

            <p class="text-xs md:text-sm text-gray-500 leading-relaxed">
                Menggunakan bahan alumunium berkualitas tinggi dan tahan lama.
            </p>

        </div>

        <!-- ITEM -->
        <div class="bg-white rounded-[24px] p-5 md:p-7 border border-[#92a9da] hover:-translate-y-1 transition duration-300">

            <div class="w-11 h-11 md:w-14 md:h-14 rounded-full border border-[#92a9da] flex items-center justify-center mb-4">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="w-5 h-5 md:w-6 md:h-6 text-[#182d5c]">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 14.25 4.5 9.75m0 0L9 5.25m-4.5 4.5h9a6 6 0 0 1 0 12h-3" />

                </svg>

            </div>

            <h3 class="text-sm md:text-lg font-semibold mb-2">
                Pengerjaan Profesional
            </h3>

            <p class="text-xs md:text-sm text-gray-500 leading-relaxed">
                Dikerjakan oleh tenaga berpengalaman dengan hasil presisi.
            </p>

        </div>

    </div>

</section>

<!-- SEARCH -->
{{-- <form method="GET" action="/" class="mb-8 md:mb-10">

    <div class="bg-white rounded-[20px] md:rounded-[24px] shadow-sm p-2 md:p-3 flex items-center gap-2 md:gap-3 border border-[#EFE7DC]">

        <!-- ICON -->
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#F5EFE6] flex items-center justify-center shrink-0">

            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.8"
                 stroke="currentColor"
                 class="w-5 h-5 text-[#182d5c]">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="m21 21-4.35-4.35m0 0A7.95 7.95 0 1 0 5.4 5.4a7.95 7.95 0 0 0 11.25 11.25Z" />

            </svg>

        </div>

        <!-- INPUT -->
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Search furniture..."
               class="w-full border border-[#ffffff] bg-transparent text-sm md:text-base text-[#2B2B2B] placeholder:text-gray-400 px-2 rounded-[20px] md:rounded-[10px]">

        <!-- BUTTON -->
        <button type="submit"
                class="primary-btn px-4 md:px-7 py-3 rounded-2xl text-sm md:text-base font-medium shrink-0">

            Search

        </button>

    </div>

</form> --}}

{{-- FEATURED COLLECTION --}}
<section class="mb-8 md:mb-10 overflow-hidden">

    <div class="flex items-center justify-between mb-6 md:mb-8">

        <div>

            <p class="text-[#182d5c] uppercase tracking-[3px] text-[11px] md:text-xs mb-2">
                Collection
            </p>

            <h2 class="hero-title text-2xl md:text-4xl font-bold">
                Featured Collection
            </h2>

        </div>

    </div>

    <!-- MOBILE SCROLL / DESKTOP GRID -->
    <div class="flex md:grid md:grid-cols-3 gap-4 md:gap-6 overflow-x-auto md:overflow-visible hide-scrollbar pb-2">

        <!-- ITEM -->
        <div class="relative rounded-[28px] overflow-hidden h-[200px] md:h-[400px]
                    min-w-[260px] md:min-w-0 group flex-shrink-0">

            <img src="https://media.dekoruma.com/catalogue/NRA-375453.jpg?auto=webp&bg-color=ffffff&dpr=1.1&fit=bounds&optimize=high&pad=0&quality=60&trim-color=auto"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-700">

            <div class="absolute inset-0 bg-black/30"></div>

            <div class="absolute bottom-0 p-5 md:p-8 text-white">

                <p class="uppercase tracking-[3px] text-[10px] md:text-xs mb-2">
                    Lemari 2 Pintu
                </p>

                <h3 class="text-xl md:text-3xl font-semibold">
                    Minimalis Modern
                </h3>

            </div>

        </div>

        <!-- ITEM -->
        <div class="relative rounded-[28px] overflow-hidden h-[200px] md:h-[400px]
                    min-w-[260px] md:min-w-0 group flex-shrink-0">

            <img src="https://i.pinimg.com/736x/63/d2/2e/63d22e8991328d43330fab7aec3a1b90.jpg"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

            <div class="absolute inset-0 bg-black/30"></div>

            <div class="absolute bottom-0 p-5 md:p-8 text-white">

                <p class="uppercase tracking-[3px] text-[10px] md:text-xs mb-2">
                    Lemari Sliding
                </p>

                <h3 class="text-xl md:text-3xl font-semibold">
                    Hemat Ruang
                </h3>

            </div>

        </div>

        <!-- ITEM -->
        <div class="relative rounded-[28px] overflow-hidden h-[200px] md:h-[400px]
                    min-w-[260px] md:min-w-0 group flex-shrink-0">

            <img src="https://i.pinimg.com/1200x/b9/57/d2/b957d21dd303b7839f4a078734ce388a.jpg"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

            <div class="absolute inset-0 bg-black/30"></div>

            <div class="absolute bottom-0 p-5 md:p-8 text-white">

                <p class="uppercase tracking-[3px] text-[10px] md:text-xs mb-2">
                    Lemari Premium
                </p>

                <h3 class="text-xl md:text-3xl font-semibold">
                    Elegan & Luas
                </h3>

            </div>

        </div>

    </div>

</section>


<!-- CATEGORY -->
<!-- <section class="mb-10 md:mb-14"> -->

    <!-- HEADER -->
    <!-- <div class="flex items-center justify-between mb-6 md:mb-8">

        <div>

            <p class="text-[#182d5c] uppercase tracking-[3px] text-[11px] md:text-xs mb-2">
                Category
            </p>

            <h2 class="hero-title text-2xl md:text-4xl font-bold text-[#2B2B2B]">
                Explore by Category
            </h2>

        </div>

    </div> -->

    <!-- CATEGORY LIST -->
    <!-- <div class="flex gap-3 md:gap-4 overflow-x-auto hide-scrollbar pb-2"> -->

        <!-- ALL -->
        <!-- <a href="/"
           class="shrink-0 rounded-2xl md:rounded-3xl px-5 md:px-6 py-3.5 md:py-4 shadow-sm border border-[#EFE7DC]
           flex items-center gap-3 transition-all duration-300
           {{ request('category') == null
                ? 'bg-[#7D5548] text-white border-[#7D5548]'
                : 'bg-white text-[#2B2B2B] hover:bg-[#7D5548] hover:text-white' }}">

            <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center">

                📦

            </div>

            <span class="font-medium text-sm md:text-base whitespace-nowrap">
                All
            </span>

        </a>

        @foreach($categories as $category)

        <a href="/?category={{ $category->id }}"
           class="shrink-0 rounded-2xl md:rounded-3xl px-5 md:px-6 py-3.5 md:py-4 shadow-sm border border-[#EFE7DC]
           flex items-center gap-3 transition-all duration-300
           {{ request('category') == $category->id
                ? 'bg-[#182d5c] text-white border-[#182d5c]'
                : 'bg-white text-[#2B2B2B] hover:bg-[#182d5c] hover:text-white' }}"> -->

            <!-- ICON -->
            <!-- <div class="w-10 h-10 rounded-2xl bg-[#F6F1EA] flex items-center justify-center">

                @if($category->name == 'Sofa')

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="w-5 h-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 12v5m0-5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2m-16 0v-1a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1m-16 5h16" />

                    </svg>

                @elseif($category->name == 'Chair')

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="w-5 h-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M7 10V6a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4M7 10h10m-10 0v8m10-8v8m-10-4h10" />

                    </svg>

                @elseif($category->name == 'Table')

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="w-5 h-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 8h16M6 8v10m12-10v10" />

                    </svg>

                @elseif($category->name == 'Bed')

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="w-5 h-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 10h18v7H3v-7Zm3-3h3v3H6V7Z" />

                    </svg>

                @elseif($category->name == 'Lamp')

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="w-5 h-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 18h6m-5 0V9.5a3.5 3.5 0 1 1 4 0V18" />

                    </svg>

                @else

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="w-5 h-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 7.5 12 3l9 4.5v9L12 21l-9-4.5v-9Z" />

                    </svg>

                @endif

            </div> -->

            <!-- NAME -->
            <!-- <span class="font-medium text-sm md:text-base whitespace-nowrap">
                {{ $category->name }}
            </span>

        </a>

        @endforeach

    </div>

</section> -->


<!-- PRODUCT -->
<section id="products" class="mb-10 md:mb-14">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6 md:mb-8">

        <div>

            <p class="text-[#182d5c] uppercase tracking-[3px] text-[11px] md:text-xs mb-2">
                Products
            </p>

            <h2 class="hero-title text-2xl md:text-4xl font-bold text-[#2B2B2B]">
                Featured Products
            </h2>

        </div>

    </div>

    <!-- PRODUCT GRID -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

        @foreach($products->take(8) as $product)

        <div class="bg-white rounded-[24px] md:rounded-[30px] overflow-hidden border border-[#EFE7DC] shadow-sm hover:shadow-xl transition-all duration-300 group">

            <!-- IMAGE -->
            <div class="relative overflow-hidden">

                <img 
                    src="{{ asset('produk/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-[170px] md:h-[250px] object-cover group-hover:scale-105 transition duration-500"
                >

                <!-- CATEGORY BADGE -->
                <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full">

                    <p class="text-[10px] md:text-xs font-medium text-[#182d5c] uppercase tracking-[1px]">

                        {{ $product->category->name ?? '-' }}

                    </p>

                </div>

            </div>

            <!-- CONTENT -->
            <div class="p-4 md:p-5">

                <!-- NAME -->
                <h3 class="text-sm md:text-lg font-semibold mb-2 line-clamp-1 text-[#2B2B2B]">
                    {{ $product->name }}
                </h3>

                <!-- DESCRIPTION -->
                <p class="text-[11px] md:text-sm text-gray-500 mb-4 line-clamp-2 leading-relaxed">
                    {{ $product->description }}
                </p>

                <!-- PRICE -->
                <div class="mb-4">

                    <p class="text-base md:text-2xl font-bold text-[#182d5c]">
                        Rp {{ number_format($product->price) }}
                    </p>

                    <p class="text-[11px] md:text-sm text-gray-400 mt-1">
                        Stock: {{ $product->stock }}
                    </p>

                </div>

                <!-- BUTTON -->
                <div class="flex flex-col gap-2">

                    <!-- DETAIL -->
                    <a href="/product/{{ $product->id }}"
                       class="w-full border border-[#c7cae5] py-2.5 md:py-3 rounded-xl md:rounded-2xl text-center text-xs md:text-sm font-medium hover:bg-[#ecedf8] transition">

                        Detail

                    </a>

                    <!-- ADD CART -->
                    @auth

                    <button
                        onclick="addToCart({{ $product->id }}, this)"
                        class="w-full bg-[#182d5c] hover:bg-[#445389] text-white py-2.5 md:py-3 rounded-xl md:rounded-2xl text-xs md:text-sm font-medium transition-all duration-300 active:scale-95 add-cart-btn">
                        Add to Cart
                    </button>

                    @else

                    <a href="{{ route('login') }}"
                        class="block w-full text-center bg-[#182d5c] hover:bg-[#445389] text-white py-2.5 md:py-3 rounded-xl md:rounded-2xl text-xs md:text-sm font-medium transition-all duration-300">
                        Add to Cart
                    </a>

                    </button>
                    @endauth

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <!-- BUTTON -->
    <div class="flex justify-center mt-8 md:mt-12">

        <a href="/products"
           class="bg-[#182d5c] hover:bg-[#445389] text-white px-7 md:px-9 py-3 md:py-4 rounded-full text-sm md:text-base font-medium shadow-sm transition-all duration-300">

            Lihat Semua Produk

        </a>

    </div>

</section>


<!-- INSTAGRAM -->
    <section id="instagram" class="mb-16 md:mb-24 mt-10 md:mt-16 bg-[#d9dae7] rounded-[40px] px-5 md:px-10 py-10 md:py-14">

    <!-- SEPARATOR -->
    <div class="flex items-center gap-4 mb-10 md:mb-14">

        <div class="h-px bg-[#40509e] w-full"></div>

        <p class="uppercase tracking-[4px] text-[11px] md:text-sm text-[#182d5c] whitespace-nowrap">
            Social Media
        </p>

        <div class="h-px bg-[#40509e] w-full"></div>

    </div>

    <div class="text-center mb-8 md:mb-10">

        <h2 class="hero-title text-3xl md:text-5xl font-bold mb-3">
            Follow Our Instagram
        </h2>

        <a href="https://instagram.com/budialumunium_122"
           target="_blank"
           class="inline-flex items-center gap-2 text-[#182d5c] hover:text-[#6F472D] transition font-medium text-sm md:text-base">

            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="currentColor"
                 viewBox="0 0 24 24"
                 class="w-5 h-5">

                <path d="M7.75 2C4.574 2 2 4.574 2 7.75v8.5C2 19.426 4.574 22 7.75 22h8.5C19.426 22 22 19.426 22 16.25v-8.5C22 4.574 19.426 2 16.25 2h-8.5Zm0 1.5h8.5A4.25 4.25 0 0 1 20.5 7.75v8.5a4.25 4.25 0 0 1-4.25 4.25h-8.5A4.25 4.25 0 0 1 3.5 16.25v-8.5A4.25 4.25 0 0 1 7.75 3.5Zm9.25 1a1 1 0 1 0 1 1 1 1 0 0 0-1-1ZM12 6.5A5.5 5.5 0 1 0 17.5 12 5.506 5.506 0 0 0 12 6.5Zm0 1.5A4 4 0 1 1 8 12a4.005 4.005 0 0 1 4-4Z"/>

            </svg>

            @budialumunium_122

        </a>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-5">

        <img src="https://i.pinimg.com/1200x/ae/c2/0b/aec20b3608113ec5c97f611e868f64c4.jpg"
             class="rounded-[22px] md:rounded-[30px] h-[150px] md:h-[260px] w-full object-cover hover:scale-[1.02] transition duration-300">

        <img src="https://images.pexels.com/photos/32331031/pexels-photo-32331031.png"
             class="rounded-[22px] md:rounded-[30px] h-[150px] md:h-[260px] w-full object-cover hover:scale-[1.02] transition duration-300">

        <img src="https://images.pexels.com/photos/8134812/pexels-photo-8134812.jpeg"
             class="rounded-[22px] md:rounded-[30px] h-[150px] md:h-[260px] w-full object-cover hover:scale-[1.02] transition duration-300">

        <img src="https://images.pexels.com/photos/32331030/pexels-photo-32331030.png"
             class="rounded-[22px] md:rounded-[30px] h-[150px] md:h-[260px] w-full object-cover hover:scale-[1.02] transition duration-300">

    </div>

</section>



<!-- FAQ -->
<section id="faq" class="mb-10 md:mb-10 mt-6 md:mt-10">

    <!-- SEPARATOR -->
    <div class="flex items-center gap-4 mb-10 md:mb-14">

        <div class="h-px bg-[#40509e] w-full"></div>

        <p class="uppercase tracking-[4px] text-[11px] md:text-sm text-[#182d5c] whitespace-nowrap">
            FAQ
        </p>

        <div class="h-px bg-[#40509e] w-full"></div>

    </div>

    <div class="text-center mb-10">

        <h2 class="hero-title text-3xl md:text-5xl font-bold mb-3">
            Frequently Asked Questions
        </h2>

        <p class="text-gray-500 text-sm md:text-base">
            Pertanyaan yang sering ditanyakan pelanggan.
        </p>

    </div>

    <div class="space-y-5 max-w-4xl mx-auto">

        <!-- ITEM -->
        <div class="bg-white border border-[#d1d4e8] rounded-[28px] p-6 md:p-7 shadow-sm hover:shadow-md transition">

            <div class="flex items-start gap-4">

                <div class="w-11 h-11 rounded-full bg-[#e6e8f5] flex items-center justify-center shrink-0">

                    <span class="text-[#182d5c] text-lg">
                        ?
                    </span>

                </div>

                <div>

                    <h3 class="font-semibold text-lg mb-2">
                        Apakah bisa custom furniture?
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Ya, kami menerima custom desain sesuai kebutuhan dan ukuran ruangan Anda.
                    </p>

                </div>

            </div>

        </div>

        <!-- ITEM -->
        <div class="bg-white border border-[#d1d4e8] rounded-[28px] p-6 md:p-7 shadow-sm hover:shadow-md transition">

            <div class="flex items-start gap-4">

                <div class="w-11 h-11 rounded-full bg-[#e6e8f5] flex items-center justify-center shrink-0">

                    <span class="text-[#182d5c] text-lg">
                        ?
                    </span>

                </div>

                <div>

                    <h3 class="font-semibold text-lg mb-2">
                        Berapa lama pengiriman?
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Estimasi pengiriman sekitar 2–7 hari tergantung lokasi pengiriman.
                    </p>

                </div>

            </div>

        </div>

        <!-- ITEM -->
        <div class="bg-white border border-[#d1d4e8] rounded-[28px] p-6 md:p-7 shadow-sm hover:shadow-md transition">

            <div class="flex items-start gap-4">

                <div class="w-11 h-11 rounded-full bg-[#e6e8f5] flex items-center justify-center shrink-0">

                    <span class="text-[#182d5c] text-lg">
                        ?
                    </span>

                </div>

                <div>

                    <h3 class="font-semibold text-lg mb-2">
                        Apakah ada garansi?
                    </h3>

                    <p class="text-gray-500 text-sm leading-relaxed">
                        Tersedia garansi produk untuk kerusakan tertentu sesuai syarat dan ketentuan.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- FOOTER -->
<footer class="bg-[#182d5c] text-white rounded-t-[40px] ">

    <div class="max-w-7xl mx-auto px-6 py-14">

        <div class="grid md:grid-cols-3 gap-10">

            <div>
                <h3 class="text-2xl font-semibold mb-4 ml-4">
                    Budi Alumunium
                </h3>

                <p class="text-gray-200 text-sm ml-4">
                    Furniture aesthetic modern dengan kualitas premium untuk rumah impian Anda.
                </p>
            </div>

            <div>
                <h4 class="font-semibold mb-4 ml-4">
                    Contact
                </h4>

                <div class="space-y-2 text-gray-200 text-sm ml-4">
                    <p>Email: hilmybudi11@gmail.com</p>
                    <p>WhatsApp: 087764729505</p>
                    <p>Pati, Indonesia</p>
                </div>
            </div>

            <div>
                <h4 class="font-semibold mb-4 ml-4">
                    Social Media
                </h4>

                <div class="space-y-2 text-gray-200 text-sm ml-4">
                    <p>Instagram</p>
                    <p>TikTok</p>
                    <p>Facebook</p>
                </div>
            </div>

        </div>

        <div class="border-t border-white/10 mt-10 pt-6 text-center text-sm text-white-500">
            © 2026 Budi Alumunium. All rights reserved.
        </div>

    </div>

</footer>

<!-- TOAST -->
<div id="toast"
     class="fixed top-5 right-5 mt-20 translate-x-[120%] transition-all duration-500 z-[9999]">

    <div class="bg-[#2B2B2B] text-white px-5 py-4 rounded-2xl shadow-2xl flex items-center gap-3">

        <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-sm">
            ✓
        </div>

        <div>
            <p class="font-medium text-sm">
                Added to Cart
            </p>

            <p class="text-xs text-gray-300">
                Product successfully added
            </p>
        </div>

    </div>

</div>

<script>

async function addToCart(productId, button)
{
    let originalText = button.innerHTML;

    try {

        button.disabled = true;
        button.innerHTML = 'Adding...';

        const response = await fetch('/cart/add', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            },

            body: JSON.stringify({
                product_id: productId
            })

        });

        // kalau belum login
        if(response.redirected){

            window.location.href = response.url;
            return;
        }

        const data = await response.json();

        if(data.success){

            button.innerHTML = '✓ Added';
            button.classList.add('bg-green-600');

            const toast = document.getElementById('toast');

            toast.classList.remove('translate-x-[120%]');

            setTimeout(() => {

                toast.classList.add('translate-x-[120%]');

            }, 2500);

        }
        // UPDATE CART BADGE
        const cartBadge = document.getElementById('cart-count');

        if(cartBadge){

            cartBadge.innerText = data.cart_count;

            cartBadge.classList.add('animate-bounce');

            setTimeout(() => {

                cartBadge.classList.remove('animate-bounce');

            }, 500);
        }

    } catch (error) {

        console.log(error);

        button.innerHTML = 'Failed';

    }

    setTimeout(() => {

        button.disabled = false;
        button.innerHTML = originalText;
        button.classList.remove('bg-green-600');

    }, 1800);
}

</script>
@endsection
