<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Produk - MeowMart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fff4ee, #ffe5ec);
            font-family: Arial, sans-serif;
            color: #453d3d;
        }

        .page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .form-box {
            width: 100%;
            max-width: 750px;
            background: white;
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(0,0,0,.1);
            animation: muncul .6s ease;
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

        h1 {
            font-weight: bold;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px;
        }

        .current-image {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 18px;
            margin-bottom: 12px;
        }

        .save-btn {
            border: none;
            background: linear-gradient(90deg, #ff6534, #ff416c);
            color: white;
            padding: 13px 25px;
            border-radius: 12px;
            font-weight: bold;
            transition: .3s;
        }

        .save-btn:hover {
            transform: translateY(-3px);
        }

        .back-btn {
            text-decoration: none;
            color: #777;
            margin-left: 15px;
        }
    </style>
</head>

<body>

<div class="page">

    <div class="form-box">

        <h1>Edit Produk 🐱</h1>

        <p class="text-muted mb-4">
            Perbarui informasi produk MeowMart.
        </p>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $product->name) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>

                <select name="category"
                        class="form-select"
                        required>

                    <option value="Makanan Kucing"
                        {{ $product->category == 'Makanan Kucing' ? 'selected' : '' }}>
                        Makanan Kucing
                    </option>

                    <option value="Mainan Kucing"
                        {{ $product->category == 'Mainan Kucing' ? 'selected' : '' }}>
                        Mainan Kucing
                    </option>

                    <option value="Perlengkapan"
                        {{ $product->category == 'Perlengkapan' ? 'selected' : '' }}>
                        Perlengkapan
                    </option>

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>

                <textarea name="description"
                          class="form-control"
                          rows="4"
                          required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga</label>

                    <input type="number"
                           name="price"
                           class="form-control"
                           value="{{ $product->price }}"
                           min="0"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Stok</label>

                    <input type="number"
                           name="stock"
                           class="form-control"
                           value="{{ $product->stock }}"
                           min="0"
                           required>
                </div>

            </div>

            <div class="mb-4">

                <label class="form-label d-block">
                    Gambar Produk
                </label>

                @if($product->image)

                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="current-image"
                         alt="{{ $product->name }}">

                @endif

                <input type="file"
                       name="image"
                       class="form-control"
                       accept="image/*">

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti gambar.
                </small>

            </div>

            <button type="submit" class="save-btn">
                💾 Simpan Perubahan
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="back-btn">
                Kembali
            </a>

        </form>

    </div>

</div>

</body>
</html>