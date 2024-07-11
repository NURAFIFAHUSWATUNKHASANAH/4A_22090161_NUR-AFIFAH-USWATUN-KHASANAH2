<!-- resources/views/layouts/login-layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 1rem;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .card-header {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }
    </style>
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="login-container">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
