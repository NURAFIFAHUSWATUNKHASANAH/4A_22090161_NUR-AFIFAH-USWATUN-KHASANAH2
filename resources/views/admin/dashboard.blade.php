@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .card {
            width: 30%;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 16px;
            color: #666;
        }

        .profile-container {
            width: 30%;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-container h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .profile-container p {
            font-size: 14px;
            color: #666;
        }

        .card-green {
            background-color: #4CAF50;
            color: #fff;
        }

        .card-blue {
            background-color: #2196F3;
            color: #fff;
        }

        .card-icon {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .card-icon-calendar {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .welcome-message {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 5px;
            padding-top: 30px;
            color: #333;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 75vh;
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
        }

        .chart-container div {
            flex: 1;
            padding: 10px;
        }

        canvas {
            max-width: 1000px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<h1>Selamat Datang</h1>
    <div class="container">
        <div class="chart-container">
            <div>
                <h2>Jumlah Pegawai Berdasarkan Jenis Kelamin</h2>
                <canvas id="genderChartCanvas"></canvas>
            </div>
            <div>
                <h2>Nilai Bobot Kriteria</h2>
                <canvas id="kriteriaChart" style="margin-top: 150px;"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var kriteriaData = {
            labels: ['C1', 'C2', 'C3', 'C4', 'C5'],
            datasets: [{
                label: 'Bobot Kriteria',
                backgroundColor: '#E83A14',
                borderColor: '#D9CE3F',
                borderWidth: 3,
                data: [5, 5, 4, 3, 3]
            }]
        };

        var ctx = document.getElementById('kriteriaChart').getContext('2d');
        var kriteriaChart = new Chart(ctx, {
            type: 'bar',
            data: kriteriaData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var jumlahLakiLaki = {{ $jumlahLakiLaki }};
        var jumlahPerempuan = {{ $jumlahPerempuan }};

        var genderChartData = {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [jumlahLakiLaki, jumlahPerempuan],
                backgroundColor: ['#E83A14', '#D9CE3F'],
                hoverBackgroundColor: ['#FF7D29', '#FFF78A']
            }]
        };

        var ctxGenderChart = document.getElementById('genderChartCanvas').getContext('2d');
        var genderChart = new Chart(ctxGenderChart, {
            type: 'doughnut',
            data: genderChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Pegawai Berdasarkan Jenis Kelamin'
                    }
                }
            }
        });
    </script>
    
</body>

</html>
@endsection
