<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Pesanan - MeowMart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #fff8f5;
            font-family: Arial, sans-serif;
            color: #453d3d;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            position: fixed;
            padding: 35px 25px;
            background: linear-gradient(180deg, #ff416c, #ff6534);
            color: white;
        }

        .sidebar h2 {
            font-weight: bold;
            margin-bottom: 45px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 12px;
            border-radius: 12px;
            transition: .3s;
        }

        .sidebar a:hover,
        .sidebar .active {
            background: rgba(255, 255, 255, .2);
            transform: translateX(6px);
        }

        .main {
            margin-left: 250px;
            padding: 45px;
        }

        .main h1 {
            font-weight: bold;
        }

        .order-card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .07);
            animation: muncul .6s ease;
            transition: .3s;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 65, 108, .15);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding-bottom: 18px;
            margin-bottom: 18px;
        }

        .item {
            padding: 10px 0;
            border-bottom: 1px dashed #eee;
        }

        .price {
            color: #ff416c;
            font-weight: bold;
        }

        .total {
            color: #ff416c;
            font-size: 25px;
            font-weight: bold;
        }

        .status-form {
            display: flex;
            gap: 10px;
        }

        .status-form select {
            border-radius: 10px;
        }

        .save-btn {
            border: none;
            background: linear-gradient(90deg, #ff6534, #ff416c);
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: bold;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h2>🐾 MeowMart</h2>

    <a href="{{ route('admin.products.index') }}">
        📦 Kelola Produk
    </a>

    <a href="{{ route('admin.orders.index') }}" class="active">
        🛒 Kelola Pesanan
    </a>

    <a href="{{ route('home') }}">
        🏠 Lihat Toko
    </a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit"
                class="btn text-white w-100 text-start mt-3">
            🚪 Logout
        </button>
    </form>

</div>

<main class="main">

    <h1>Kelola Pesanan 📦</h1>

    <p class="text-muted mb-4">
        Lihat dan perbarui status pesanan pelanggan MeowMart.
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @forelse($orders as $order)

        <div class="order-card">

            <div class="order-header">

                <div>
                    <h4 class="fw-bold">
                        Pesanan #{{ $order->id }}
                    </h4>

                    <span class="text-muted">
                        {{ $order->user->name }}
                        •
                        {{ $order->created_at->format('d M Y H:i') }}
                    </span>
                </div>

                <div class="text-end">

                    <span>Total Pesanan</span>

                    <div class="total">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </div>

                </div>

            </div>

            @foreach($order->items as $item)

                <div class="item">

                    <strong>
                        {{ $item->product->name }}
                    </strong>

                    <span class="text-muted">
                        — {{ $item->quantity }} x
                        Rp {{ number_format($item->price, 0, ',', '.') }}
                    </span>

                    <div class="price">
                        Rp {{ number_format(
                            $item->price * $item->quantity,
                            0,
                            ',',
                            '.'
                        ) }}
                    </div>

                </div>

            @endforeach

            <div class="row mt-4">

                <div class="col-md-6">

                    <strong>Informasi Pengiriman</strong>

                    <p class="mb-1 mt-2">
                        {{ $order->name }}
                    </p>

                    <p class="mb-1">
                        {{ $order->phone }}
                    </p>

                    <p class="text-muted">
                        {{ $order->address }}
                    </p>

                    <p>
                        Pembayaran:
                        <strong>{{ $order->payment_method }}</strong>
                    </p>

                </div>

                <div class="col-md-6">

                    <strong>Status Pesanan</strong>

                    <form
                        action="{{ route('admin.orders.status', $order) }}"
                        method="POST"
                        class="status-form mt-3"
                    >

                        @csrf
                        @method('PATCH')

                        <select name="status"
                                class="form-select">

                            @foreach([
                                'Menunggu Pembayaran',
                                'Diproses',
                                'Dikirim',
                                'Selesai',
                                'Dibatalkan'
                            ] as $status)

                                <option
                                    value="{{ $status }}"
                                    {{ $order->status == $status ? 'selected' : '' }}
                                >
                                    {{ $status }}
                                </option>

                            @endforeach

                        </select>

                        <button type="submit"
                                class="save-btn">
                            Update
                        </button>

                    </form>

                </div>

            </div>

        </div>

    @empty

        <div class="alert alert-light text-center p-5">
            🐱 Belum ada pesanan masuk.
        </div>

    @endforelse

</main>

</body>

</html>