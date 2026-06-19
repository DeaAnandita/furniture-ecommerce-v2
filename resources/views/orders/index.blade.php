@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Laporan Penjualan</h2>

<table class="w-full bg-white shadow rounded">
<tr>
    <th>ID</th>
    <th>User</th>
    <th>Total</th>
    <th>Status</th>
    <th>Tanggal</th>
</tr>

@php $totalSemua = 0; @endphp

@foreach($orders as $order)
<tr class="text-center border-t">
    <td>{{ $order->id }}</td>
    <td>{{ $order->user->name }}</td>
    <td>Rp {{ number_format($order->total_price) }}</td>
    <td>{{ $order->status }}</td>
    <td>{{ $order->created_at }}</td>
</tr>

@php $totalSemua += $order->total_price; @endphp
@endforeach

</table>

<h3 class="mt-4 font-bold">
    Total Penjualan: Rp {{ number_format($totalSemua) }}
</h3>

<button onclick="window.print()"
    class="bg-blue-500 text-white px-4 py-2 mt-3 rounded">
    Print
</button>

@endsection