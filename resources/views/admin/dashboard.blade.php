@extends('layouts.admin')

@section('content')

<!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 mt-8">

            <!-- LEFT -->
            <div>

                <p class="uppercase tracking-[3px] text-[10px] sm:text-xs text-[#8B5E3C] mb-2">
                    Furniture Admin Panel
                </p>

                <h2 class="text-2xl sm:text-3xl font-bold text-[#2B2B2B] leading-tight">
                    Store Management
                </h2>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center">

                <div class="bg-white px-4 sm:px-5 py-3 rounded-2xl border border-[#E7DED3] shadow-sm flex items-center gap-3 sm:gap-4">

                    <p class="text-[11px] text-gray-500 whitespace-nowrap">
                        Today
                    </p>

                    <div class="w-px h-5 bg-[#E7DED3]"></div>

                    <h3 class="font-semibold text-[#7D5548] text-sm whitespace-nowrap">
                        {{ now()->format('d F Y') }}
                    </h3>

                </div>

            </div>

        </div>

<!-- STATISTIC CARD -->
<div class="grid grid-cols-2 xl:grid-cols-4 gap-3 md:gap-5 mb-7 md:mb-10">

    <!-- CARD -->
    <div class="relative overflow-hidden bg-white rounded-[24px] md:rounded-[30px] p-4 md:p-6 border border-[#EFE7DC] shadow-sm">

        <div class="absolute top-0 right-0 w-20 h-20 md:w-28 md:h-28 bg-[#F8F3EC] rounded-full -mr-8 -mt-8 md:-mr-10 md:-mt-10"></div>

        <div class="relative z-10">

            <div class="w-11 h-11 md:w-14 md:h-14 rounded-2xl bg-[#F5EFE6] flex items-center justify-center mb-4 md:mb-5 text-lg md:text-2xl">
                📦
            </div>

            <p class="text-[11px] md:text-sm text-gray-500 mb-2">
                Products
            </p>

            <h2 class="text-2xl md:text-4xl font-bold text-[#2B2B2B]">
                {{ $totalProducts }}
            </h2>

            <p class="text-[#8B5E3C] text-[10px] md:text-sm mt-2 md:mt-3">
                Available items
            </p>

        </div>

    </div>

    <!-- CARD -->
    <div class="relative overflow-hidden bg-white rounded-[24px] md:rounded-[30px] p-4 md:p-6 border border-[#EFE7DC] shadow-sm">

        <div class="absolute top-0 right-0 w-20 h-20 md:w-28 md:h-28 bg-[#F8F3EC] rounded-full -mr-8 -mt-8 md:-mr-10 md:-mt-10"></div>

        <div class="relative z-10">

            <div class="w-11 h-11 md:w-14 md:h-14 rounded-2xl bg-[#F5EFE6] flex items-center justify-center mb-4 md:mb-5 text-lg md:text-2xl">
                🛒
            </div>

            <p class="text-[11px] md:text-sm text-gray-500 mb-2">
                Orders
            </p>

            <h2 class="text-2xl md:text-4xl font-bold text-[#2B2B2B]">
                {{ $totalOrders }}
            </h2>

            <p class="text-[#8B5E3C] text-[10px] md:text-sm mt-2 md:mt-3">
                Total transactions
            </p>

        </div>

    </div>

    <!-- CARD -->
    <div class="relative overflow-hidden bg-white rounded-[24px] md:rounded-[30px] p-4 md:p-6 border border-[#EFE7DC] shadow-sm">

        <div class="absolute top-0 right-0 w-20 h-20 md:w-28 md:h-28 bg-[#F8F3EC] rounded-full -mr-8 -mt-8 md:-mr-10 md:-mt-10"></div>

        <div class="relative z-10">

            <div class="w-11 h-11 md:w-14 md:h-14 rounded-2xl bg-[#F5EFE6] flex items-center justify-center mb-4 md:mb-5 text-lg md:text-2xl">
                💰
            </div>

            <p class="text-[11px] md:text-sm text-gray-500 mb-2">
                Revenue
            </p>

            <h2 class="text-lg md:text-4xl font-bold text-[#2B2B2B] leading-tight break-words">
                Rp {{ number_format($totalRevenue) }}
            </h2>

            <p class="text-[#8B5E3C] text-[10px] md:text-sm mt-2 md:mt-3">
                Successful payments
            </p>

        </div>

    </div>

    <!-- CARD -->
    <div class="relative overflow-hidden bg-white rounded-[24px] md:rounded-[30px] p-4 md:p-6 border border-[#EFE7DC] shadow-sm">

        <div class="absolute top-0 right-0 w-20 h-20 md:w-28 md:h-28 bg-[#F8F3EC] rounded-full -mr-8 -mt-8 md:-mr-10 md:-mt-10"></div>

        <div class="relative z-10">

            <div class="w-11 h-11 md:w-14 md:h-14 rounded-2xl bg-[#F5EFE6] flex items-center justify-center mb-4 md:mb-5 text-lg md:text-2xl">
                ⏳
            </div>

            <p class="text-[11px] md:text-sm text-gray-500 mb-2">
                Pending
            </p>

            <h2 class="text-2xl md:text-4xl font-bold text-[#2B2B2B]">
                {{ $pendingOrders }}
            </h2>

            <p class="text-[#8B5E3C] text-[10px] md:text-sm mt-2 md:mt-3">
                Waiting confirmation
            </p>

        </div>

    </div>

