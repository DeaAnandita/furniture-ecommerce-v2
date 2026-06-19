@extends('layouts.app')

@section('content')

<style>

    body{
        font-family: 'Poppins', sans-serif;
        background: #eff2f8;
        color: #2B2B2B;
    }

    .hero-title{
        font-family: 'Playfair Display', serif;
    }

    .product-wrapper{
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.6);
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
    }

    .glass-effect{
        background: rgba(255,255,255,0.45);
        backdrop-filter: blur(10px);
    }

    .info-card{
        background: #f2f3fa;
        border: 1px solid #daddef;
        transition: .3s ease;
    }

    .info-card:hover{
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.04);
    }

    .primary-btn{
        background: linear-gradient(135deg, #182d5c, #445389);
        transition: .3s ease;
    }

    .primary-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(139,94,60,0.25);
    }

    .secondary-btn{
        background: white;
        border: 1px solid #E7DED3;
        transition: .3s ease;
    }

    .secondary-btn:hover{
        background: #F8F3EC;
    }

</style>

<section class="max-w-7xl mx-auto ">

    <!-- BREADCRUMB -->
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6 md:mb-8">

        <a href="/"
           class="hover:text-[#8B5E3C] transition">

            Home

        </a>

        <span>
            /
        </span>

        <span class="text-[#182d5c] font-medium line-clamp-1">
            {{ $product->name }}
        </span>

    </div>

    <!-- PRODUCT -->
<div class="product-wrapper rounded-[28px] overflow-hidden grid lg:grid-cols-2 max-w-7xl mx-auto">

    <!-- IMAGE -->
    <div class="relative bg-gradient-to-br from-[#d7dbef] via-[#e6e9f5] to-[#c1c6e6] p-4 md:p-5 flex items-center justify-center overflow-hidden">

        <!-- glow -->
        <div class="absolute -top-16 -left-16 w-32 h-32 bg-white/40 rounded-full blur-3xl"></div>

        <div class="absolute -bottom-16 -right-16 w-32 h-32 bg-[#D9B99B]/30 rounded-full blur-3xl"></div>

        <!-- image box -->
        <div class="relative z-10 w-full max-w-[420px] aspect-square rounded-[28px] overflow-hidden bg-white shadow-[0_20px_40px_rgba(0,0,0,0.08)]">

            <img 
                src="{{ asset('produk/' . $product->image) }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover hover:scale-105 transition duration-700"
            >

        </div>

    </div>

    <!-- CONTENT -->
    <div class="p-5 md:p-7 flex flex-col justify-center">

        <!-- CATEGORY -->
        <div class="mb-3">

            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#e5e7f6] text-[#3c478b] text-[10px] md:text-xs uppercase tracking-[2px] font-medium">

                ✦ {{ $product->category?->name }}

            </span>

        </div>

        <!-- TITLE -->
        <h1 class="hero-title text-2xl md:text-3xl font-bold leading-snug mb-3">

            {{ $product->name }}

        </h1>

        <!-- DESC -->
        <p class="text-sm md:text-base text-gray-600 leading-relaxed mb-5">

            {{ $product->description }}

        </p>

        <!-- PRICE -->
        <div class="mb-5">

            <p class="text-xs text-gray-500 mb-1">
                Price
            </p>

            <h2 class="text-xl md:text-2xl font-bold text-[#182d5c]">

                Rp {{ number_format($product->price) }}

            </h2>

        </div>

            <!-- INFO -->
            <div class="grid grid-cols-3 gap-3 md:gap-4 mb-8 md:mb-10">

                <!-- STOCK -->
                <div class="info-card rounded-2xl p-3 md:p-5 text-center">

                    <p class="text-[11px] md:text-xs uppercase tracking-[2px] text-gray-500 mb-1">
                        Stock
                    </p>

                    <h3 class="font-semibold text-sm md:text-lg">
                        {{ $product->stock }}
                    </h3>

                </div>

                <!-- MATERIAL -->
                <div class="info-card rounded-2xl p-3 md:p-5 text-center">

                    <p class="text-[11px] md:text-xs uppercase tracking-[2px] text-gray-500 mb-1">
                        Material
                    </p>

                    <h3 class="font-semibold text-xs md:text-base line-clamp-1">
                        {{ $product->material?->name }}
                    </h3>

                </div>

                <!-- STYLE -->
                <div class="info-card rounded-2xl p-3 md:p-5 text-center">


                    <p class="text-[11px] md:text-xs uppercase tracking-[2px] text-gray-500 mb-1">
                        Style
                    </p>

                    <h3 class="font-semibold text-xs md:text-base line-clamp-1">
                        {{ $product->style?->name }}
                    </h3>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex flex-col sm:flex-row gap-4">

                <!-- ADD TO CART -->
                @auth

                <button
                    onclick="addToCart({{ $product->id }}, this)"
                    class="primary-btn flex-1 text-white py-4 rounded-full text-sm md:text-lg font-medium"> Add to Cart
                </button>

                @else

                <a href="{{ route('login') }}"
                class="primary-btn flex-1 text-center text-white py-4 rounded-full text-sm md:text-lg font-medium block">

                    Add to Cart

                </a>

                @endauth

                <!-- BACK -->
                <a href="/"
                   class="secondary-btn flex items-center justify-center px-8 py-4 rounded-full text-sm md:text-lg font-medium">

                    Back to Home

                </a>

            </div>

        </div>

    </div>

</section>

<!-- TOAST -->
<div id="toast"
     class="fixed top-5 right-5 translate-x-[130%] transition-all duration-500 z-[9999]">

    <div class="glass-effect border border-white/50 shadow-2xl rounded-2xl px-5 py-4 flex items-center gap-4">

        <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center text-lg">
            ✓
        </div>

        <div>

            <h3 class="font-semibold text-sm">
                Added to Cart
            </h3>

            <p class="text-xs text-gray-500">
                Product successfully added
            </p>

        </div>

    </div>

</div>

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