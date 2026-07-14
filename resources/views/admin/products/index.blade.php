<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Produk - MeowMart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #fff8f5;
            font-family: Arial, sans-serif;
            color: #453d3d;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
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
            background: rgba(255,255,255,.2);
            transform: translateX(6px);
        }

        .main {
            margin-left: 250px;
            padding: 45px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .header h1 {
            font-weight: bold;
        }

        .add-btn {
            background: linear-gradient(90deg, #ff6534, #ff416c);
            color: white;
            padding: 13px 22px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            transition: .3s;
        }

        .add-btn:hover {
            color: white;
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(255,65,108,.3);
        }

        .product-box {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,.07);
            animation: muncul .6s ease;
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

        table {
            vertical-align: middle !important;
        }

        .product-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 14px;
        }

        .no-image {
            width: 70px;
            height: 70px;
            background: #fff0eb;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            font-size: 30px;
        }

        .price {
            color: #ff416c;
            font-weight: bold;
        }

        .btn-edit {
            background: #ffb02e;
            color: white;
            border: none;
        }

        .btn-delete {
            background: #ff416c;
            color: white;
            border: none;
        }

        .alert {
            border: none;
            border-radius: 14px;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h2>🐾 MeowMart</h2>

  <a href="{{ route('admin.products.index') }}" class="active">
    📦 Kelola Produk
</a>

<a href="{{ route('admin.orders.index') }}">
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

    <div class="header">

        <div>
            <h1>Kelola Produk 🐱</h1>
            <p class="text-muted">
                Tambah, edit dan hapus produk MeowMart.
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}"
           class="add-btn">
           + Tambah Produk
        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>

    @endif


    <div class="product-box">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>

                    <tr>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr>

                            <td>

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        class="product-img"
                                        alt="{{ $product->name }}"
                                    >

                                @else

                                    <div class="no-image">
                                        🐱
                                    </div>

                                @endif

                            </td>


                            <td>

                                <strong>
                                    {{ $product->name }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ Str::limit($product->description, 45) }}
                                </small>

                            </td>


                            <td>
                                {{ $product->category }}
                            </td>


                            <td class="price">

                                Rp {{ number_format($product->price, 0, ',', '.') }}

                            </td>


                            <td>

                                {{ $product->stock }}

                            </td>


                            <td>

                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="btn btn-edit btn-sm">

                                    Edit

                                </a>


                                <form
                                    action="{{ route('admin.products.destroy', $product) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-delete btn-sm">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5">

                                Belum ada produk 🐱

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>

</body>
</html>