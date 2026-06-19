@extends('layouts.admin')

@section('content')

<div class="space-y-6 mt-10">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Laporan Penjualan
            </h1>

            <p class="text-gray-500 mt-1">
                Ringkasan penjualan dan performa toko
            </p>
        </div>

        <a href="{{ route('admin.reports.pdf') }}"
           class="bg-[#8B5E3C] hover:bg-[#734A2D] text-white px-5 py-3 rounded-xl font-medium shadow">

            Export PDF

        </a>

    </div>

    {{-- FILTER --}}
    <div class="bg-white rounded-2xl shadow-sm p-5">

        <form method="GET" class="grid md:grid-cols-3 gap-4">

            <input type="date"
                   name="start_date"
                   value="{{ request('start_date') }}"
                   class="border rounded-xl px-4 py-3">

            <input type="date"
                   name="end_date"
                   value="{{ request('end_date') }}"
                   class="border rounded-xl px-4 py-3">

            <button class="bg-[#8B5E3C] hover:bg-[#734A2D] text-white rounded-xl">

                Filter Data

            </button>

        </form>

    </div>

    {{-- STATISTIC --}}
    <div class="grid md:grid-cols-2 gap-6">

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500 text-sm">
                Total Pesanan
            </p>

            <h2 class="text-4xl font-bold mt-2 text-[#8B5E3C]">
                {{ $totalOrders }}
            </h2>

        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <p class="text-gray-500 text-sm">
                Total Pendapatan
            </p>

            <h2 class="text-4xl font-bold mt-2 text-green-600">
                Rp {{ number_format($totalRevenue) }}
            </h2>

        </div>

    </div>

    {{-- PRODUK TERLARIS --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <div class="p-5 border-b">
            <h3 class="font-semibold text-lg">
                Produk Terlaris
            </h3>
        </div>

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>
                    <th class="text-left px-6 py-4">
                        Produk
                    </th>

                    <th class="text-left px-6 py-4">
                        Terjual
                    </th>
                </tr>

            </thead>

            <tbody>

                @foreach($bestProducts as $product)

                <tr class="border-t">

                    <td class="px-6 py-4">
                        {{ $product->name }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-[#8B5E3C]">
                        {{ $product->sold }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    {{-- STOK MENIPIS --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <div class="p-5 border-b">
            <h3 class="font-semibold text-lg">
                Stok Hampir Habis
            </h3>
        </div>

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>
                    <th class="text-left px-6 py-4">
                        Produk
                    </th>

                    <th class="text-left px-6 py-4">
                        Stok
                    </th>
                </tr>

            </thead>

            <tbody>

                @foreach($lowStockProducts as $product)

                <tr class="border-t">

                    <td class="px-6 py-4">
                        {{ $product->name }}
                    </td>

                    <td class="px-6 py-4">

                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">

                            {{ $product->stock }}

                        </span>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    {{-- RIWAYAT PESANAN --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

        <div class="p-5 border-b">
            <h3 class="font-semibold text-lg">
                Riwayat Pesanan
            </h3>
        </div>

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-4 text-left">
                        ID
                    </th>

                    <th class="px-6 py-4 text-left">
                        Total
                    </th>

                    <th class="px-6 py-4 text-left">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left">
                        Tanggal
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($orders as $order)

                <tr class="border-t">

                    <td class="px-6 py-4">
                        #{{ $order->id }}
                    </td>

                    <td class="px-6 py-4 font-semibold">
                        Rp {{ number_format($order->total_price) }}
                    </td>

                    <td class="px-6 py-4">

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                            {{ ucfirst($order->status) }}

                        </span>

                    </td>

                    <td class="px-6 py-4 text-gray-500">
                        {{ $order->created_at->format('d M Y') }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection