<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - MeowMart</title>

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
            overflow: hidden;
        }

        .paw {
            position: absolute;
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
            right: 20%;
            animation-delay: 2s;
        }

        .login-card {
            width: 420px;
            max-width: 90%;
            background: white;
            padding: 40px;
            border-radius: 22px;
            box-shadow: 0 15px 40px rgba(90, 62, 54, 0.15);
            position: relative;
            animation: cardEnter 0.8s ease;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(90, 62, 54, 0.2);
        }

        .cat-icon {
            text-align: center;
            font-size: 55px;
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
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
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

        .login-button {
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

        .login-button:hover {
            background: #bd7652;
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(217, 144, 104, 0.35);
        }

        .login-button:active {
            transform: scale(0.97);
        }

        .register-text {
            text-align: center;
            margin-top: 25px;
            color: #777;
        }

        .register-text a {
            color: #d17850;
            font-weight: bold;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e5f6e8;
            color: #267a37;
        }

        .alert-error {
            background: #ffe5e5;
            color: #a52a2a;
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

    <div class="login-card">

        <div class="cat-icon">
            🐱
        </div>

        <h1 class="brand">
            MeowMart
        </h1>

        <p class="subtitle">
            Semua kebutuhan si meong dalam satu tempat.
        </p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">

            @csrf

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
                    placeholder="Masukkan password"
                    required
                >

            </div>

            <button
                type="submit"
                class="login-button"
            >
                Masuk ke MeowMart 🐾
            </button>

        </form>

        <p class="register-text">

            Belum punya akun?

            <a href="{{ route('register') }}">
                Daftar sekarang
            </a>

        </p>

    </div>

</body>

</html>