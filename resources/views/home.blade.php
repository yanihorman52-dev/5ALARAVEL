<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>MeowMart - Pet Shop Kucing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fffaf7;
            color: #4a4141;
        }

        .navbar {
            background: rgba(255,255,255,0.95);
            padding: 18px 8%;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            color: #ff416c;
        }

        .nav-link {
            color: #555;
            font-weight: 600;
            margin-left: 15px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #ff416c;
            transform: translateY(-2px);
        }

        .hero {
            min-height: 480px;
            display: flex;
            align-items: center;
            background: linear-gradient(
                135deg,
                #fff4ee,
                #ffe5ec
            );
            padding: 70px 8%;
            overflow: hidden;
        }

        .hero h1 {
            font-size: 55px;
            font-weight: bold;
            line-height: 1.2;
            animation: slideMasuk 0.8s ease;
        }

        .hero h1 span {
            color: #ff416c;
        }

        .hero p {
            color: #777;
            font-size: 17px;
            max-width: 550px;
            margin: 20px 0;
        }

        .shop-btn {
            display: inline-block;
            text-decoration: none;
            border: none;
            background: linear-gradient(
                90deg,
                #ff6534,
                #ff416c
            );
            color: white;
            padding: 14px 28px;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s;
        }

        .shop-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px
            rgba(255,65,108,0.3);
            color: white;
        }

        .cat-icon {
            font-size: 160px;
            text-align: center;
            animation: floating 3s
            ease-in-out infinite;
        }

        .products {
            padding: 70px 8%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 45px;
        }

        .section-title h2 {
            font-weight: bold;
            font-size: 35px;
        }

        .section-title p {
            color: #888;
        }

        .product-card {
            height: 100%;
            background: white;
            padding: 20px;
            border-radius: 22px;
            box-shadow: 0 8px 25px
            rgba(0,0,0,0.08);
            transition: 0.35s;
            animation: muncul 0.7s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 18px 35px
            rgba(255,65,108,0.18);
        }

        .product-image {
            height: 210px;
            border-radius: 18px;
            background: linear-gradient(
                135deg,
                #fff3e8,
                #ffe5ec
            );
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 90px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.4s;
        }

        .product-card:hover
        .product-image img {
            transform: scale(1.08);
        }

        .category {
            color: #ff416c;
            font-size: 12px;
            font-weight: bold;
        }

        .product-card h3 {
        font-size: 21px;
            font-weight: bold;
            margin-top: 8px;
        }

        .description {
            color: #777;
            min-height: 72px;
        }

        .price {
            color: #ff416c;
            font-size: 23px;
            font-weight: bold;
        }

        .stock {
            color: #666;
        }

        .cart-btn {
            width: 100%;
            border: none;
            padding: 13px;
            border-radius: 12px;
            color: white;
            font-weight: bold;
            background: linear-gradient(
                90deg,
                #ff6534,
                #ff416c
            );
            transition: 0.3s;
        }

        .cart-btn:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 18px
            rgba(255,65,108,0.25);
        }

        .cart-btn:active {
            transform: scale(0.97);
        }

        footer {
            background: #3d3535;
            color: white;
            text-align: center;
            padding: 25px;
            margin-top: 40px;
        }

        @keyframes floating {

            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }

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

        @keyframes slideMasuk {

            from {
                opacity: 0;
                transform: translateX(-40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }

        }

    </style>

</head>

<body>


<nav class="navbar navbar-expand-lg">

    <div class="container-fluid">

        <span class="logo">

            🐾 MeowMart

        </span>


        <div class="ms-auto">

            <a href="{{ route('home') }}"
               class="nav-link d-inline-block">

                Beranda

            </a>


            <a href="#produk"
               class="nav-link d-inline-block">

                Produk

            </a>


            <a href="{{ route('cart.index') }}"
               class="nav-link d-inline-block">

                🛒 Keranjang

            </a>

            <a href="{{ route('orders.index') }}"
   class="nav-link d-inline-block">

    📦 Pesanan Saya

</a>


            <form action="{{ route('logout') }}"
                  method="POST"
                  class="d-inline">

                @csrf

                <button class="btn btn-outline-danger ms-3">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>


<section class="hero">

    <div class="container-fluid">

        <div class="row align-items-center">

            <div class="col-md-7">

                <h1>

                    Semua Kebutuhan

                    <span>Si Meong</span>

                    Ada di Sini 🐾

                </h1>


                <p>

                    Temukan makanan berkualitas dan
                    perlengkapan terbaik untuk membuat
                    kucing kesayanganmu semakin sehat,
                    nyaman dan bahagia.

                </p>


                <a href="#produk"
                   class="shop-btn">

                    Belanja Sekarang

                </a>

            </div>


            <div class="col-md-5">

                <div class="cat-icon">

                    😺

                </div>

            </div>

        </div>

    </div>

</section>


<section class="products"
         id="produk">

    <div class="section-title">

        <h2>

            Produk Pilihan MeowMart

        </h2>

        <p>

            Pilihan kebutuhan terbaik
            untuk kucing kesayanganmu.

        </p>

    </div>


    <div class="container-fluid">

        <div class="row g-4">


            @forelse($products as $product)


                <div class="col-lg-4 col-md-6">
                    <div class="product-card">


                        <div class="product-image">


                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                >


                            @elseif($product->category == 'Makanan Kucing')

                                🥫


                            @elseif($product->category == 'Mainan Kucing')

                                🧶


                            @else

                                🏠


                            @endif


                        </div>


                        <span class="category">

                            {{ strtoupper($product->category) }}

                        </span>


                        <h3>

                            {{ $product->name }}

                        </h3>


                        <p class="description">

                            {{ $product->description }}

                        </p>


                        <p class="price">

                            Rp {{ number_format(
                                $product->price,
                                0,
                                ',',
                                '.'
                            ) }}

                        </p>


                        <p class="stock">

                            Stok: {{ $product->stock }}

                        </p>


                        <form
                            action="{{ route('cart.store', $product) }}"
                            method="POST"
                        >

                            @csrf


                            <button
                                type="submit"
                                class="cart-btn"
                            >

                                🛒 Tambah ke Keranjang

                            </button>


                        </form>


                    </div>

                </div>


            @empty


                <div class="col-12">

                    <p class="text-center">

                        Belum ada produk.

                    </p>

                </div>


            @endforelse


        </div>

    </div>

</section>


<footer>

    <p class="mb-0">

        🐾 MeowMart — Sahabat Terbaik Si Meong

    </p>

</footer>


</body>

</html>