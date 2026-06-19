@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto pb-14">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-8 md:mb-10">

        <div>

            <p class="uppercase tracking-[4px] text-[11px] text-[#182d5c] mb-3">
                Produk Alumunium
            </p>

            <h1 class="hero-title text-3xl md:text-5xl font-bold text-[#0F172A] leading-tight">
                Jelajahi Semua Produk
            </h1>

            <p class="text-slate-500 mt-3 text-sm md:text-base">
                Kusen, pintu, jendela, partisi kaca, etalase dan berbagai kebutuhan alumunium berkualitas.
            </p>

        </div>

        <!-- FILTER -->
        <form method="GET"
              action="/products"
              class="w-full lg:w-auto">

            <div class="bg-white border border-[#E8DED1] rounded-[28px] p-3 flex flex-col md:flex-row gap-3 shadow-sm">

                <!-- SEARCH -->
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari Produk..."
                       class="w-full md:w-[280px] px-5 py-3 rounded-2xl border border-[#E8DED1] focus:outline-none focus:border-[#8B5E3C] text-sm">

                <!-- SORT -->
                <select name="sort"
                        class="px-5 py-3 rounded-2xl border border-[#E8DED1] focus:outline-none focus:border-[#8B5E3C] text-sm">

                    <option value="">
                        Produk Terbaru
                    </option>

                    <option value="low"
                        {{ request('sort') == 'low' ? 'selected' : '' }}>
                        Harga Terendah
                    </option>

                    <option value="high"
                        {{ request('sort') == 'high' ? 'selected' : '' }}>
                        Harga Tertinggi
                    </option>

                </select>

                <!-- BUTTON -->
                <button class="bg-[#182d5c] hover:bg-[#36417b] transition text-white px-6 py-3 rounded-2xl text-sm font-medium">
                    Terapkan
                </button>

            </div>

        </form>

    </div>

    <!-- PRODUCT GRID -->
    <div class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4 md:gap-6">

        @foreach($products as $product)

        <div class="group bg-white rounded-[28px] overflow-hidden border border-[#c7cae5] shadow-sm hover:shadow-xl transition duration-300">

            <!-- IMAGE -->
            <div class="overflow-hidden relative">

                <img src="{{ asset('produk/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-[180px] md:h-[240px] object-cover group-hover:scale-105 transition duration-700">

            </div>

            <!-- CONTENT -->
            <div class="p-4 md:p-5">

                <!-- CATEGORY -->
                <p class="text-[10px] md:text-xs uppercase tracking-[3px] text-[#182d5c] mb-2">

                    {{ $product->category?->name }}

                </p>

                <!-- NAME -->
                <h3 class="text-sm md:text-lg font-semibold text-[#2B2B2B] line-clamp-1 mb-2">

                    {{ $product->name }}

                </h3>

                <!-- DESCRIPTION -->
                <p class="text-xs md:text-sm text-gray-500 line-clamp-2 mb-4 leading-relaxed">

                    {{ $product->description }}

                </p>

                <!-- PRICE -->
                <div class="mb-4">

                    <h4 class="text-lg md:text-2xl font-bold text-[#182d5c]">

                        Rp {{ number_format($product->price) }}

                    </h4>

                    <p class="text-xs text-gray-400 mt-1">

                        Stock {{ $product->stock }}

                    </p>

                </div>

                <!-- BUTTON -->
                <div class="flex flex-col gap-2">

                <a href="/product/{{ $product->id }}"
                class="w-full border border-[#c7cae5] hover:bg-[#ececf8] transition py-2.5 rounded-2xl text-center text-sm font-medium">

                    View Detail

                </a>

                @auth

                <button
                    onclick="addToCart({{ $product->id }}, this)"
                    class="w-full bg-[#182d5c] hover:bg-[#445389] transition text-white py-2.5 rounded-2xl text-sm font-medium add-cart-btn">
                    Add to Cart
                </button>

                @else

                <a href="{{ route('login') }}"
                class="block w-full text-center bg-[#182d5c] hover:bg-[#445389] transition text-white py-2.5 rounded-2xl text-sm font-medium">

                    Add to Cart

                </a>

                @endauth


            </div>

            </div>

        </div>

        @endforeach

    </div>

    <!-- PAGINATION -->
    <div class="mt-10">

        {{ $products->links() }}

    </div>

</section>

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