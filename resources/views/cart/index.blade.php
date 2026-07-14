<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Keranjang - MeowMart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fff8f4, #ffe9ee);
            color: #453d3d;
            min-height: 100vh;
        }

        .navbar {
            background: white;
            padding: 18px 8%;
            box-shadow: 0 3px 15px rgba(0,0,0,.08);
        }

        .logo {
            color: #ff416c;
            font-size: 25px;
            font-weight: bold;
            text-decoration: none;
        }

        .container-cart {
            width: 85%;
            margin: 50px auto;
            animation: muncul .7s ease;
        }

        .title {
            margin-bottom: 35px;
        }

        .title h1 {
            font-weight: bold;
        }

        .cart-item {
            background: white;
            padding: 22px;
            margin-bottom: 18px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,.07);
            transition: .35s;
        }

        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255,65,108,.15);
        }

        .product-image {
            width: 130px;
            height: 130px;
            background: #fff0eb;
            border-radius: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 60px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info {
            flex: 1;
        }

        .info h3 {
            font-weight: bold;
        }

        .category {
            color: #888;
        }

        .price {
            color: #ff416c;
            font-size: 21px;
            font-weight: bold;
        }

        .quantity {
            background: #fff0eb;
            display: inline-block;
            padding: 8px 15px;
            border-radius: 10px;
        }

        .delete-btn {
            border: none;
            background: #ff416c;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: bold;
            transition: .3s;
        }

        .delete-btn:hover {
            transform: scale(1.05);
        }

        .summary {
            background: white;
            padding: 30px;
            border-radius: 20px;
            margin-top: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,.07);
        }

        .total {
            color: #ff416c;
            font-size: 28px;
            font-weight: bold;
        }

        .checkout-btn {
            display: inline-block;
            background: linear-gradient(90deg, #ff6534, #ff416c);
            color: white;
            padding: 13px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
            transition: .3s;
        }

        .checkout-btn:hover {
            color: white;
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(255,65,108,.3);
        }

        .back {
            color: #ff416c;
            text-decoration: none;
            font-weight: bold;
        }

        .empty-cart {
            background: white;
            text-align: center;
            padding: 60px;
            border-radius: 20px;
            font-size: 20px;
        }

        @keyframes muncul {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

<nav class="navbar">

    <a href="{{ route('home') }}" class="logo">
        🐾 MeowMart
    </a>

</nav>


<div class="container-cart">

    <div class="title">

        <h1>Keranjang Belanja 🛒</h1>

        <p class="text-muted">
            Produk pilihan untuk si meong kesayanganmu.
        </p>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @php
        $total = 0;
    @endphp


    @forelse($carts as $cart)

        @php
            $subtotal = $cart->product->price * $cart->quantity;
            $total += $subtotal;
        @endphp


        <div class="cart-item">

            <div class="product-image">

                @if($cart->product->image)

                    <img
                        src="{{ asset('storage/' . $cart->product->image) }}"
                        alt="{{ $cart->product->name }}"
                    >

                @elseif($cart->product->category == 'Makanan Kucing')

                    🥫

                @elseif($cart->product->category == 'Mainan Kucing')

                    🧶

                @else

                    🏠

                @endif

            </div>


            <div class="info">

                <h3>
                    {{ $cart->product->name }}
                </h3>

                <p class="category">
                    {{ $cart->product->category }}
                </p>

                <p class="price">
                    Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                </p>

               <div class="d-flex align-items-center gap-2">

    <form action="{{ route('cart.decrease', $cart) }}" method="POST">
        @csrf
        @method('PATCH')

        <button class="btn btn-outline-danger">
            −
        </button>
    </form>

    <div class="quantity">
        <strong>{{ $cart->quantity }}</strong>
    </div>

    <form action="{{ route('cart.increase', $cart) }}" method="POST">
        @csrf
        @method('PATCH')

        <button class="btn btn-outline-danger">
            +
        </button>
    </form>

</div>

                <p class="mt-3 mb-0">

                    Subtotal:

                    <strong>
                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </strong>

                </p>

            </div>


            <form
                action="{{ route('cart.destroy', $cart) }}"
                method="POST"
                onsubmit="return confirm('Hapus produk dari keranjang?')"
            >

                @csrf
                @method('DELETE')

                <button type="submit" class="delete-btn">
                    Hapus
                </button>

            </form>

        </div>


    @empty

        <div class="empty-cart">

            🐱 Keranjang masih kosong.

            <br><br>

            <a href="{{ route('home') }}" class="back">
                Mulai Belanja
            </a>

        </div>

    @endforelse


    @if($carts->count() > 0)

        <div class="summary">

            <h3>Total Belanja</h3>

            <div class="total">

                Rp {{ number_format($total, 0, ',', '.') }}

            </div>

           <a href="{{ route('checkout.index') }}" class="checkout-btn">
    Lanjut Checkout 🐾
</a>

        </div>

    @endif


    <br>

    <a href="{{ route('home') }}" class="back">
        ← Kembali ke Beranda
    </a>

</div>

</body>

</html>