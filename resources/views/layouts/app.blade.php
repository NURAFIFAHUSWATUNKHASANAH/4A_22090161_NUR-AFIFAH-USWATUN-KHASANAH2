<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .navbar {
            background-color: #630606;
            color: #333333;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .navbar .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
            margin-left: 20px;
        }

        .navbar .navbar-links {
            display: flex;
            align-items: center;
        }

        .navbar .navbar-links a {
            color: #333333;
            margin-right: 1rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .navbar .navbar-links a:hover {
            color: #007bff;
        }

        .navbar .navbar-links a:last-child {
            margin-right: 0;
        }

        .navbar .menu-toggle {
            font-size: 1.5rem;
            color: #ffffff;
            display: none;
            cursor: pointer;
            margin-left: auto;
        }

        .sidebar {
            height: calc(100vh - 56px);
            /* 56px is the height of the navbar */
            width: 250px;
            position: fixed;
            top: 56px;
            /* Aligns the sidebar right below the navbar */
            left: 0;
            background-color: #890F0D;
            color: white;
            padding-top: 20px;
            transition: width 0.3s ease;
            overflow-y: auto;
        }

        .sidebar h1 {
            text-align: left;
            margin: 0 20px 20px 20px;
            font-size: 1.5em;
            border-bottom: 1px solid #4e555b;
            padding-bottom: 10px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            border-bottom: 1px solid #4e555b;
            position: relative;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            font-size: 1.1em;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .sidebar ul li a img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
            vertical-align: middle;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            color: #f8f9fa;
        }

        .sidebar ul li .dropdown-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar ul li .dropdown-btn::after {
            content: '▼';
            font-size: 0.8em;
            transition: transform 0.3s ease;
            margin-left: auto;
        }

        .sidebar ul li.active .dropdown-btn::after {
            transform: rotate(-180deg);
        }

        .sidebar ul .dropdown-content {
            display: none;
            background-color: #7D0A0A;
            padding-left: 20px;
            border-left: 1px solid #4e555b;
        }

        .sidebar ul .dropdown-content a {
            padding-left: 30px;
        }

        .sidebar ul li.active .dropdown-content {
            display: block;
        }

        /* Slider styles */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #495057;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background-color: #7D0A0A;
        }

        .sidebar::-webkit-scrollbar-track {
            background-color: #333;
            border-radius: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            flex: 1;
            margin-top: 56px;
            /* Aligns the content right below the navbar */
        }

        /* Styled Table */
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .styled-table thead tr {
            background-color: #890F0D;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
            border: 1px solid #dddddd;
        }

        .styled-table th {
            width: auto;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #A91D3A;
        }

        /* CSS untuk Tabel Normalisasi */
        .normalisasi-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .normalisasi-table thead tr {
            background-color: #890F0D;
            color: #ffffff;
            text-align: left;
        }

        .normalisasi-table th,
        .normalisasi-table td {
            padding: 12px 15px;
            border: 1px solid #dddddd;
        }

        .normalisasi-table th {
            width: auto;
        }

        .normalisasi-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .normalisasi-table tbody tr:nth-of-type(even) {
            background-color: #f9f
        }

        .normalisasi-table thead tr {
            background-color: #890F0D;
            /* Warna latar belakang header */
            color: #ffffff;
            /* Warna teks header */
            text-align: left;
        }

        .normalisasi-table th,
        .normalisasi-table td {
            padding: 12px 15px;
            border: 1px solid #dddddd;
            /* Warna garis tepi */
        }

        .normalisasi-table th {
            width: auto;
        }

        .normalisasi-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .normalisasi-table tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
            /* Warna latar belakang baris genap */
        }

        .normalisasi-table tbody tr:last-of-type {
            border-bottom: 2px solid #890F0D;
            /* Warna garis bawah baris terakhir */
        }

        /* Styled create */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        .btn {
            display: inline-block;
            padding: 6px 14px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        /* Gaya default untuk tombol */
        .btn-default {
            background-color: #007bff;
            color: #fff;
        }

        /* Hover effect */
        .btn-default:hover {
            background-color: #0056b3;
        }

        /* Gaya untuk tombol tambah */
        .btn-add {
            background-color: #890F0D;
            color: #fff;
        }

        /* Hover effect */
        .btn-add:hover {
            background-color: #c82333;

        }

        /* Gaya untuk tombol edit */
        .btn-edit {
            background-color: #ffc107;
            color: #ffffff;
        }



        /* Hover effect */
        .btn-edit:hover {
            background-color: #e0a800;
        }

        /* Gaya untuk tombol hapus */
        .btn-delete {
            background-color: #890F0D;
            color: #ffffff;
        }

        /* Hover effect */
        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-update {
            background-color: #890F0D;
            color: #fff;
        }

        .btn-update:hover {
            background-color: #890F0D;
        }


        @media (max-width: 768px) {
            .navbar .navbar-links {
                flex-direction: column;
                align-items: flex-start;
                display: none;
                /* Hide navbar links by default on small screens */
            }

            .navbar .menu-toggle {
                display: block;
                /* Show the menu toggle button */
                cursor: pointer;
                /* Ensure cursor indicates it's clickable */
                margin-left: auto;
                color: #ffffff;
                /* Ensure the toggle icon is visible */
            }

            .sidebar {
                width: 250px;
                /* Sidebar width on small screens */
                height: 100%;
                /* Full height to fit screen */
                position: fixed;
                top: 56px;
                /* Aligns the sidebar right below the navbar */
                left: -250px;
                /* Hide sidebar by default on small screens */
                background-color: #890F0D;
                color: white;
                padding-top: 20px;
                transition: left 0.3s ease;
                overflow-y: auto;
            }

            .sidebar.active {
                left: 0;
                /* Show sidebar when active */
            }

            .main-content {
                margin-left: 0;
                /* Adjust main content when sidebar is hidden */
                margin-top: 56px;
                /* Add margin top to accommodate navbar */
                padding: 1rem;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="navbar">
        <div class="navbar-brand">
            MyApp
            <span class="menu-toggle" onclick="toggleSidebar()">&#9776;</span>
        </div>
        <div class="navbar-links">
            @guest
            <a href="{{ route('login') }}" style="color: #333333; margin-right: 1rem;">Login</a>
            @else
            <a href="#" style="color: #ffffff; margin-right: 1rem; display: inline-block;">
                <img src="{{ asset('icons/user.png') }}" alt="User Icon" style="margin-right: 0.5rem; vertical-align: middle;">
                <span style="vertical-align: middle;">{{ Auth::user()->name }}</span>
            </a>
            <a href="{{ route('logout') }}" style="color: white; margin-right: 50px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endguest
        </div>
    </div>


    <div class="sidebar">
        <!-- <h1>Menu</h1> -->
        <ul>
            <li>
                @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" style="margin-top: 30px;">
                    <img src="{{ asset('icons/dashboard.png') }}" alt="Dashboard"> Dashboard
                </a>

                @else
                <a href="{{ route('user.dashboard') }}">
                    <img src="{{ asset('icons/dashboard.png') }}" alt="Dashboard"> Dashboard
                </a>
                @endif

            </li>

            <li class="dropdown {{ request()->routeIs('employees.*') || request()->routeIs('alternatifs.*') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="dropdown-btn"><img src="{{ asset('icons/folder.png') }}" alt="Data"> Data</a>
                <ul class="dropdown-content">
                    <li><a href="{{ route('daftar_pegawai.index') }}" class="{{ request()->routeIs('daftar_pegawai.index') ? 'active' : '' }}"><img src="{{ asset('icons/employee.png') }}" alt="Daftar Karyawan"> Data Pegawai</a></li>
                    <li><a href="{{ route('alternatif.index') }}" class="{{ request()->routeIs('alternatif.index') ? 'active' : '' }}"><img src="{{ asset('icons/daftar.png') }}" alt="Data Alternatif"> Data Alternatif</a></li>
                    <li><a href="{{ route('kriteria.index') }}" class="{{ request()->routeIs('kriteria.index') ? 'active' : '' }}"><img src="{{ asset('icons/search.png') }}" alt="Data Kriteria"> Data Kriteria</a></li>
                </ul>
            </li>

            <li class="dropdown {{ request()->routeIs('perhitungan.*') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="dropdown-btn"><img src="{{ asset('icons/calculator.png') }}" alt="Perhitungan"> Perhitungan</a>
                <ul class="dropdown-content">
                    <li><a href="{{ route('alternatif.index') }}" class="{{ request()->routeIs('alternatif.index') ? 'active' : '' }}"><img src="{{ asset('icons/checklist.png') }}" alt="Data Alternatif"> Nilai Alternatif</a></li>
                    <!-- Menu Normalisasi -->
                    <li><a href="{{ route('topsis.index') }}" class="{{ request()->routeIs('topsis.index') ? 'active' : '' }}"><img src="{{ asset('icons/process.png') }}" alt="Normalisasi"> Normalisasi</a></li>
                    <li><a href="{{ route('topsis.ranking') }}" class="{{ request()->routeIs('topsis.ranking') ? 'active' : '' }}"><img src="{{ asset('icons/ranking.png') }}" alt="Peringkat"> Peringkat</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.show') ? 'active' : '' }}">
                    <img src="{{ asset('icons/account.png') }}" alt="Profile"> Akun
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('icons/input.png') }}" alt="Logout"> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <main class="main-content">
        <div class="content-container">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var dropdownBtns = document.querySelectorAll('.dropdown-btn');

            dropdownBtns.forEach(function(dropdownBtn) {
                dropdownBtn.addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent the click event from bubbling up

                    var dropdown = dropdownBtn.closest('.dropdown');
                    dropdown.classList.toggle('active');
                });
            });

            // Close all dropdowns when clicking outside of them
            document.addEventListener('click', function(event) {
                dropdownBtns.forEach(function(dropdownBtn) {
                    var dropdown = dropdownBtn.closest('.dropdown');
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.remove('active');
                    }
                });
            });
        });
    </script>


</body>

</html>