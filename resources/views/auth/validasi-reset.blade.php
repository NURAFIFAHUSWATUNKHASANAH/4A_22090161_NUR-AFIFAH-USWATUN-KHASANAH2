<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #890F0D; /* Warna latar belakang */
        }

        .container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Menggunakan alpha untuk membuat latar belakang semi-transparan */
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1); /* Efek bayangan */
            margin: 50px auto;
        }

        .form-group {
            margin-bottom: 20px;
            margin-right: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #890F0D; /* Warna label */
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #890F0D; /* Warna tombol */
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #630B0A; /* Warna tombol saat dihover */
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #007bff; /* Warna tautan */
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Lupa Password</h1>
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" id="success-message">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('validasi-lupa-password-act', ['email' => $email]) }}" id="reset-password-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="password">{{ __('Masukkan Password Baru') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </form>
                <div class="login-link">
                    <p>{{ __('Kembali ke login?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                document.getElementById('reset-password-form').reset();
            }
        });
    </script>
</body>
</html>
