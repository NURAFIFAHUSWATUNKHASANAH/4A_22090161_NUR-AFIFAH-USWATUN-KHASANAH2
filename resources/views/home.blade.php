<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Logout</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        p {
            margin-bottom: 20px;
            font-size: 18px; /* Menambahkan ukuran font */
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-transform: uppercase; /* Menjadikan teks huruf besar */
            font-weight: bold; /* Menjadikan teks lebih tebal */
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Efek hover untuk container */
        .container:hover {
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2); /* Membuat bayangan lebih jelas saat hover */
        }
    </style>
    <!-- Styles lainnya -->
</head>
<body>
    <div class="container">
        <p>Lupa untuk logout saat login sebelumnya? Klik Masuk Lagi!</p>
        <div class="buttons">
            <!-- <a href="{{ route('login') }}" class="btn btn-primary">Masuk Kembali</a> -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Masuk Lagi</button>
            </form>
        </div>
    </div>
</body>
</html>
