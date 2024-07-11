<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <style>
        /* CSS from your provided code */

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #7D0A0A;
            color: white;
            padding-top: 20px;
            transition: width 0.3s ease;
        }

        .sidebar h2 {
            text-align: left;
            margin-bottom: 0;
            font-size: 2.0em;
            border-bottom: 1px solid #4e555b;
            padding-bottom: 10px;
            padding: 1px 20px;
        }

        /* Add the rest of your CSS rules here */

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
            display: block;
            padding: 15px 20px;
            font-size: 1.1em;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            color: #f8f9fa;
        }

        .sidebar ul li .dropdown-btn {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding-left: 20px;
        }

        .sidebar ul li .dropdown-btn::after {
            content: '▼';
            font-size: 0.8em;
            transition: transform 0.3s ease;
            margin-left: 100px;
        }

        .sidebar ul li.active .dropdown-btn::after {
            transform: rotate(-180deg);
        }

        .sidebar ul .dropdown-content {
            display: none;
            background-color: #7D0A0A;
            margin-left: 20px;
            border-left: 1px solid #4e555b;
        }

        .sidebar ul .dropdown-content a {
            padding-left: 20px;
        }

        .sidebar ul li.active .dropdown-content {
            display: block;
        }

        /* Additional CSS for form styling */
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 95%;
        }

        /* Add the rest of your CSS rules here */

    </style>
</head>
<body>
    <div class="sidebar">
        <div class="position-sticky">
            <ul>
                <li>
                    <a class="active" aria-current="page" href="{{ route('daftar_pegawai.index') }}">
                        Daftar Pegawai
                    </a>
                </li>

                @auth
                    @if(Auth::user()->role == 'admin')
                        <li>
                            <a href="{{ route('alternatif.index') }}">
                                Alternatif
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</body>
</html>
