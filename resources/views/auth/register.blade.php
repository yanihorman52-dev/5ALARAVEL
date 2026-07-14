<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - MeowMart</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fff8f0, #ffe8d6);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 0;
            overflow-x: hidden;
        }

        .paw {
            position: fixed;
            font-size: 45px;
            opacity: 0.12;
            animation: floatPaw 5s ease-in-out infinite;
        }

        .paw-1 {
            top: 10%;
            left: 10%;
        }

        .paw-2 {
            bottom: 12%;
            right: 12%;
            animation-delay: 1s;
        }

        .paw-3 {
            top: 20%;
            right: 18%;
            animation-delay: 2s;
        }

        .register-card {
            width: 450px;
            max-width: 90%;
            background: white;
            padding: 40px;
            border-radius: 22px;
            box-shadow: 0 15px 40px rgba(90, 62, 54, 0.15);
            position: relative;
            animation: cardEnter 0.8s ease;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(90, 62, 54, 0.2);
        }

        .cat-icon {
            text-align: center;
            font-size: 50px;
            animation: catFloat 2.5s ease-in-out infinite;
        }

        .brand {
            text-align: center;
            color: #7a4f3d;
            margin: 8px 0;
            font-size: 30px;
        }

        .subtitle {
            text-align: center;
            color: #888;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #5f4035;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
            transition: 0.3s ease;
        }

        input:focus {
            border-color: #d99068;
            box-shadow: 0 0 0 4px rgba(217, 144, 104, 0.15);
            transform: translateY(-2px);
        }

        .register-button {
            width: 100%;
            background: #d99068;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .register-button:hover {
            background: #bd7652;
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(217, 144, 104, 0.35);
        }

        .register-button:active {
            transform: scale(0.97);
        }

        .login-text {
            text-align: center;
            margin-top: 25px;
            color: #777;
        }

        .login-text a {
            color: #d17850;
            font-weight: bold;
            text-decoration: none;
        }

        .login-text a:hover {
            text-decoration: underline;
        }

        .alert-error {
            background: #ffe5e5;
            color: #a52a2a;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(35px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes catFloat {
            0%, 100% {
                transform: translateY(0);
                }

            50% {
                transform: translateY(-7px);
            }
        }

        @keyframes floatPaw {
            0%, 100% {
                transform: translateY(0) rotate(0);
            }

            50% {
                transform: translateY(-15px) rotate(8deg);
            }
        }
    </style>

</head>

<body>

    <div class="paw paw-1">🐾</div>
    <div class="paw paw-2">🐾</div>
    <div class="paw paw-3">🐾</div>

    <div class="register-card">

        <div class="cat-icon">
            😺
        </div>

        <h1 class="brand">
            Daftar MeowMart
        </h1>

        <p class="subtitle">
            Buat akun dan temukan kebutuhan terbaik untuk kucingmu.
        </p>

        @if($errors->any())

            <div class="alert-error">
                {{ $errors->first() }}
            </div>

        @endif

        <form action="{{ route('register') }}" method="POST">

            @csrf

            <div class="form-group">

                <label>Nama</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama"
                    required
                >

            </div>

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                >

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Minimal 6 karakter"
                    required
                >

            </div>

            <div class="form-group">

                <label>Konfirmasi Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    required
                >

            </div>

            <button
                type="submit"
                class="register-button"
            >
                Buat Akun 🐾
            </button>

        </form>

        <p class="login-text">

            Sudah punya akun?

            <a href="{{ route('login') }}">
                Login sekarang
            </a>

        </p>

    </div>

</body>

</html>