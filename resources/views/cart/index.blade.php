@extends('layouts.app')

@section('content')

@if(session('success'))

<div class="mb-5 bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-2xl">
    {{ session('success') }}
</div>

@endif

@if(session('error'))

<div class="mb-5 bg-red-100 border border-red-200 text-red-700 px-5 py-4 rounded-2xl">
    {{ session('error') }}
</div>

@endif

<section class="max-w-7xl mx-auto pb-[140px] lg:pb-10">

    <!-- TITLE -->
    <div class="mb-8 md:mb-10">

        <p class="uppercase tracking-[4px] text-[11px] md:text-sm text-[#182d5c] mb-3">
            Keranjang Belanja
        </p>

        <h1 class="text-3xl md:text-5xl font-bold hero-title">
            Keranjang Anda
        </h1>

    </div>

    @if($carts->count() == 0)

    <!-- EMPTY -->
    <div class="bg-white border border-[#d1d7e8] rounded-[30px] p-10 text-center">

        <div class="text-5xl mb-4">
            🛒
        </div>

        <h2 class="text-2xl font-semibold mb-2">
            Keranjang Kosong
        </h2>

        <p class="text-gray-500 mb-6">
            Belum ada produk yang ditambahkan ke keranjang.
        </p>

        <a href="/"
           class="inline-block px-6 py-3 rounded-2xl bg-[#182d5c] hover:bg-[#445389] text-white transition">

            Lihat Produk

        </a>

    </div>

    @else

