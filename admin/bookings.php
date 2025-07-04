<?php
session_start();
include '../includes/db_connect.php';

// Fetch Booking Details
$query = "SELECT b.id, p.full_name AS patient_name, h.hospital_name, b.booking_date, b.status, b.created_at 
          FROM bookings b
          JOIN patients p ON b.patient_id = p.id
          JOIN hospitals h ON b.hospital_id = h.id
          ORDER BY b.booking_date DESC";

$result = $connect->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Report - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #2BBBAD 50%, #6ea8fe 100%);
            min-height: 100vh;
            padding-top: 60px;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
        }

        h2 {
            color: #2BBBAD;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        table {
            background: #fff;
        }

        .table thead {
            background-color: #2BBBAD;
            color: #fff;
        }

        .table tbody tr:hover {
            background-color: #f2f2f2;
            transition: 0.3s;
        }

        .alert {
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Booking Report</h2>

        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Hospital Name</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= (int) $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['patient_name']) ?></td>
                            <td><?= htmlspecialchars($row['hospital_name']) ?></td>
                            <td><?= htmlspecialchars($row['booking_date']) ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>