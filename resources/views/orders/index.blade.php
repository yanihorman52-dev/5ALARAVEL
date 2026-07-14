<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pesanan Saya - MeowMart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fff7f2, #ffe8ed);
            color: #453d3d;
        }

        .page {
            width: 85%;
            margin: auto;
            padding: 55px 0;
            animation: muncul .7s ease;
        }

        h1 {
            font-weight: bold;
        }

        .order-card {
            background: white;
            border-radius: 22px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,.08);
            transition: .35s;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255,65,108,.15);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 18px;
            margin-bottom: 18px;
        }

        .status {
            background: #fff0eb;
            color: #ff416c;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
        }

        .item {
            padding: 12px 0;
            border-bottom: 1px dashed #eee;
        }

        .price {
            color: #ff416c;
            font-weight: bold;
        }

        .total {
            font-size: 25px;
            color: #ff416c;
            font-weight: bold;
        }

        .back {
            color: #ff416c;
            text-decoration: none;
            font-weight: bold;
        }

        .empty {
            background: white;
            padding: 60px;
            border-radius: 22px;
            text-align: center;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

<div class="page">

    <h1>Pesanan Saya 📦</h1>

    <p class="text-muted mb-4">
        Lihat riwayat pesanan kebutuhan si meong.
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @forelse($orders as $order)

        <div class="order-card">

            <div class="order-header">

                <div>
                    <h4 class="fw-bold mb-1">
                        Pesanan #{{ $order->id }}
                    </h4>

                    <small class="text-muted">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </small>
                </div>

                <span class="status">
                    {{ $order->status }}
                </span>

            </div>

            @foreach($order->items as $item)

                <div class="item">

                    <strong>
                        {{ $item->product->name }}
                    </strong>

                    <div class="text-muted">
                        {{ $item->quantity }} x
                        Rp {{ number_format($item->price, 0, ',', '.') }}
                    </div>

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

                <div class="col-md-7">

                    <strong>Pengiriman</strong>
                    <p class="mb-1">
                        {{ $order->name }} — {{ $order->phone }}
                    </p>

                    <p class="text-muted">
                        {{ $order->address }}
                    </p>

                    <p>
                        Pembayaran:
                        <strong>{{ $order->payment_method }}</strong>
                    </p>

                </div>

                <div class="col-md-5 text-md-end">

                    <span>Total Pesanan</span>

                    <div class="total">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="empty">
            🐱 Belum ada riwayat pesanan.
        </div>

    @endforelse

    <a href="{{ route('home') }}" class="back">
        ← Kembali ke Beranda
    </a>

</div>

</body>

</html>