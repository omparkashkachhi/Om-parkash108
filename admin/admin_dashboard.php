<?php
// dashboard.php

session_start();
// Example: Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Example dynamic data (replace with DB queries)
$totalUsers = 1200;
$totalVaccinations = 950;
$pendingAppointments = 35;
$availableVaccines = 50;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Vaccination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Simple CSS for responsiveness -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: #1976d2;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.5rem;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-left: 1rem;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            flex: 1 1 220px;
            min-width: 220px;
            padding: 2rem;
            text-align: center;
        }

        .card h2 {
            margin: 0 0 1rem 0;
            font-size: 2rem;
            color: #1976d2;
        }

        .card p {
            margin: 0;
            color: #555;
        }

        @media (max-width: 700px) {
            .cards {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>Admin Dashboard</h1>
        <div>
            <a href="manage_users.php">Users</a>
            <a href="manage_vaccines.php">Vaccines</a>
            <a href="appointments.php">Appointments</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="dashboard-container"></div>
    <div class="cards">
        <div class="card">
            <h2><?php echo $totalUsers; ?></h2>
            <p>Total Registered Users</p>
        </div>
        <div class="card">
            <h2><?php echo $totalVaccinations; ?></h2>
            <p>Total Vaccinations</p>
        </div>
        <div class="card">
            <h2><?php echo $pendingAppointments; ?></h2>
            <p>Pending Appointments</p>
        </div>
        <div class="card">
            <h2><?php echo $availableVaccines; ?></h2>
            <p>Available Vaccines</p>
        </div>
    </div>

    <!-- Patient Management Table Example -->
    <h2 style="margin-top:2rem;">Patient Management</h2>
    <table border="1" cellpadding="8" cellspacing="0" style="width:100%;background:#fff;">
        <tr style="background:#1976d2;color:#fff;">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Ahmed</td>
            <td>ahmed@example.com</td>
            <td>
                <a href="view_patient.php?id=1"
                    style="background:#388e3c;color:#fff;padding:4px 10px;border-radius:4px;text-decoration:none;margin-right:5px;">View</a>
                <a href="edit_patient.php?id=1"
                    style="background:#1976d2;color:#fff;padding:4px 10px;border-radius:4px;text-decoration:none;">Edit</a>
            </td>
        </tr>
        <!-- Add more rows dynamically from DB -->
    </table>

    <!-- Vaccine Entry Form Example -->
    <h2 style="margin-top:2rem;">Add New Vaccine</h2>
    <form method="post" action="add_vaccine.php"
        style="background:#fff;padding:1rem;border-radius:8px;max-width:400px;">
        <label for="vaccine_name">Vaccine Name:</label><br>
        <input type="text" id="vaccine_name" name="vaccine_name" required style="width:100%;margin-bottom:1rem;"><br>
        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" required style="width:100%;margin-bottom:1rem;"><br>
        <button type="submit"
            style="background:#1976d2;color:#fff;padding:0.5rem 1rem;border:none;border-radius:4px;">Add
            Vaccine</button>
    </form>

    <!-- Chart Example (using Chart.js CDN) -->
    <h2 style="margin-top:2rem;">Statistics</h2>
    <canvas id="statsChart" width="400" height="150" style="background:#fff;padding:1rem;border-radius:8px;"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('statsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users', 'Vaccinations', 'Appointments', 'Vaccines'],
                datasets: [{
                    label: 'Count',
                    data: [
                        <?php echo $totalUsers; ?>,
                        <?php echo $totalVaccinations; ?>,
                        <?php echo $pendingAppointments; ?>,
                        <?php echo $availableVaccines; ?>
                    ],
                    backgroundColor: [
                        '#1976d2',
                        '#388e3c',
                        '#fbc02d',
                        '#d32f2f'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
    </div>
</body>

</html>