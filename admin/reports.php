<?php
session_start();
include '../includes/db_connect.php';

// if ($_SESSION['role'] !== 'admin') {
//     header("Location: ../index.php");
//     exit();
// }

$total_tests = $connect->query("SELECT COUNT(*) as total FROM appointments WHERE appointment_type='COVID Test'")->fetch_assoc()['total'];
$total_vaccinations = $connect->query("SELECT COUNT(*) as total FROM appointments WHERE appointment_type='Vaccination'")->fetch_assoc()['total'];

if (!$total_tests || !$total_vaccinations) {
    $total_tests = 0;
    $total_vaccinations = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Reports | COVID Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f8fafc;
        color: #222;
    }

    .navbar {
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .navbar-brand {
        color: #2BBBAD !important;
        font-weight: 600;
    }

    .navbar .nav-link:hover {
        color: #2BBBAD !important;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .hero {
        background: linear-gradient(120deg, #2BBBAD 60%, #6ea8fe 100%);
        color: #fff;
        padding: 60px 0;
        text-align: center;
        border-radius: 0 0 40px 40px;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px 0;
    }

    .btn-primary {
        background-color: #2BBBAD;
        border: none;
    }

    .btn-outline-primary {
        color: #2BBBAD;
        border-color: #2BBBAD;
    }

    .btn-outline-primary:hover {
        background-color: #2BBBAD;
        color: #fff;
    }

    footer {
        background: #2BBBAD;
        color: #fff;
        padding: 20px 0;
        margin-top: 50px;
    }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Admin Reports</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="reports.php">Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-5 fw-bold">System Analytics & Reports</h1>
            <p class="fs-5">Visualize patient activity, testing trends, and vaccine status.</p>
        </div>
    </section>

    <!-- Report Content -->
    <div class="container mt-5">

        <div class="dashboard-card">
            <h4><i class="bi bi-bar-chart"></i> Overview Chart</h4>
            <canvas id="myChart" height="100"></canvas>
        </div>

        <div class="dashboard-card text-center">
            <h5><i class="bi bi-file-earmark-spreadsheet"></i> Export Reports</h5>
            <p>Download reports in Excel format for offline analysis.</p>
            <a href="export.php" class="btn btn-outline-primary">Export to Excel</a>
        </div>

    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; 2025 CURE Portal. All rights reserved.</p>
        </div>
    </footer>

    <!-- Chart Script -->
    <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // Change to 'line', 'doughnut' etc. as needed
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                    label: 'Total Bookings',
                    data: [12, 19, 8, 15, 22],
                    backgroundColor: '#2BBBAD'
                },
                {
                    label: 'Vaccinations',
                    data: [5, 14, 10, 8, 18],
                    backgroundColor: '#6ea8fe'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

</body>

</html>