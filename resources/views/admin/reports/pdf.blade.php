<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Laporan Penjualan</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color:#333;
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .header h2{
            margin:0;
            color:#5D4037;
        }

        .header p{
            margin:3px 0;
            color:#666;
        }

        .summary{
            width:100%;
            margin-bottom:20px;
        }

        .summary td{
            width:50%;
            padding:10px;
            border:1px solid #ddd;
        }

        .summary-title{
            font-size:11px;
            color:#666;
        }

        .summary-value{
            font-size:18px;
            font-weight:bold;
            color:#5D4037;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
            margin-bottom:20px;
        }

        th{
            background:#5D4037;
            color:white;
            padding:8px;
            border:1px solid #ddd;
        }

        td{
            border:1px solid #ddd;
            padding:8px;
        }

        h3{
            margin-top:25px;
            margin-bottom:10px;
            color:#5D4037;
        }

        .footer{
            margin-top:30px;
            text-align:right;
        }

    </style>

</head>
<body>

<div class="header">

    <h2>LAPORAN PENJUALAN</h2>

    <p>Budi Alumunium</p>

    <p>
        Dicetak :
        {{ now()->format('d F Y H:i') }}
    </p>

</div>

<table class="summary">

    <tr>

        <td>
            <div class="summary-title">
                Total Pesanan
            </div>

            <div class="summary-value">
                {{ $totalOrders }}
            </div>
        </td>

        <td>
            <div class="summary-title">
                Total Pendapatan
            </div>

            <div class="summary-value">
                Rp {{ number_format($totalRevenue) }}
            </div>
        </td>

    </tr>

</table>

<h3>Riwayat Transaksi</h3>

<table>

    <thead>

        <tr>
            <th>No</th>
            <th>ID Order</th>
            <th>Total</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>

    </thead>

    <tbody>

        @foreach($orders as $order)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>#{{ $order->id }}</td>

            <td>
                Rp {{ number_format($order->total_price) }}
            </td>

            <td>
                {{ ucfirst($order->status) }}
            </td>

            <td>
                {{ $order->created_at->format('d-m-Y') }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<h3>Produk Terlaris</h3>

<table>

    <thead>

        <tr>
            <th>Produk</th>
            <th>Jumlah Terjual</th>
        </tr>

    </thead>

    <tbody>

        @foreach($bestProducts as $product)

        <tr>

            <td>{{ $product->name }}</td>

            <td>{{ $product->sold }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

<h3>Produk Dengan Stok Menipis</h3>

<table>

    <thead>

        <tr>
            <th>Produk</th>
            <th>Sisa Stok</th>
        </tr>

    </thead>

    <tbody>

        @foreach($lowStockProducts as $product)

        <tr>

            <td>{{ $product->name }}</td>

            <td>{{ $product->stock }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

<div class="footer">

    <p>
        Mengetahui,
    </p>

    <br><br><br>

    <p>
        _______________________
    </p>

</div>

</body>
</html>