@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 mt-8">

    <!-- TOP BAR -->
        
            <!-- LEFT -->
            <div>

                <p class="uppercase tracking-[3px] text-[10px] sm:text-xs text-[#8B5E3C] mb-2">
                    Furniture Admin Panel
                </p>

                <h2 class="text-2xl sm:text-3xl font-bold text-[#2B2B2B] leading-tight">
                    Store Management
                </h2>

            </div>

    <a href="/admin/products/create"
       class="inline-flex items-center justify-center gap-2 bg-[#8B5E3C] hover:bg-[#6B4636] transition text-white px-5 md:px-7 py-3 rounded-2xl font-medium shadow-lg shadow-[#8B5E3C]/20">
        + Tambah Produk
    </a>

</div>

<!-- SUCCESS -->
@if(session('success'))

<div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl">

    {{ session('success') }}

</div>

@endif

<!-- PRODUCT TABLE -->
<div class="bg-white border border-[#EFE7DC] rounded-[32px] shadow-sm overflow-hidden">

    <!-- TOP -->
    <div class="p-5 md:p-7 border-b border-[#F3ECE3]">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <p class="uppercase tracking-[3px] text-[11px] text-[#8B5E3C] mb-2">
                    Product List
                </p>

                <h2 class="text-xl md:text-2xl font-bold">
                    All Products
                </h2>

            </div>

            <div class="bg-[#F8F3EC] px-4 py-3 rounded-2xl">

                <p class="text-sm text-gray-500">
                    Total Product
                </p>

                <h3 class="font-bold text-[#7D5548]">
                    {{ $products->total() }} Items
                </h3>

            </div>

        </div>

    </div>

    <!-- FILTER -->
<div class="px-5 md:px-7 pb-6 mt-4 border-b border-[#F3ECE3]">

    <form method="GET"
          action="/admin/products"
          class="flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">

        <!-- SEARCH -->
        <div class="flex-1">

            <div class="relative">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari produk..."
                       class="w-full bg-[#F8F3EC] border border-[#E8DED1] rounded-2xl pl-12 pr-4 py-3 text-sm focus:outline-none focus:border-[#8B5E3C]">

                <!-- ICON -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="w-5 h-5 text-[#8B5E3C] absolute left-4 top-1/2 -translate-y-1/2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="m21 21-4.35-4.35m0 0A7.95 7.95 0 1 0 5.4 5.4a7.95 7.95 0 0 0 11.25 11.25Z" />

                </svg>

            </div>

        </div>

        <!-- FILTER -->
        <div class="flex flex-col sm:flex-row gap-3">

            <!-- CATEGORY -->
            <select name="category"
                    class="bg-[#F8F3EC] border border-[#E8DED1] rounded-2xl  text-sm focus:outline-none focus:border-[#8B5E3C]">

                <option value="">
                    Semua Kategori
                </option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

            <!-- SORT -->
            <select name="sort"
                    class="bg-[#F8F3EC] border border-[#E8DED1] rounded-2xl px-4 py-3 text-sm focus:outline-none focus:border-[#8B5E3C]">

                <option value="">
                    Sort
                </option>

                <option value="latest"
                    {{ request('sort') == 'latest' ? 'selected' : '' }}>
                    Terbaru
                </option>

                <option value="low"
                    {{ request('sort') == 'low' ? 'selected' : '' }}>
                    Harga Termurah
                </option>

                <option value="high"
                    {{ request('sort') == 'high' ? 'selected' : '' }}>
                    Harga Termahal
                </option>

            </select>

            <!-- BUTTON -->
            <button type="submit"
                    class="bg-[#8B5E3C] hover:bg-[#6B4636] text-white px-6 py-3 rounded-2xl text-sm font-medium transition">

                Filter

            </button>

        </div>

    </form>

</div>

    <!-- MOBILE CARD -->
    <div class="block lg:hidden p-4 space-y-4">

        @forelse($products as $product)

        <div class="border border-[#EFE7DC] rounded-3xl p-4 relative">

    <!-- NUMBER -->
    <div class="absolute top-4 left-4 bg-[#F8F3EC] text-[#7D5548] text-xs font-semibold px-3 py-1 rounded-full">
        {{ $loop->iteration }}
    </div>

            <div class="flex gap-4">

                <img src="{{ asset('produk/' . $product->image) }}"
                     class="w-24 h-24 object-cover rounded-2xl">

                <div class="flex-1 min-w-0">

                    <h3 class="font-bold text-lg line-clamp-1">
                        {{ $product->name }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $product->category->name ?? '-' }}
                    </p>

                    <div class="mt-3">

                        <p class="text-[#7D5548] font-bold">
                            Rp {{ number_format($product->price) }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            Stock : {{ $product->stock }}
                        </p>
                        <div class="flex gap-3 mt-4">

                        <a href="/admin/products/{{ $product->id }}/edit"
                        class="flex-1 text-center bg-[#F8F3EC] hover:bg-[#ECE2D4] text-[#7D5548] py-2 rounded-xl text-sm font-medium transition">
                            Edit
                        </a>

                        <form action="/admin/products/{{ $product->id }}"
                            method="POST"
                            class="flex-1"
                            onsubmit="return confirm('Hapus produk ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="w-full bg-red-50 hover:bg-red-100 text-red-500 py-2 rounded-xl text-sm font-medium transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        @empty

        <div class="text-center py-12 text-gray-400">
            Belum ada produk.
        </div>

        @endforelse

    </div>

    @php

        function sortDirection($column)
        {
            if(request('sort') == $column && request('direction') == 'asc') {

                return 'desc';

            }

            return 'asc';
        }

    @endphp
    <!-- DESKTOP TABLE -->
    <div class="hidden lg:block overflow-x-auto">

        <table class="w-full">

            <thead>

<tr class="text-left text-sm text-gray-400 border-b border-[#F3ECE3]">

    <th class="px-4 py-5 text-center">
        No
    </th>

    <!-- PRODUCT -->
    <th class="px-7 py-5 font-medium">

        <a href="?sort=name&direction={{ sortDirection('name') }}"
           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

            Product

            @if(request('sort') == 'name')

                {{ request('direction') == 'asc' ? '↑' : '↓' }}

            @endif

        </a>

    </th>

    <!-- CATEGORY -->
    <th class="px-7 py-5 font-medium">

        <a href="?sort=category&direction={{ sortDirection('category') }}"
           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

            Category

            @if(request('sort') == 'category')

                {{ request('direction') == 'asc' ? '↑' : '↓' }}

            @endif

        </a>

    </th>

    <!-- MATERIAL -->
    <th class="px-7 py-5 font-medium">

        <a href="?sort=material&direction={{ sortDirection('material') }}"
           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

            Material

            @if(request('sort') == 'material')

                {{ request('direction') == 'asc' ? '↑' : '↓' }}

            @endif

        </a>

    </th>

    <!-- STYLE -->
    <th class="px-7 py-5 font-medium">

        <a href="?sort=style&direction={{ sortDirection('style') }}"
           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

            Style

            @if(request('sort') == 'style')

                {{ request('direction') == 'asc' ? '↑' : '↓' }}

            @endif

        </a>

    </th>

    <!-- PRICE -->
    <th class="px-7 py-5 font-medium">

        <a href="?sort=price&direction={{ sortDirection('price') }}"
           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

            Price

            @if(request('sort') == 'price')

                {{ request('direction') == 'asc' ? '↑' : '↓' }}

            @endif

        </a>

    </th>

    <!-- STOCK -->
    <th class="px-7 py-5 font-medium">

        <a href="?sort=stock&direction={{ sortDirection('stock') }}"
           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

            Stock

            @if(request('sort') == 'stock')

                {{ request('direction') == 'asc' ? '↑' : '↓' }}

            @endif

        </a>

    </th>

    <th class="px-7 py-5 font-medium text-center">
        Action
    </th>

</tr>

</thead>

            <tbody>

                @forelse($products as $product)

                <tr class="border-b border-[#F8F2EA] hover:bg-[#FCFAF7] transition">

                    <!-- NUMBER -->
                    <td class="font-semibold text-gray-500 text-center">
                        {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                    </td>
                    <!-- PRODUCT -->
                    <td class="px-7 py-5">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('produk/' . $product->image) }}"
                                 class="w-full h-[100px] rounded-2xl object-cover">
                            <div>
                                <h3 class="font-semibold text-lg">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-sm text-gray-500 line-clamp-1 mt-1">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <!-- CATEGORY -->
                    <td class="px-7 py-5">
                        <span class="bg-[#F8F3EC] text-[#7D5548] px-4 py-2 rounded-full text-sm">
                            {{ $product->category->name ?? '-' }}
                        </span>
                    </td>

                    <!-- MATERIAL -->
                    <td class="px-7 py-5 text-gray-600">
                        {{ $product->material->name ?? '-' }}
                    </td>

                    <!-- STYLE -->
                    <td class="px-7 py-5 text-gray-600">
                        {{ $product->style->name ?? '-' }}
                    </td>

                    <!-- PRICE -->
                    <td class="px-7 py-5">
                        <span class="inline-block whitespace-nowrap font-semibold text-[#7D5548] px-4 py-2 rounded-full text-sm">
                            Rp. {{ number_format($product->price) }}
                        </span>
                    </td>

                    <!-- STOCK -->
                    <td class="px-7 py-5">
                        <span class="inline-block whitespace-nowrap bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                            {{ $product->stock }} pcs
                        </span>
                    </td>

                    <!-- ACTION -->
                    <td class="px-7 py-5">
                        <div class="flex flex-col items-center gap-2">
                            <!-- EDIT -->
                            <a href="/admin/products/{{ $product->id }}/edit"
                            class="bg-[#F8F3EC] hover:bg-[#ECE2D4] text-[#7D5548] px-4 py-2 rounded-xl text-sm font-medium transition w-full text-center">
                                Edit
                            </a>

                            <!-- DELETE -->
                            <form action="/admin/products/{{ $product->id }}"
                                method="POST"
                                onsubmit="return confirm('Hapus produk ini?')"
                                class="w-full">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-xl text-sm font-medium transition w-full">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-16 text-gray-400">

                        Belum ada produk.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
    <!-- PAGINATION -->
    @if ($products->hasPages())

    <div class="flex justify-end px-6 py-6 border-t border-[#F3ECE3]">

        {{ $products->links() }}

    </div>

    @endif
</div>

@endsection