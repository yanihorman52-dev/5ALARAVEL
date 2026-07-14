<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - MeowMart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fff5ef, #ffe5ec);
            font-family: Arial, sans-serif;
            color: #453d3d;
        }

        .checkout-page {
            width: 88%;
            margin: auto;
            padding: 55px 0;
            animation: muncul .7s ease;
        }

        .title h1 {
            font-weight: bold;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            height: 100%;
        }

        .form-control,
        .form-select {
            padding: 12px;
            border-radius: 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ff416c;
            box-shadow: 0 0 0 .2rem rgba(255,65,108,.15);
        }

        .order-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .price {
            color: #ff416c;
            font-weight: bold;
        }

        .total {
            font-size: 27px;
            color: #ff416c;
            font-weight: bold;
        }

        .checkout-btn {
            width: 100%;
            border: none;
            padding: 14px;
            border-radius: 13px;
            background: linear-gradient(90deg, #ff6534, #ff416c);
            color: white;
            font-weight: bold;
            transition: .3s;
        }

        .checkout-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(255,65,108,.3);
        }

        .back {
            color: #ff416c;
            text-decoration: none;
            font-weight: bold;
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

<div class="checkout-page">

    <div class="title mb-4">
        <h1>Checkout Pesanan 🐾</h1>

        <p class="text-muted">
            Lengkapi informasi pengiriman pesananmu.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-lg-7">

            <div class="box">

                <h3 class="fw-bold mb-4">
                    Informasi Pengiriman
                </h3>

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('checkout.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Penerima</label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', auth()->user()->name) }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone') }}"
                               placeholder="Contoh: 081234567890"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Pengiriman</label>

                        <textarea name="address"
                        class="form-control"
                                  rows="5"
                                  required>{{ old('address') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Metode Pembayaran</label>

                        <select name="payment_method"
                                class="form-select"
                                required>

                            <option value="">
                                Pilih Metode Pembayaran
                            </option>

                            <option value="Transfer Bank">
                                Transfer Bank
                            </option>

                            <option value="E-Wallet">
                                E-Wallet
                            </option>

                            <option value="COD">
                                COD
                            </option>

                        </select>
                    </div>

                    <button type="submit" class="checkout-btn">
                        Buat Pesanan 🐱
                    </button>

                </form>

            </div>

        </div>

        <div class="col-lg-5">

            <div class="box">

                <h3 class="fw-bold mb-3">
                    Ringkasan Pesanan
                </h3>

                @foreach($carts as $cart)

                    <div class="order-item">

                        <strong>
                            {{ $cart->product->name }}
                        </strong>

                        <div class="text-muted">
                            {{ $cart->quantity }} x
                            Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                        </div>

                        <div class="price">
                            Rp {{ number_format(
                                $cart->product->price * $cart->quantity,
                                0,
                                ',',
                                '.'
                            ) }}
                        </div>

                    </div>

                @endforeach

                <div class="mt-4">

                    <span>Total Pembayaran</span>

                    <div class="total">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="mt-4">
        <a href="{{ route('cart.index') }}" class="back">
            ← Kembali ke Keranjang
        </a>
    </div>

</div>

</body>
</html>