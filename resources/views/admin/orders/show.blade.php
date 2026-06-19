@extends('layouts.admin')

@section('content')

<!-- BACK BUTTON -->
<div class="mt-4 mb-4">

    <a href="/admin/orders"
       class="inline-flex items-center gap-2 bg-[#F8F3EC] hover:bg-[#ECE2D4] text-[#7D5548] px-5 py-3 rounded-2xl font-medium transition">

        ← Kembali ke Orders

    </a>

</div>

<!-- WRAPPER -->
<div class="bg-white border border-[#EFE7DC] rounded-[24px] md:rounded-[32px] shadow-sm overflow-hidden">

    <!-- HEADER -->
    <div class="p-4 md:p-8 border-b border-[#F3ECE3]">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <!-- LEFT -->
            <div>

                <p class="uppercase tracking-[3px] text-[11px] text-[#8B5E3C] mb-2">
                    Order Detail
                </p>

                <h1 class="text-xl md:text-3xl font-bold text-[#2B2B2B]">
                    #ORDER-{{ $order->id }}
                </h1>

                <p class="text-gray-500 mt-2">
                    {{ $order->created_at->format('d M Y • H:i') }}
                </p>

            </div>

            <!-- STATUS -->
            <div>

                @if($order->payment_status == 'paid')

                    <span class="bg-green-100 text-green-700 px-4 py-2 md:px-5 md:py-3 rounded-xl md:rounded-2xl text-sm font-medium">
                        Paid
                    </span>

                @else

                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 md:px-5 md:py-3 rounded-xl md:rounded-2xl text-sm font-medium">
                        Pending
                    </span>

                @endif

            </div>

        </div>

    </div>

    <!-- CUSTOMER -->
    <div class="p-4 md:p-8 border-b border-[#F3ECE3]">

        <div class="grid grid-cols-3 gap-2 md:gap-6">

            <!-- CUSTOMER -->
            <div class="bg-[#F8F3EC] rounded-2xl md:rounded-3xl p-3 md:p-5 min-w-0">

                <p class="text-[10px] md:text-sm text-gray-500 mb-1">
                    Customer
                </p>

                <h3 class="font-bold text-xs md:text-lg text-[#2B2B2B] truncate">
                    {{ $order->user->name }}
                </h3>

                <p class="text-[10px] md:text-sm text-gray-500 mt-1 truncate">
                    {{ $order->user->email }}
                </p>

            </div>

            <!-- TOTAL -->
            <div class="bg-[#F8F3EC] rounded-2xl md:rounded-3xl p-3 md:p-5">

                <p class="text-[10px] md:text-sm text-gray-500 mb-1">
                    Total
                </p>

                <h3 class="font-bold text-xs md:text-2xl text-[#7D5548] break-words">
                    Rp {{ number_format($order->total_price) }}
                </h3>

            </div>

            <!-- ITEMS -->
            <div class="bg-[#F8F3EC] rounded-2xl md:rounded-3xl p-3 md:p-5">

                <p class="text-[10px] md:text-sm text-gray-500 mb-1">
                    Items
                </p>

                <h3 class="font-bold text-xs md:text-2xl text-[#2B2B2B]">
                    {{ $order->items->count() }}
                </h3>

            </div>

        </div>

    </div>

    <!-- PRODUCT LIST -->
    <div class="p-6 md:p-8">

        <div class="flex items-center justify-between mb-6">

            <div>

                <p class="uppercase tracking-[3px] text-[11px] text-[#8B5E3C] mb-2">
                    Order Items
                </p>

                <h2 class="text-xl md:text-2xl font-bold">
                    Purchased Products
                </h2>

            </div>

        </div>

        <!-- ITEMS -->
        <div class="space-y-3 md:space-y-5">

            @foreach($order->items as $item)

            <div class="border border-[#EFE7DC] rounded-2xl md:rounded-[28px] p-3 md:p-5 hover:bg-[#FCFAF7] transition">

                <div class="flex items-center gap-3 md:gap-5">

                    <!-- IMAGE -->
                    <img src="{{ asset('produk/' . $item->product->image) }}"
                        class="w-20 h-20 md:w-28 md:h-28 object-cover rounded-xl md:rounded-2xl flex-shrink-0">

                    <!-- CONTENT -->
                    <div class="flex-1 min-w-0">

                        <h3 class="font-bold text-sm md:text-lg text-[#2B2B2B] line-clamp-1">
                            {{ $item->product->name }}
                        </h3>

                        <p class="text-xs md:text-sm text-gray-500 mt-1 line-clamp-1">
                            {{ $item->product->description }}
                        </p>

                        <div class="flex flex-wrap items-center gap-2 mt-3">

                            <span class="bg-[#F8F3EC] text-[#7D5548] px-3 py-1 rounded-full text-[10px] md:text-sm">
                                Qty : {{ $item->quantity }}
                            </span>

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] md:text-sm">
                                Rp {{ number_format($item->price) }}
                            </span>

                        </div>

                    </div>

                    <!-- SUBTOTAL -->
                    <div class="text-right flex-shrink-0">

                        <p class="text-[10px] md:text-sm text-gray-500 mb-1">
                            Subtotal
                        </p>

                        <h3 class="text-sm md:text-xl font-bold text-[#7D5548] whitespace-nowrap">
                            Rp {{ number_format($item->price * $item->quantity) }}
                        </h3>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

@endsection