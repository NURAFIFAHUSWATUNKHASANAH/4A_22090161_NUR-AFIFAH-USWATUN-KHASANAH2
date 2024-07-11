<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #890F0D;
            /* Warna latar belakang */
        }

        .background-image {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/icons/background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            /* Menggunakan alpha untuk membuat latar belakang semi-transparan */
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            /* Efek bayangan */
        }

        .row {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .col {
            width: 100%;
            height: 50px;
            text-align: center;
            margin: 10px;
            border: 2px solid #890F0D;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #890F0D;
        }

        .sosial-icon {
            color: #890F0D;
            font-size: 32px;
            margin: 10px;
            text-decoration: none;
            display: inline-block;
        }

        .col.col-google:hover {
            background-color: #890F0D;
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: white;
        }

        .col.col-google:hover .sosial-icon {
            color: white;
        }
        .col.col-facebook:hover {
            background-color: #007b;
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: white;
        }

        .col.col-facebook:hover .sosial-icon {
            color: white;
        }

        .form-group {
            margin-bottom: 20px;
            margin-right: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #890F0D;
            /* Warna label */
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .btn-primary {
            width: 105%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #890F0D;
            /* Warna tombol */
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #630B0A;
            /* Warna tombol saat dihover */
        }

        .forgot-password-link {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password-link a {
            color: #007bff;
            /* Warna tautan */
            text-decoration: none;
        }

        .forgot-password-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 5px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>
    <div class="background-image">
        <div class="container">
            <h2 style="text-align: center; color: #890F0D;">Login</h2>
            <div class="row">
                <a href="{{ route('login.google') }}" class="col col-google">
                    <i class="fab fa-google-plus sosial-icon"></i>
                    <div>Login Google</div>
                </a>
                <a href="{{ route('login.facebook') }}" class="col col-facebook">
                    <i class="fab fa-facebook sosial-icon"></i>
                    <div>Login Facebook</div>
                </a>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi:</label>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <div class="forgot-password-link">
                <span>Belum Punya Akun? </span>
                <a href="{{ route('register') }}">Klik Registrasi</a>
            </div>
            <div class="forgot-password-link">
                <span>Lupa Password? </span>
                <a href="{{ route('lupa-password') }}">Klik Lupa Password</a>
            </div>
        </div>
    </div>

    <!-- Font Awesome 5 JS (optional for some features like animation) -->
    <script src="https://kit.fontawesome.com/eb263935b9.js" crossorigin="anonymous"></script>
</body>

</html>