</div>

<!-- RECENT ORDER -->
<div class="bg-white rounded-[28px] md:rounded-[32px] border border-[#EFE7DC] shadow-sm p-4 md:p-7">

    <!-- TOP -->
    <div class="flex items-center justify-between gap-4 mb-6 md:mb-8">

        <div>

            <p class="uppercase tracking-[3px] text-[10px] md:text-[11px] text-[#8B5E3C] mb-2">
                Latest Activity
            </p>

            <h2 class="text-xl md:text-3xl font-bold">
                Recent Orders
            </h2>

        </div>

        <a href="/admin/orders"
           class="text-xs md:text-sm text-[#8B5E3C] font-medium hover:underline whitespace-nowrap">

            View All

        </a>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full min-w-[620px]">

            <thead>

                <tr class="text-left text-xs md:text-sm text-gray-400 border-b border-[#F1E7DB]">

                    <th class="pb-4 font-medium">
                        Customer
                    </th>

                    <th class="pb-4 font-medium">
                        Order ID
                    </th>

                    <th class="pb-4 font-medium">
                        Payment
                    </th>

                    <th class="pb-4 font-medium">
                        Total
                    </th>

                </tr>

            </thead>

            <tbody class="text-xs md:text-sm">

                @forelse($recentOrders as $order)

                <tr class="border-b border-[#F8F2EA]">

                    <td class="py-4 md:py-5 font-medium whitespace-nowrap">
                        {{ $order->user->name ?? 'Customer' }}
                    </td>

                    <td class="py-4 md:py-5 text-gray-500 whitespace-nowrap">
                        #ORDER-{{ $order->id }}
                    </td>

                    <td class="py-4 md:py-5 whitespace-nowrap">

                        @if($order->payment_status == 'paid')

                            <span class="bg-green-100 text-green-700 text-[10px] md:text-xs px-3 md:px-4 py-1.5 md:py-2 rounded-full">
                                Paid
                            </span>

                        @else

                            <span class="bg-yellow-100 text-yellow-700 text-[10px] md:text-xs px-3 md:px-4 py-1.5 md:py-2 rounded-full">
                                Pending
                            </span>

                        @endif

                    </td>

                    <td class="py-4 md:py-5 font-semibold text-[#7D5548] whitespace-nowrap">
                        Rp {{ number_format($order->total_price) }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4"
                        class="py-10 text-center text-gray-400 text-sm">

                        Belum ada order.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection