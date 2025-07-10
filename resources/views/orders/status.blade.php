<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3">
    <title>Kenangan Senja</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    @vite(['resources/css/homelogin.css', 'resources/css/app.css'])
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #111827 20%, #3b3b3b 100%);
            color:rgb(0, 3, 9);
        }

        .order-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }

        .order-box {
            background-color: #2d3748;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            flex-basis: calc(33.333% - 20px);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            background: linear-gradient(135deg, #1a202c, #2d3748);
        }

        .order-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
        }

        .order-box p {
            margin-bottom: 12px;
            font-size: 1.125rem;
        }

        .order-id, .order-status, .order-price {
            display: inline-block;
            background-color: #4A5568;
            padding: 8px 15px;
            border-radius: 12px;
            margin-right: 12px;
            font-weight: bold;
        }

        .order-id {
            color: #F59E0B;
        }

        .order-status {
            color: #38B2AC;
        }

        .order-price {
            color: #F59E0B;
        }

        .btn-detail {
            background-color: #F59E0B;
            color: #1F2937;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
            display: inline-block;
            margin-top: 18px;
        }

        .btn-detail:hover {
            background-color: #FBBF24;
            transform: scale(1.05);
        }

        .title-text {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            color: #FBBF24;
            margin-bottom: 40px;
        }

        /* Footer Styles */
        footer {
            background-color: #2D3748;
            color: #E2E8F0;
            padding: 30px 0;
        }

        footer a {
            text-decoration: none;
            color: #E2E8F0;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #FBBF24;
        }

        footer .social-icons i {
            margin: 0 15px;
            font-size: 1.5rem;
            color:rgb(39, 122, 230);
        }

        footer .social-icons i:hover {
            color: #FBBF24;
        }
    </style>
</head>
<body class="font-poppins">

<x-navbar />

    <!-- Content -->
    <div class="container mx-auto p-8 w-full bg-gradient-to-r mt-20 rounded-xl">
        <h1 class="title-text">Status Pesanan</h1>

        <!-- Order Container -->
        <div class="order-container">
            @foreach($orders as $order)
            <div class="order-box">
                <p class="text-gray-300">Order ID: <span class="font-semibold text-yellow-400">{{ $order->order_id }}</span></p>
                <p class="text-gray-300">Status: <span class="font-semibold text-yellow-400">{{ $order->status }}</span></p>
                <p class="text-gray-300">Total Harga: <span class="font-semibold text-yellow-400">{{ number_format($order->total_price, 2, ',', '.') }} IDR</span></p>

                <a href="{{ route('orders.detail', $order->order_id) }}" class="btn-detail">
                    Lihat Detail Pesanan
                </a>
            </div>
            @endforeach
        </div>

        <!-- No Orders Message -->
        @if($orders->isEmpty())
        <div class="text-center text-gray-300">
            <p class="text-xl font-semibold">Anda belum memiliki pesanan.</p>
        </div>
        @endif
    </div>
<div class="main-content">

</div>
    <!-- Footer -->
    <x-footer />

    <!-- SweetAlert Notifications -->
    @if (session('completedStatus'))
    <script>
        Swal.fire({
            title: 'Pesanan Selesai!',
            text: "{{ session('completedStatus') }}",
            icon: 'success',
            background: '#1A1A1A',
            color: '#fff',
            confirmButtonColor: '#FFC107',
            timer: 3000,  // Tampilkan selama 3 detik
            showConfirmButton: true
        });
    </script>
    @endif

    @if (session('success'))
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            background: '#1A1A1A',
            color: '#fff',
            confirmButtonColor: '#FFC107',
            timer: 3000,  // Tampilkan selama 3 detik
            showConfirmButton: true
        });
    </script>
    @endif
</body>
</html>