<div class="grid lg:grid-cols-3 gap-6">

    <!-- LEFT -->
    <div class="lg:col-span-2 space-y-4">

        @foreach($carts as $cart)

        @php
            $subtotal = $cart->product->price * $cart->quantity;
        @endphp

        <div class="bg-white border border-[#dce2ef] rounded-[26px] overflow-hidden shadow-sm hover:shadow-md transition">

            <div class="flex items-center gap-3 p-3 md:p-5">

                <!-- CHECKBOX -->
                <div class="shrink-0">

                    <input type="checkbox"
                           name="selected_items[]"
                           value="{{ $cart->id }}"
                           checked
                           data-price="{{ $subtotal }}"
                           data-qty="{{ $cart->quantity }}"
                           class="cart-checkbox w-5 h-5 rounded border-[#dce2ef] text-[#283b65] focus:ring-[#243660]">

                </div>

                <!-- IMAGE -->
                <div class="w-24 h-24 md:w-32 md:h-32 shrink-0">

                    <img src="{{ asset('produk/' . $cart->product->image) }}"
                         class="w-full h-full object-cover rounded-2xl">

                </div>

                <!-- CONTENT -->
                <div class="flex-1 min-w-0">

                    <p class="uppercase tracking-[2px] text-[10px] text-[#687bb0] mb-1">

                        {{ $cart->product->category?->name }}

                    </p>

                    <h2 class="text-sm md:text-xl font-semibold text-[#2B2B2B] line-clamp-1 mb-1">

                        {{ $cart->product->name }}

                    </h2>

                    <p class="hidden md:block text-sm text-gray-500 line-clamp-2 mb-4">

                        {{ $cart->product->description }}

                    </p>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                        <!-- PRICE -->
                        <div>

                            <h3 class="text-base md:text-xl font-bold text-[#182d5c]">

                                Rp {{ number_format($cart->product->price) }}

                            </h3>

                            <p class="text-xs md:text-sm text-gray-500 mt-1">

                                Subtotal :
                                Rp {{ number_format($subtotal) }}

                            </p>

                        </div>

                        <!-- QTY -->
                        <div class="flex items-center gap-2">

                            <form action="/cart/minus/{{ $cart->id }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="w-8 h-8 md:w-10 md:h-10 rounded-xl bg-[#e6e8f5] hover:bg-[#c7d1e7] transition text-base">

                                    −

                                </button>

                            </form>

                            <div class="w-8 text-center font-semibold">

                                {{ $cart->quantity }}

                            </div>

                            <form action="/cart/plus/{{ $cart->id }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="w-8 h-8 md:w-10 md:h-10 rounded-xl bg-[#e6e8f5] hover:bg-[#c7d1e7] transition text-base">

                                    +

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <!-- RIGHT -->
    <div>

        <div class="hidden lg:block bg-white border border-[#dce2ef] rounded-[30px] p-6 sticky top-28">

            <h2 class="text-2xl font-semibold mb-6">
                Order Summary
            </h2>

            <div class="space-y-4 mb-6">

                <div class="flex justify-between text-sm">

                    <span class="text-gray-500">
                        Total Item
                    </span>

                    <span id="desktopTotalItems">
                        0
                    </span>

                </div>

                <div class="flex justify-between text-sm">

                    <span class="text-gray-500">
                        Shipping
                    </span>

                    <span>
                        Free
                    </span>

                </div>

                <div class="border-t pt-4 flex justify-between text-lg font-bold">

                    <span>
                        Total
                    </span>

                    <span class="text-[#182d5c]"
                          id="desktopGrandTotal">

                        Rp 0

                    </span>

                </div>

            </div>

            <!-- FORM CHECKOUT -->
            <form id="checkoutForm"
                  action="{{ route('checkout.store') }}"
                  method="POST">

                @csrf

                <div id="selectedItemsContainer"></div>

                <button type="submit"
                        class="w-full bg-[#182d5c] hover:bg-[#445389] transition text-white py-4 rounded-full font-medium">

                    Checkout Now

                </button>

            </form>

        </div>

    </div>

</div>

<!-- MOBILE STICKY -->
<div class="lg:hidden fixed bottom-0 left-0 right-0 z-[9999] bg-white border-t border-[#E8DED1] px-5 py-4 shadow-[0_-5px_20px_rgba(0,0,0,0.05)]">

    <div class="flex items-center justify-between mb-3">

        <div>

            <p class="text-xs text-gray-500">
                Total
            </p>

            <h3 class="text-xl font-bold text-[#8B5E3C]"
                id="mobileGrandTotal">

                Rp 0

            </h3>

        </div>

        <div class="text-right">

            <p class="text-xs text-gray-500">
                Items
            </p>

            <p class="font-semibold"
               id="mobileTotalItems">

                0

            </p>

        </div>

    </div>

    <button type="submit"
            form="checkoutForm"
            class="w-full bg-[#8B5E3C] hover:bg-[#6F472D] transition text-white py-3 rounded-2xl font-medium">

        Checkout Now

    </button>

</div>

@endif

</section>

<!-- SCRIPT -->
<script>

    const checkboxes = document.querySelectorAll('.cart-checkbox');

    const desktopTotal = document.getElementById('desktopGrandTotal');
    const desktopItems = document.getElementById('desktopTotalItems');

    const mobileTotal = document.getElementById('mobileGrandTotal');
    const mobileItems = document.getElementById('mobileTotalItems');

    const selectedItemsContainer = document.getElementById('selectedItemsContainer');

    function updateSummary() {

        let total = 0;
        let items = 0;

        selectedItemsContainer.innerHTML = '';

        checkboxes.forEach((checkbox) => {

            if (checkbox.checked) {

                total += parseInt(checkbox.dataset.price);
                items += parseInt(checkbox.dataset.qty);

                selectedItemsContainer.innerHTML += `
                    <input type="hidden"
                           name="selected_items[]"
                           value="${checkbox.value}">
                `;

            }

        });

        const formatted = 'Rp ' + total.toLocaleString('id-ID');

        desktopTotal.innerText = formatted;
        mobileTotal.innerText = formatted;

        desktopItems.innerText = items;
        mobileItems.innerText = items;

    }

    checkboxes.forEach((checkbox) => {

        checkbox.addEventListener('change', updateSummary);

    });

    updateSummary();

</script>

@endsection