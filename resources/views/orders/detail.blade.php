<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenangan Senja</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    @vite(['resources/css/homelogins.css', 'resources/css/app.css'])
    
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #1F1F1F;
            color: #fff;
        }

        h2, h3 {
            font-weight: 700;
            color: #FFB800;
        }

        .order-details {
            background: #2D2D2D;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        .order-details p {
            font-size: 1.1rem;
            margin: 10px 0;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #444;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #FFB800;
        }

        tr:hover {
            background-color: #444;
        }

        .btn-view-details {
            background-color: #FFB800;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-view-details:hover {
            background-color: #FFA500;
        }

        .btn-buy-now {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-buy-now:hover {
            background-color: #218838;
        }
    </style>

</head>
<body>
    <x-navbar />

    <div class="container mx-auto p-8 mt-24">
        <div class="order-details">
            <h2>Detail Pesanan {{ $order->order_id }}</h2>
            <p>Status: <span class="font-semibold text-yellow-500">{{ $order->status }}</span></p>
            <p>Total Harga: <span class="font-semibold text-yellow-500">{{ number_format($order->total_price, 2, ',', '.') }} IDR</span></p>
            
            <h3>Rincian Produk:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ number_format($detail->product->price, 2, ',', '.') }} IDR</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->subtotal, 2, ',', '.') }} IDR</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($order->promotion_id)
                <p>Promo yang digunakan: <span class="font-semibold text-yellow-500">{{ $order->promotion->name }}</span></p>
            @endif
<!-- 
            @if($order->status === 'Pending')
                <form action="#" method="GET">
                    <button type="submit" class="btn-buy-now">Beli Sekarang</button>
                </form>
            @endif -->

            <a href="{{ route('orders.status') }}" class="btn-view-details">Kembali ke Pesanan</a>
        </div>
    </div>

    <x-footer />
</body>
</html>
