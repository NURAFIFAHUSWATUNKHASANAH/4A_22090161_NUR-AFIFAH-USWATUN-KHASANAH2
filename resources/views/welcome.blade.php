<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Sistem Pendukung Keputusan Kenaikan Pangkat PNS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hero-bg {
            background: url('/icons/background.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .button-primary,
        .button-secondary {
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }

        .button-primary {
            background-color: #ef4444;
            color: #fff;
        }

        .button-primary:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
        }

        .button-secondary {
            background-color: #4b5563;
            color: #fff;
        }

        .button-secondary:hover {
            background-color: #374151;
            transform: translateY(-2px);
        }

        .info-section {
            background-color: #f9fafb;
            padding: 3rem 0;
        }

        .info-box {
            background-color: #fff;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-2px);
        }

        .info-icon {
            font-size: 2.5rem;
            color: #ef4444;
        }

        .topsis-section {
            background-color: #e5e7eb;
            padding: 3rem 0;
        }

        .topsis-box {
            background-color: #fff;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .topsis-box:hover {
            transform: translateY(-2px);
        }

        .navbar {
            background-color: rgba(125, 10, 10, 0.8);
            padding: 1rem 0;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            transition: background-color 0.3s ease;
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 1rem;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #9ca3af;
        }

        footer {
            background-color: #f3f4f6;
            padding: 0,8rem 0;
            text-align: center;
        }

    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-2xl font-semibold text-white">MyApp</h1>
            </div>
            <div>
                <a href="#home" class="text-white">Home</a>
                <a href="#info" class="text-white">Info</a>
                <a href="#topsis" class="text-white">Topsis</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-bg">
        <div class="overlay"></div>
        <div class="hero-content container mx-auto flex flex-col items-center justify-center min-h-screen text-center text-white">
            <h2 class="text-5xl font-bold mb-6">Selamat Datang</h2>
            <p class="text-lg mb-4 max-w-2xl">
                Selamat datang di Sistem Pendukung Keputusan untuk rekomendasi kenaikan pangkat Pegawai Negeri Sipil (PNS). Sistem ini dirancang untuk membantu Anda dalam proses evaluasi dan pengambilan keputusan terkait kenaikan pangkat pegawai.
            </p>

            <!-- CTA Buttons -->
            <div class="mt-6">
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('login') }}" class="button-primary">Log in</a>
                    <a href="{{ route('register') }}" class="button-secondary">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Section -->
    <section class="info-section" id="info">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="info-box">
                    <div class="info-icon mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4H8l4-4 4 4h-3v4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Kenaikan Pangkat</h3>
                    <p class="text-gray-600">Proses rekomendasi kenaikan pangkat yang cepat dan akurat.</p>
                </div>
                <div class="info-box">
                    <div class="info-icon mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3M19 19H5V5h7M12 1v2m8 8h2m-2 4h2m-2 4h2M4 12H2m2 4H2m2 4H2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Evaluasi Kinerja</h3>
                    <p class="text-gray-600">Sistem evaluasi kinerja pegawai yang transparan dan objektif.</p>
                </div>
                <div class="info-box">
                    <div class="info-icon mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h3m6 8h2m-6-4h6m2 0h2M9 12H7M5 12H3M7 12H5m-2 0h2m2-4H7M7 8H5M5 8H3m2 0H3m2-4h2m4 12H7m2-4H9m-2-4H7m0-4h2M9 8H7M7 8H5m2-4h2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Transparansi</h3>
                    <p class="text-gray-600">Memastikan transparansi dalam setiap tahap pengambilan keputusan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TOPSIS Section -->
    <section class="topsis-section" id="topsis">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="topsis-box">
                    <h3 class="text-2xl font-semibold mb-4">Pengertian Metode TOPSIS</h3>
                    <p class="text-gray-700">
                        Metode TOPSIS (Technique for Order Preference by Similarity to Ideal Solution) adalah salah satu metode pengambilan keputusan multikriteria. Metode ini menggunakan konsep alternatif terbaik yang memiliki jarak terpendek dari solusi ideal positif dan jarak terjauh dari solusi ideal negatif.
                    </p>
                </div>
                <div class="topsis-box">
                    <h3 class="text-2xl font-semibold mb-4">Tentang Sistem Pendukung Keputusan</h3>
                    <p class="text-gray-700">
                        Sistem Pendukung Keputusan Kenaikan Pangkat PNS ini dirancang untuk membantu proses evaluasi dan pengambilan keputusan terkait kenaikan pangkat pegawai negeri sipil. Sistem ini menggunakan berbagai kriteria evaluasi dan metode pengambilan keputusan untuk memastikan proses yang objektif, transparan, dan efisien.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 shadow mt-16">
        <div class="container mx-auto px-6 py-4">
            <p class="text-center text-gray-600 dark:text-gray-400">© 2024 Sistem Pendukung Keputusan Kenaikan Pangkat PNS.</p>
        </div>
    </footer>
</body>

</html>
