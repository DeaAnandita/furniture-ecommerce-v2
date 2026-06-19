@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-[#e6ebf5] ">

    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="mb-10">

            <p class="uppercase tracking-[4px] text-[11px] md:text-sm text-[#182d5c] mb-3">
                Checkout
            </p>

            <h1 class="text-3xl md:text-4xl font-bold text-[#2B2B2B]">
                Payment Details
            </h1>

        </div>

        <div class="grid lg:grid-cols-3 gap-6">

            <!-- LEFT -->
            <div class="lg:col-span-2">

                <div class="bg-white rounded-[32px] border border-[#d1d5e8] p-6 md:p-8 shadow-sm">

                    <div class="flex items-center justify-between mb-8">

                        <div>

                            <p class="text-sm text-gray-500 mb-1">
                                Order ID
                            </p>

                            <h2 class="text-2xl font-bold text-[#2B2B2B]">
                                #{{ $order->id }}
                            </h2>

                        </div>

                        <div class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                            Pending Payment
                        </div>

                    </div>

                    <div class="space-y-5">

                        <div class="flex justify-between items-center pb-5 border-b border-[#dce0ef]">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Customer
                                </p>

                                <h3 class="font-semibold text-lg">
                                    {{ auth()->user()->name }}
                                </h3>

                            </div>

                            <div class="text-right">

                                <p class="text-sm text-gray-500">
                                    Email
                                </p>

                                <h3 class="font-medium">
                                    {{ auth()->user()->email }}
                                </h3>

                            </div>

                        </div>

                        <div class="flex justify-between items-center">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Payment Method
                                </p>

                                <h3 class="font-semibold">
                                    Midtrans Payment Gateway
                                </h3>

                            </div>

                            <div class="text-right">

                                <p class="text-sm text-gray-500">
                                    Status
                                </p>

                                <h3 class="font-semibold text-yellow-600">
                                    Waiting Payment
                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div>

                <div class="bg-white rounded-[32px] border border-[#E8DED1] p-6 shadow-sm sticky top-28">

                    <h2 class="text-2xl font-bold mb-6 text-[#2B2B2B]">
                        Order Summary
                    </h2>

                    <div class="space-y-4 mb-6">

                        <div class="flex justify-between">

                            <span class="text-gray-500">
                                Total Payment
                            </span>

                            <span class="font-semibold">
                                Rp {{ number_format($order->total_price) }}
                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-gray-500">
                                Shipping
                            </span>

                            <span class="font-semibold">
                                Free
                            </span>

                        </div>

                    </div>

                    <div class="border-t border-[#EFE7DC] pt-5 mb-6">

                        <div class="flex justify-between items-center">

                            <span class="text-lg font-semibold">
                                Grand Total
                            </span>

                            <span class="text-2xl font-bold text-[#182d5c]">

                                Rp {{ number_format($order->total_price) }}

                            </span>

                        </div>

                    </div>

                    <button id="pay-button"
                            class="w-full bg-[#182d5c] hover:bg-[#445389] transition text-white py-4 rounded-2xl font-medium text-lg">

                        Bayar Sekarang

                    </button>

                    <p class="text-xs text-center text-gray-400 mt-4 leading-relaxed">
                        Pembayaran aman diproses menggunakan Midtrans Payment Gateway
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.clientKey') }}">
</script>

<script>

const payButton = document.getElementById('pay-button');

payButton.addEventListener('click', async function () {

    try {

        payButton.disabled = true;

        payButton.innerText = 'Memproses...';

        const response = await fetch('/payment/{{ $order->id }}', {

            method: 'POST',

            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'

            }

        });

        const data = await response.json();

        console.log(data);

        if (!data.snap_token) {

            alert(data.error || 'Snap token gagal dibuat');
            console.log(data);

            payButton.disabled = false;
            payButton.innerText = 'Bayar Sekarang';

            return;
        }

        snap.pay(data.snap_token, {

            onSuccess: function(result){

                alert("Pembayaran berhasil!");

                window.location.href = "/orders";

            },

            onPending: function(result){

                alert("Menunggu pembayaran");

                window.location.href = "/orders";

            },

            onError: function(result){

                console.log(result);

                alert("Pembayaran gagal");

                payButton.disabled = false;
                payButton.innerText = 'Bayar Sekarang';

            },

            onClose: function(){

                payButton.disabled = false;
                payButton.innerText = 'Bayar Sekarang';

            }

        });

    } catch (error) {

        console.log(error);

        alert('Terjadi kesalahan');

        payButton.disabled = false;
        payButton.innerText = 'Bayar Sekarang';

    }

});

</script>

@endsection