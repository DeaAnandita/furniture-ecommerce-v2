@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 mt-8">

    <div>

        <p class="uppercase tracking-[3px] text-[10px] sm:text-xs text-[#8B5E3C] mb-2">
            Furniture Admin Panel
        </p>

        <h2 class="text-2xl sm:text-3xl font-bold text-[#2B2B2B] leading-tight">
            Customer Orders
        </h2>

    </div>

    <div class="bg-[#F8F3EC] px-5 py-3 rounded-2xl">

        <p class="text-sm text-gray-500">
            Total Orders
        </p>

        <h3 class="font-bold text-[#7D5548]">
            {{ $orders->total() }} Orders
        </h3>

    </div>

</div>

<!-- SUCCESS -->
@if(session('success'))

<div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl">

    {{ session('success') }}

</div>

@endif

<!-- TABLE -->
<div class="bg-white border border-[#EFE7DC] rounded-[32px] shadow-sm overflow-hidden">

    <!-- TOP -->
    <div class="p-5 md:p-7 border-b border-[#F3ECE3]">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <p class="uppercase tracking-[3px] text-[11px] text-[#8B5E3C] mb-2">
                    Order List
                </p>

                <h2 class="text-xl md:text-2xl font-bold">
                    All Customer Orders
                </h2>

            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="px-5 md:px-7 pb-6 mt-4 border-b border-[#F3ECE3]">

        <form method="GET"
              action="/admin/orders"
              class="flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">

            <!-- SEARCH -->
            <div class="flex-1">

                <div class="relative">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari customer..."
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

                <!-- STATUS -->
                <select name="status"
                        class="bg-[#F8F3EC] border border-[#E8DED1] rounded-2xl text-sm focus:outline-none focus:border-[#8B5E3C]">

                    <option value="">
                        Semua Status
                    </option>

                    <option value="pending"
                        {{ request('status') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="paid"
                        {{ request('status') == 'paid' ? 'selected' : '' }}>
                        Paid
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

    @php

        function sortDirection($column)
        {
            if(request('sort') == $column && request('direction') == 'asc') {

                return 'desc';

            }

            return 'asc';
        }

    @endphp

    <!-- TABLE -->
    <div class="hidden lg:block overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="text-left text-sm text-gray-400 border-b border-[#F3ECE3]">

                    <th class="px-6 py-5">
                        No
                    </th>

                    <!-- CUSTOMER -->
                    <th class="px-6 py-5 font-medium">

                        <a href="?sort=customer&direction={{ sortDirection('customer') }}"
                           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

                            Customer

                            @if(request('sort') == 'customer')

                                {{ request('direction') == 'asc' ? '↑' : '↓' }}

                            @endif

                        </a>

                    </th>

                    <!-- ORDER -->
                    <th class="px-6 py-5 font-medium">

                        Order ID

                    </th>

                    <!-- TOTAL -->
                    <th class="px-6 py-5 font-medium">

                        <a href="?sort=total&direction={{ sortDirection('total') }}"
                           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

                            Total

                            @if(request('sort') == 'total')

                                {{ request('direction') == 'asc' ? '↑' : '↓' }}

                            @endif

                        </a>

                    </th>

                    <!-- STATUS -->
                    <th class="px-6 py-5 font-medium">

                        <a href="?sort=status&direction={{ sortDirection('status') }}"
                           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

                            Payment

                            @if(request('sort') == 'status')

                                {{ request('direction') == 'asc' ? '↑' : '↓' }}

                            @endif

                        </a>

                    </th>

                    <!-- DATE -->
                    <th class="px-6 py-5 font-medium">

                        <a href="?sort=date&direction={{ sortDirection('date') }}"
                           class="flex items-center gap-2 hover:text-[#8B5E3C] transition">

                            Date

                            @if(request('sort') == 'date')

                                {{ request('direction') == 'asc' ? '↑' : '↓' }}

                            @endif

                        </a>

                    </th>

                    <th class="px-6 py-5 text-center">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($orders as $order)

                <tr class="border-b border-[#F8F2EA] hover:bg-[#FCFAF7] transition">

                    <!-- NUMBER -->
                    <td class="px-6 py-5 font-semibold text-gray-500">

                        {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}

                    </td>

                    <!-- CUSTOMER -->
                    <td class="px-6 py-5">

                        <div>

                            <h3 class="font-semibold text-[#2B2B2B]">
                                {{ $order->user->name ?? 'Customer' }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $order->user->email ?? '-' }}
                            </p>

                        </div>

                    </td>

                    <!-- ORDER ID -->
                    <td class="px-6 py-5">

                        <span class="bg-[#F8F3EC] text-[#7D5548] px-4 py-2 rounded-full text-sm font-medium">
                            #ORDER-{{ $order->id }}
                        </span>

                    </td>

                    <!-- TOTAL -->
                    <td class="px-6 py-5">

                        <span class="font-semibold text-[#7D5548]">
                            Rp {{ number_format($order->total_price) }}
                        </span>

                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-5">

                        @if($order->payment_status == 'paid')

                            <span class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                                Paid
                            </span>

                        @else

                            <span class="inline-block bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm">
                                Pending
                            </span>

                        @endif

                    </td>

                    <!-- DATE -->
                    <td class="px-6 py-5 text-gray-500 text-sm">

                        {{ $order->created_at->format('d M Y') }}

                    </td>

                    <!-- ACTION -->
                    <td class="px-6 py-5">

                        <div class="flex justify-center">

                            <a href="/admin/orders/{{ $order->id }}"
                               class="bg-[#8B5E3C] hover:bg-[#6B4636] text-white px-5 py-2 rounded-xl text-sm font-medium transition">

                                Detail

                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="text-center py-16 text-gray-400">

                        Belum ada order.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- MOBILE -->
    <div class="block lg:hidden p-4 space-y-4">

        @forelse($orders as $order)

        <div class="border border-[#EFE7DC] rounded-3xl p-4">

            <div class="flex items-start justify-between gap-4">

                <div>

                    <h3 class="font-bold text-lg">
                        {{ $order->user->name ?? 'Customer' }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $order->user->email ?? '-' }}
                    </p>

                </div>

                @if($order->payment_status == 'paid')

                    <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                        Paid
                    </span>

                @else

                    <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">
                        Pending
                    </span>

                @endif

            </div>

            <div class="mt-4 space-y-2 text-sm">

                <p>
                    <span class="text-gray-500">Order :</span>
                    #ORDER-{{ $order->id }}
                </p>

                <p>
                    <span class="text-gray-500">Total :</span>
                    Rp {{ number_format($order->total_price) }}
                </p>

                <p>
                    <span class="text-gray-500">Date :</span>
                    {{ $order->created_at->format('d M Y') }}
                </p>

            </div>

            <a href="/admin/orders/{{ $order->id }}"
               class="mt-5 block text-center bg-[#8B5E3C] hover:bg-[#6B4636] text-white py-3 rounded-2xl text-sm font-medium transition">

                Detail Order

            </a>

        </div>

        @empty

        <div class="text-center py-12 text-gray-400">

            Belum ada order.

        </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    @if ($orders->hasPages())

    <div class="flex justify-end px-6 py-6 border-t border-[#F3ECE3]">

        {{ $orders->links() }}

    </div>

    @endif

</div>

@endsection